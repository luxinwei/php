<?php
// 本类由系统自动生成，仅供测试用途
class TaskAction extends QAction {
	function __construct() {
		parent::__construct ( "Task" );
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$info = $companyModel->regetLoginUser();
		$this->assign('info', $info);
	}
	function selectIndex() {
		return $this->display ( "select" );
	}
	function addIndex() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		
		return $this->display ( "task_add" );
	}
	
	function save() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$arg = I ( 'arg' );
		$mobile = I ( 'mobile' );
		$smsCode = I ( 'smsCode' );
		$SMSCodeModel = D ( 'SMSCode' );
		$CompanyModel = D ( 'Company' );
		$loginUser = $CompanyModel->loginUser ();
		if (empty ( $arg ['title'] )) {
			return $this->q_error ( "请输入任务标题" );
		}
		
		if (empty ( $arg ['content'] )) {
			return $this->q_error ( "请输入任务内容" );
		}
		
		if (empty ( $smsCode )) {
			return $this->q_error ( "请输入验证码" );
		}
		$flag = $SMSCodeModel->chkSmsCode_tool ( $smsCode, 5, $mobile );
		if (! $flag) {
			return $this->q_error ( "手机验证码错误" );
		}
		$arg ['addtime'] = time ();
		$arg ['uid'] = $loginUser ['id'];
		
		$money = $companyModel->myMoney ();
		if ($money < $arg ['pay_money']) {
			return $this->q_error ( "账户余额不足{$arg ['pay_money']}，请先充值" );
		}
		
		$this->q_model->q_add ( $arg );
		$task_id = $this->q_model->q_lastInsertID ();
		$companyModel->diffMyMoney ( $arg ['pay_money'] );
		
		$FileModel = D ( 'Files' );
		$files_key = I ( 'files_key' );
		$files_name = I ( 'files_name' );
		foreach ( $files_key as $k => $fkey ) {
			if (empty ( $fkey )) {
				continue;
			}
			$FileModel->addCompanyFiles ( $files_name [$k], $fkey, $loginUser ['id'], $task_id, 2 );
		}
		$TaskMsgPushModel = D ( 'TaskMsgPush' );
		$push_school = I ( 'push_school' );
		$push_major = I ( 'push_major' );
		$push_grade = I ( 'push_grade' );
		
		$TaskMsgPushModel->addTaskPush ( $push_school, $push_major, $push_grade, 0, $task_id );
		return $this->q_success ( $task_id . "" );
	}
	
	function detail() {
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$taskData = $TaskModel->getMy ( $id );
		if (empty ( $taskData )) {
			return $this->error ( "任务不存在" );
		}
		if ($taskData['state']==10){
			$CompanyModel = D ( 'Company' );
			$loginCompany = $CompanyModel->loginUser ();
			$taskData ['is_my_publish'] = false;
			if (! empty ( $loginCompany ) && $loginCompany ['id'] == $taskData ['uid']) {
				$taskData ['is_my_publish'] = true;
			}
			$taskData ['state_text'] = $TaskModel::$TASK_STATE [$taskData ['state']];
			
			$FilesModel = D ( "Files" );
			$fileList = $FilesModel->getByMid ( 2, $id );
			$CompanyModel = D ( 'Company' );
			$taskData ['publisherData'] = $CompanyModel->q_get ( $taskData ['uid'] );
			$taskData ['fileList'] = $fileList;
			$taskData ['join_number'] = $TaskModel->getJoinNumber ( $taskData ['id'] );
			
			$temp = $taskData ['endtime'] - strtotime ( date ( "Y-m-d" ) );
			$taskData ['surplus_days'] = $temp / 86400;
			$taskData ['surplus_days'] = intval ( $taskData ['surplus_days'] );
			$taskJoinModel = D ( "TaskJoin" );
			$taskData ['my_join_data'] = $taskJoinModel->getMyJoinByTask ( $taskData ['id'] );
			$taskData ['my_join_data'] = $taskJoinModel->warpRow ( $taskData ['my_join_data'] );
			$this->assign ( "taskData", $taskData );
			
			$taskJoinModel = D ( "TaskJoin" );
			$list = $taskJoinModel->getListByTask ( $id );
			$UserModel = D ( 'User' );
			foreach ( $list ['rows'] as &$row ) {
				$row = $taskJoinModel->warpRow ( $row );
			}
			$this->assign ( "joinList", $list );
			//var_dump($taskData);
			return $this->display ( "task_detail" );
		}elseif ($taskData['state']==20){
			return $this->taskStart();
		}elseif ($taskData['state']==30){
			return $this->finished();
		}
	}
	function getPublishListByCompany() {
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$list = $TaskModel->getPublishListByCompany ( $id );
		return $this->q_success ( array ("list" => $list ) );
	}
	
	function getMyPublishList() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		
		$TaskModel = D ( "Task" );
		$state = I ( 'state' );
		$list = $TaskModel->getPublishListByCompany ( '', $state );
		$this->q_pageList ( $list );
		return $this->display ( "myPublishList" );
	}
	
	function joinHand() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$taskid = I ( 'task' );
		$taskData = $this->q_model->getMy ( $taskid );
		if (empty ( $taskData )) {
			return $this->q_error ( "参数有误！" );
		}
		$taskJoinModel = D ( "TaskJoin" );
		$list = $taskJoinModel->getListByTask ( $taskid );
		$UserModel = D ( 'User' );
		foreach ( $list ['rows'] as &$row ) {
			$row = $taskJoinModel->warpRow ( $row );
		}
		$this->assign ( "joinList", $list );
		
		return $this->display ( "joinHand" );
	}
	
	
	/*
	 * 开始任务
	 */
	function startMyTask() {
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$ret = $TaskModel->startMyTask ( $id );
		//var_dump($ret);exit;
		if (empty($ret['status'])){
			return $this->q_error($ret['info']);
		}else{
			return $this->q_success("操作成功",U('Task/taskStart',array('id'=>$id)),0);
		}
		
	}
	
	function taskStart(){
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$taskData = $TaskModel->getMy ( $id );
		if (empty ( $taskData )) {
			return $this->error ( "任务不存在" );
		}
		if ($taskData['state']==20){
			$CompanyModel = D ( 'Company' );
			$loginCompany = $CompanyModel->loginUser ();
			$taskData ['is_my_publish'] = false;
			if (! empty ( $loginCompany ) && $loginCompany ['id'] == $taskData ['uid']) {
				$taskData ['is_my_publish'] = true;
			}
			$taskData ['state_text'] = $TaskModel::$TASK_STATE [$taskData ['state']];
			
			$FilesModel = D ( "Files" );
			$fileList = $FilesModel->getByMid ( 2, $id );
			$CompanyModel = D ( 'Company' );
			$taskData ['publisherData'] = $CompanyModel->q_get ( $taskData ['uid'] );
			$taskData ['fileList'] = $fileList;
			$taskData ['join_number'] = $TaskModel->getJoinNumber ( $taskData ['id'] );
			
			$temp = $taskData ['endtime'] - strtotime ( date ( "Y-m-d" ) );
			$taskData ['surplus_days'] = $temp / 86400;
			$taskData ['surplus_days'] = intval ( $taskData ['surplus_days'] );
			$taskJoinModel = D ( "TaskJoin" );
			$taskData ['my_join_data'] = $taskJoinModel->getMyJoinByTask ( $taskData ['id'] );
			$taskData ['my_join_data'] = $taskJoinModel->warpRow ( $taskData ['my_join_data'] );
			$this->assign ( "taskData", $taskData );
			
			$taskJoinModel = D ( "TaskJoin" );
			$list = $taskJoinModel->getListByTask ( $id );
			$UserModel = D ( 'User' );
			foreach ( $list ['rows'] as &$row ) {
				$row = $taskJoinModel->warpRow ( $row );
			}
			$this->assign ( "joinList", $list );
			//var_dump($taskData);
			return $this->display ( "task_start" );
		}else{
			return $this->error('当前不允许开始任务操作');
		}
	}
	/*
	 * 结束任务
	 */
	function endMyTask() {
		$id = I ( 'id' );
		$finished = I('RadioGroup1');
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$ret = $TaskModel->endMyTask ( $id );
		//var_dump($ret);exit;
		if (empty($ret['status'])){
			return $this->q_error($ret['info']);
		}else{
			return $this->q_success("操作成功",U('Task/finished',array('id'=>$id)),0);
		}
		
//		if ($finished == 1){
//			return $this->q_mret ( $ret, "付款成功",'', U('Task/finished',array('id'=>$id)) );
//		}elseif ($finished == 2){
//			return $this->q_mret ( $ret, "操作成功",'',U('Task/arbitrateIndex',array('id'=>$id)) );
//		}
	}
	
	function arbitrateIndex(){
		$id = I('id');
		$this->assign('id',$id);
		return $this->display ( "arbitrate" );
	}
	//仲裁
	function arbitrate(){
		$id = I('id');
		$arbitrate = I('arbitrate');
		if (empty($arbitrate)){
			$this->error('请填写仲裁说明');
		}
		$joinModel = D('TaskJoin');
		$res = $joinModel->addArbitrate($id,$arbitrate);
		return $this->q_success('仲裁已经申请',U('Task/arbitrateResult',array('id'=>$id)),0);
	}
	
	function arbitrateResult(){
		return $this->display('result');
	}
	
	function finished(){
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$taskData = $TaskModel->getMy ( $id );
		if (empty ( $taskData )) {
			return $this->error ( "任务不存在" );
		}
		if ($taskData['state']==30){
		$CompanyModel = D ( 'Company' );
		$loginCompany = $CompanyModel->loginUser ();
		$taskData ['is_my_publish'] = false;
		if (! empty ( $loginCompany ) && $loginCompany ['id'] == $taskData ['uid']) {
			$taskData ['is_my_publish'] = true;
		}
		$taskData ['state_text'] = $TaskModel::$TASK_STATE [$taskData ['state']];
		
		$FilesModel = D ( "Files" );
		$fileList = $FilesModel->getByMid ( 2, $id );
		$CompanyModel = D ( 'Company' );
		$taskData ['publisherData'] = $CompanyModel->q_get ( $taskData ['uid'] );
		$taskData ['fileList'] = $fileList;
		$taskData ['join_number'] = $TaskModel->getJoinNumber ( $taskData ['id'] );
		
		$temp = $taskData ['endtime'] - strtotime ( date ( "Y-m-d" ) );
		$taskData ['surplus_days'] = $temp / 86400;
		$taskData ['surplus_days'] = intval ( $taskData ['surplus_days'] );
		$taskJoinModel = D ( "TaskJoin" );
		$taskData ['my_join_data'] = $taskJoinModel->getMyJoinByTask ( $taskData ['id'] );
		$taskData ['my_join_data'] = $taskJoinModel->warpRow ( $taskData ['my_join_data'] );
		$this->assign ( "taskData", $taskData );
		
		$taskJoinModel = D ( "TaskJoin" );
		$list = $taskJoinModel->getListByTask ( $id );
		$UserModel = D ( 'User' );
		foreach ( $list ['rows'] as &$row ) {
			$row = $taskJoinModel->warpRow ( $row );
		}
		$this->assign ( "joinList", $list );
		
		$taskCommentModel = D('TaskComment');
		$commentList = $taskCommentModel->getListByTask($id);
		
		$UserModel = D ( 'User' );
		foreach ( $commentList ['rows'] as &$row ) {
			$row ['user_data'] = $UserModel->q_get ( $row ['uid'], "", array ('username', 'id', 'student_and_photo', 'sex', 'realname' , 'avatar' ) );
			$row ['user_data'] ['student_and_photo'] = C ( "QINIU_IMG_DOMAIN" ) . $row ['user_data'] ['student_and_photo'];
		
		} 
		$this->assign ( "commentList", $commentList );
		
		return $this->display('finished');
	}else{
		return $this->error('当前不允许结束任务操作');
	}
	
	}
	
}