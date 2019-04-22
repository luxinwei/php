<?php
class RecruitAction extends QAction {
	function __construct() {
		parent::__construct ( "Recruit" );
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$info = $companyModel->regetLoginUser();
		$this->assign('info', $info);
	}
	
	function addIndex() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$state=I("state",2);
		$this->assign("state",$state);
		return $this->display ( "recruit_add" );
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
		if (empty ( $arg ['position'] )) {
			return $this->q_error ( "请输入职位" );
		}
	
		
		if (empty ( $smsCode )) {
			return $this->q_error ( "请输入验证码" );
		}
		$flag = $SMSCodeModel->chkSmsCode_tool ( $smsCode, 5, $mobile );
		if (! $flag) {
			return $this->q_error ( "手机验证码错误" );
		}
		$arg ['time'] = time ();
		$arg ['uid'] = $loginUser ['id'];
		$push_school = I ( 'push_school' );
		$push_major = I ( 'push_major' );
		$push_grade = I ( 'push_grade' );
		
		$arg ['push_school'] =$push_school;
		$arg ['push_professional'] =$push_major;
		$arg ['push_level'] =$push_grade;
		$arg ['phone_number'] =$mobile;
		
		$this->q_model->q_add ( $arg );
		$recruit_id = $this->q_model->q_lastInsertID ();
		$companyModel->diffMyMoney($arg ['pay_money']);
		
		return $this->q_success ( $recruit_id . "" );
	}
	
	function detail() {
		$id = I ( 'id' );
		
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$RecruitModel = D ( "Recruit" );
		$recruitData = $RecruitModel->getMy ( $id );
		if (empty ( $recruitData )) {
			return $this->error ( "任务不存在" );
		}
		$CompanyModel = D ( 'Company' );
		$loginCompany = $CompanyModel->loginUser ();
		$recruitData ['is_my_publish'] = false;
		if (! empty ( $loginCompany ) && $loginCompany ['id'] == $recruitData ['uid']) {
			$recruitData ['is_my_publish'] = true;
		}
		
		$CompanyModel = D ( 'Company' );
		$recruitData ['publisherData'] = $CompanyModel->q_get ( $recruitData ['uid'] );
		$recruitData ['join_number'] = $RecruitModel->getJoinNumber ( $recruitData ['id'] );
		
		$this->assign ( "recruitData", $recruitData );
		
		$recruitJoinModel = D ( "Delivery" );
		$list = $recruitJoinModel->getListByRecruit ( $id );
		$UserModel = D ( 'User' );
		foreach ( $list ['rows'] as &$row ) {
			$row = $recruitJoinModel->warpRow ( $row );
		}
		$this->assign ( "joinList", $list );
		
		
		return $this->display ( "recruit_detail" );
	
	}
	
	function getMyPublishList() {
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		
		$RecruitModel = D ( "Recruit" );
		$state = I ( 'state' );
		$list = $RecruitModel->getPublishListByCompany ( '', $state );
		$this->q_pageList ( $list );
		return $this->display ( "myPublishList" );
	}
	
	/**投递简历**/
	function  deliveryresume(){
		$userModel= D('User');
		$userModel->isRealNameAudit();
		$userinfo=$userModel->loginUser();
		$uid=$userinfo['id'];
		$id=$this->q_param('id');
		
		$deliveryModel= D('Delivery');
		if($id==""){
			return  $this->error('你的投递id为空');
		}
		$data['uid']=$uid;
		$data['rid']=$id;
		$data['time']=time();
		$info=$deliveryModel->add($data);
		if($info){
			return $this->success('投递成功！');
		}
		
	}
	
	
	
	
}