<?php

class TaskModel extends QModel {
	//10:报名中，20：已开始(进行中），30：已结束，40：已取消
	public static $TASK_STATE = array ("10" => "报名中", "20" => "已开始(进行中）", "30" => "已结束", "40" => "已取消" );
	public static $TASK_MONEY = array ("1" => "pay_money>=0 and pay_money<1000", "2" => "pay_money>=1000 and pay_money<3000", "3" => "pay_money>=3000 and pay_money<5000", "4" => "pay_money>=5000 and pay_money<8000", "5" => "pay_money>=8000" );
	public static $TASK_CYCLE = array ("1" => "work_days<=7", "2" => "work_days<=15 and work_days>7", "3" => "work_days<=30 and work_days>15", "4" => "work_days>30" );
	//某个企业发布的任务列表
	function getPublishListByCompany($companyId = "",$state="") {
		$companyModel = D ( "Company" );
		if (empty ( $companyId )) {
			$user = $companyModel->loginUser ();
			$companyId = $user ['id'];
		}
		
		$where = "uid={$companyId} and type=1";
		if(!empty($state)){
		
			$where.=" and state={$state}";
		}
		$list = $this->q_getList ( $where, 'id desc',1 );
		foreach ( $list ['rows'] as &$taskData ) {
			$taskData = $this->warpRow ( $taskData );
		}
		return $list;
	}
	function getMy($id) {
		$companyModel = D ( "Company" );
		$user = $companyModel->loginUser ();
		$companyId = $user ['id'];
		
		$where = "uid={$companyId} and id={$id}";
		$list = $this->q_get (  '',$where );
		return $list;
	}
	//得到推送的任务列表
	function getMyRecommendList($arg,$task_money,$task_cycle,$task_time,$search_key) {
		$where = "1=1";
		if (!empty($task_money)){
			$where .= " and ".self::$TASK_MONEY[$task_money];
		}
		if (!empty($task_cycle)){
			$where .= " and ".self::$TASK_CYCLE[$task_cycle];
		}
		if (!empty($task_time)){
			$data = $this->getUnixTime();
			$end = $data['end']; //今天截至时间
			if ($task_time==1){
				$start = $data['start'];
				$where .= " and dzqc_task.`addtime`>'"."{$start}'"." and dzqc_task.`addtime`<'"."{$end}' ";
			}elseif ($task_time==2){
				$start_add_three = $data['start_add_three'];
				$where .= " and dzqc_task.`addtime`>'"."{$start_add_three}'"." and dzqc_task.`addtime`<'"."{$end}' ";
			}elseif ($task_time==3){
				$start_add_week = $data['start_add_week'];
				$where .= " and dzqc_task.`addtime`>'"."{$start_add_week}'"." and dzqc_task.`addtime`<'"."{$end}' ";
			}elseif ($task_time==4){
				$start_add_mouth = $data['start_add_mouth'];
				$where .= " and dzqc_task.`addtime`>'"."{$start_add_mouth}'"." and dzqc_task.`addtime`<'"."{$end}' ";
			}
		}
		if (!empty($search_key)){
			$where .= " and (title LIKE '%{$search_key}%' or content LIKE '%{$search_key}%' )";
		}
		$order = "addtime DESC ,id desc";
		if (isset ( $arg ['state'] )) {
			$where .= " and state={$arg['state']}";
		}
		//var_dump($where);
		$UserModel = D ( 'User' );
		$taskJoinModel = D ( "TaskJoin" );
		$T_task_join = $taskJoinModel->getTableName ();
		$T_task = $this->getTableName ();
		if ($arg ['is_my'] == 1) {
			$myUser = $UserModel->loginUser ();
			$where .= " and EXISTS (select id from {$T_task_join} where {$T_task}.id={$T_task_join}.taskid and {$T_task_join}.uid={$myUser[id]})";
		}
		$list = $this->q_getList ( $where, $order, 1);
		
		foreach ( $list ['rows'] as &$taskData ) {
			$taskData = $this->warpRow ( $taskData );
		
		}
		return $list;
	}
	
	function getJoinNumber($task) {
		$taskJoinModel = D ( "TaskJoin" );
		return $taskJoinModel->q_count ( "taskid={$task}" );
	}
	
	function searchList($arg) {
		$where = "1=1";
		$order = "id desc";
		if (  $arg ['state'] !=="") {
			$where .= " and state={$arg['state']}";
		}
		if (isset ( $arg ['kw'] )) {
			$where .= " and title like '%{$arg[kw]}%'";
		}
		
		$UserModel = D ( 'User' );
		$taskJoinModel = D ( "TaskJoin" );
		$T_task_join = $taskJoinModel->getTableName ();
		$T_task = $this->getTableName ();
		$list = $this->q_getList ( $where, $order, 1 );
		foreach ( $list ['rows'] as &$taskData ) {
			$taskData=$this->warpRow($taskData);
		}
		return $list;
	}
	
	function warpRow($taskData) {
		$CompanyModel = D ( 'Company' );
		$taskData ['publisherData'] = $CompanyModel->q_get ( $taskData ['uid'] );
		$taskData ['publisherData'] ['logo']= C ( "QINIU_IMG_DOMAIN" ) .$taskData ['publisherData'] ['logo'];
		$industryModel = D('DicIndustry');
		$industry = $industryModel->q_get($taskData['industry'],'',array('name'));
		$taskData ['publisherData'] ['industry']= $industry['name'];
		$taskData ['join_number'] = $this->getJoinNumber ( $taskData ['id'] );
		$taskData ['state_text'] = self::$TASK_STATE [$taskData ['state']];
		return $taskData;
	}
	
	public function addCompanyTask($arg,$type){
		$data = $arg;
		$data['type'] = $type;  //判断类型
		if ($arg['pay_type']==1){
			//一次性支付
			$data['pay_money'] = $arg['pay_money'];
		}else{
			//首尾款支付
			$data['first_pay_money'] = $arg['first_pay_money'];
			$data['end_pay_money'] = $arg['end_pay_money'];
			if (empty($data['first_pay_money'])){
				return $this->q_error('首款不能为空');
			}
			if (empty($data['end_pay_money'])){
				return $this->q_error('尾款不能为空');
			}
		}
		$data['addtime'] = time();
		$data['endtime'] = $data['addtime']+$data['work_days']*24*60*60;
		$data['state'] = 10;
		
		$res = $this->q_add($data);
		//echo $this->getLastSql();exit;
		return $res;
	}
	
	function startMyTask($id) {
		$taskJoinModel = D ( "TaskJoin" );
		$where_1="taskid={$id} and state in (0,50)";
		if($taskJoinModel->q_isExist($where_1)){
			return $this->q_error("有任务请求尚未处理，不能开始任务");
		}
		$temp=$this->getMy($id);
		if(empty($temp)||$temp['state']!=10){
			return $this->q_error("参数有误");
		}
		$data=array();
		$data['state']=20;
		$data['endtime'] = time();
		$this->q_edit($data,$id);
		$where="taskid={$id} and state=30";
		
		$taskJoinModel->q_edit(array('state'=>40),'',$where);
		return $this->q_success('已经开始');
		
	}
	function endMyTask($id) {
		$taskJoinModel = D ( "TaskJoin" );
		$temp=$this->getMy($id);
		if(empty($temp)||$temp['state']!=20){
			return $this->q_error("参数有误");
		}
		$data=array();
		$data['state']=30;
		$this->q_edit($data,$id);
		
		$where="taskid={$id} and state=40";
		$taskJoinModel->q_edit(array('state'=>70),'',$where);
		return $this->q_success();
	}
	
	function getCurrentTask($id){
		$taskData = $this->q_get($id);
		$companyModel = D('Company');
		$taskData['company'] = $companyModel->q_get($taskData['uid']);
		return $taskData;
	}
	//得到时间戳
	function getUnixTime(){
		$cur_time = time();
		//今天的开始截至时间
		$start = mktime(0,0,0,date("m",$cur_time),date("d",$cur_time),date("Y",$cur_time));
		$end = mktime(23,59,59,date("m",$cur_time),date("d",$cur_time),date("Y",$cur_time));
		//3天的开始截至时间
		$start_add_three = mktime(0,0,0,date("m",$cur_time),date("d",$cur_time)-3,date("Y",$cur_time));
		//7天的开始截至时间
		$start_add_week = mktime(0,0,0,date("m",$cur_time),date("d",$cur_time)-7,date("Y",$cur_time));
		//30天的开始时间
		$start_add_mouth = mktime(0,0,0,date("m",$cur_time),1,date("Y",$cur_time));
		$data = array(
			'cur_time' => $cur_time,
			'start' => $start,
			'end' => $end,
			'start_add_three' => $start_add_three,
			'start_add_week' => $start_add_week,
			'start_add_mouth' => $start_add_mouth,
		);
		return $data;
		
	}

}