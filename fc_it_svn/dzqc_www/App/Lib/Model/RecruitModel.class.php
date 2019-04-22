<?php

class RecruitModel extends QModel {
	public static $TASK_MONEY = array ("1" => "remuneration<2000", "2" => "remuneration>=2000 and remuneration<5000", "3" => "remuneration>=5000 and remuneration<10000", "4" => "remuneration>=10000 and remuneration<15000" );
	
	function getPublishListByCompany($companyId = "",$state="") {
		$companyModel = D ( "Company" );
		if (empty ( $companyId )) {
			$user = $companyModel->loginUser ();
			$companyId = $user ['id'];
		}
		
		$where = "uid={$companyId}  ";
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
	
	function warpRow($taskData) {
		$CompanyModel = D ( 'Company' );
		$taskData ['publisherData'] = $CompanyModel->q_get ( $taskData ['uid'] );
		$industryModel = D('DicIndustry');
		$industry = $industryModel->q_get($taskData['industry'],'',array('name'));
		$taskData ['publisherData']['industry'] = $industry['name'];
		$taskData ['publisherData'] ['logo']= C ( "QINIU_IMG_DOMAIN" ) .$taskData ['publisherData'] ['logo'];
		$taskData ['join_number'] = $this->getJoinNumber ( $taskData ['id'] );
		return $taskData;
	}
	function getJoinNumber($task) {
		$DeliveryModel = D ( "Delivery" );
		return $DeliveryModel->q_count ( "rid={$task}" );
	}
	
	//得到推送的招聘列表
	function getMyRecommendList($remuneration,$industry_id,$state,$search_key) {
		$where = "1=1";
		if (!empty($remuneration)){
			$where .= " and ".self::$TASK_MONEY[$remuneration];
		}
		if (!empty($industry_id)){
			$where .= " and industry_id={$industry_id}";
		}
		if (!empty($state)){
			$where .= " and state={$state}";
		}
		if (!empty($search_key)){
			$where .= " and (position LIKE '%{$search_key}%' or responsibility LIKE '%{$search_key}%' )";
		}
		//var_dump($where);
		$order = "time DESC";
		$list = $this->q_getList($where,$order,1);
		foreach ( $list ['rows'] as &$taskData ) {
			$taskData = $this->warpRow ( $taskData );
		
		}
		return $list;
	}
	//当前招聘详情
	function getCurrentRecruit($id){
		$recruitData = $this->q_get($id);
		$industryModel = D('DicIndustry');
		$industry = $industryModel->q_get($recruitData['industry_id'],'',array('name'));
		$recruitData['industry'] = $industry['name'];
		$companyModel = D('Company');
		$recruitData['company'] = $companyModel->q_get($recruitData['uid']);
		return $recruitData;
	}
	//排序查询
	function getRecruit($order){
		$list = $this->q_getList('',$order, 0, 5,0);
		foreach ($list['rows'] as &$rows){
			$rows = $this->warpRow($rows);
		}
		return $list;
	}
}