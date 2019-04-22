<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends QAction {
	function __construct() {
		parent::__construct ( "User" );
	}
	public function loginIndex() {
		return $this->display ( "user/login" );
	}
	function login() {
		$username = I ( 'username' );
		$password = I ( 'password' );
		$password_has_md = I ( 'password_has_md', 0 );
		if (empty ( $username )) {
			
			return $this->q_error ( "请输入用户名" );
		}
		if (empty ( $password )) {
			return $this->q_error ( "请输入密码" );
		}
		
		$usermodel = D ( "User" );
		
		$ret = $usermodel->login ( $username, $password, $password_has_md );
		
		if ($ret ['status'] == 1) {
			return $this->q_success ( $ret );
		} else {
			return $this->q_error ( $ret ['info'] );
		}
	}
	
	function regByMobile() {
		$mobile = $this->q_param ( 'mobile' );
		$password = $this->q_param ( 'password' );
		if (empty ( $mobile )) {
			return $this->q_error ( "请输入手机号" );
		}
		if (! Chker::isMobile ( $mobile )) {
			return $this->q_error ( "手机号格式不正确" );
		}
		if (empty ( $password )) {
			
			return $this->q_error ( "请输入密码" );
		}
		if (! Chker::len ( $password, 6, 20 )) {
			return $this->q_error ( "密码格式不正确" );
		}
		
		$usermodel = D ( "User" );
		
		$ret = $usermodel->regByMobile ( $mobile, $password );
		if ($ret ['status'] == 1) {
			return $this->q_success ( $ret );
		} else {
			return $this->q_error ( $ret ['info'] );
		}
	}
	function regByEmail() {
		$email = $this->q_param ( 'email' );
		$isNeedChk = $this->q_param ( 'isNeedChk', 1 );
		$password = $this->q_param ( 'password' );
		if (empty ( $email )) {
			return $this->q_error ( "请输入邮箱" );
		}
		if (! Chker::isEmail ( $email )) {
			return $this->q_error ( "邮箱格式不正确" );
		}
		if (empty ( $password )) {
			
			return $this->q_error ( "请输入密码" );
		}
		if (! Chker::len ( $password, 6, 20 )) {
			return $this->q_error ( "密码格式不正确" );
		}
		
		$usermodel = D ( "User" );
		
		$ret = $usermodel->regByEmail ( $email, $password, $isNeedChk );
		if ($ret ['status'] == 1) {
			return $this->q_success ( $ret );
		} else {
			return $this->q_error ( $ret ['info'] );
		}
	}
	
	function logout() {
		$usermodel = D ( "User" );
		$usermodel->logout ();
		return $this->q_success ( "退出成功" );
	}
	function isLogin() {
		$usermodel = D ( "User" );
		$user = $usermodel->loginUser ();
		if (empty ( $user )) {
			
			return $this->q_error ( "未登录" );
		} else {
			return $this->q_success ( "已登录" );
		}
	}
	
	function chkMobile_tool($mobile) {
		$temp = $this->q_model->getByMobile ( $mobile );
		if (empty ( $temp )) {
			return $this->q_success ();
		} else {
			return $this->q_error ();
		}
	}
	
	function chkMobileExist() {
		$mobile = I ( 'mobile' );
		$temp = $this->q_model->getByMobile ( $mobile );
		if (! empty ( $temp )) {
			return $this->q_success ();
		} else {
			return $this->q_error ();
		}
	}
	
	function chkUsernameExist() {
		$username = I ( 'username' );
		$temp = $this->q_model->getByUsername ( $username );
		if (! empty ( $temp )) {
			return $this->q_success ();
		} else {
			return $this->q_error ();
		}
	}
	
	function getByUsername() {
		$username = I ( 'username' );
		$temp = $this->q_model->getByUsername ( $username );
		return $this->q_success ( array ('userData' => $temp ) );
	}
	
	function getByMobile() {
		$mobile = I ( 'mobile' );
		$temp = $this->q_model->getByMobile ( $mobile );
		return $this->q_success ( array ('userData' => $temp ) );
	}
	
	function editPassword() {
		$uid = I ( 'uid' );
		$old_password = I ( 'old_password' );
		$new_password = I ( 'new_password' );
		if (empty ( $old_password )) {
			return $this->q_error ( "请输入原密码" );
		}
		if (empty ( $new_password )) {
			return $this->q_error ( "请输入新密码" );
		}
		if (empty ( $uid )) {
			return $this->q_error ( "参数有误" );
		}
		
		$user = $this->q_model->q_get ( $uid );
		
		if (empty ( $user )) {
			return $this->q_error ( "参数有误" );
		}
		
		if ($old_password != 'FORGET_PASSWORD' && $this->q_model->password_md5 ( $old_password ) != $user ['password']) {
			return $this->q_error ( "原密码不正确" );
		}
		
		if (! Chker::len ( $new_password, 6, 20 )) {
			return $this->q_error ( "新密码格式不正确" );
		}
		$this->q_model->editPassword ( $uid, $new_password );
		//通知下属app
		//		$DistributionModel=D('Distribution');
		//		$DistributionModel->notify("/qc_ucenter/user/editPassword.php");
		return $this->q_success ();
	}
	
	function editEmail() {
		$uid = I ( 'uid' );
		$old_email = I ( 'old_email' );
		$new_email = I ( 'new_email' );
		if (empty ( $old_email )) {
			return $this->q_error ( "请输入原密码" );
		}
		if (empty ( $new_email )) {
			return $this->q_error ( "请输入新密码" );
		}
		if (empty ( $uid )) {
			return $this->q_error ( "参数有误" );
		}
		
		$user = $this->q_model->q_get ( $uid );
		
		if (empty ( $user )) {
			return $this->q_error ( "参数有误" );
		}
		
		if ($old_email != $user ['email']) {
			return $this->q_error ( "原邮箱不正确" );
		}
		
		if (! Chker::isEmail ( $new_email )) {
			return $this->q_error ( "新邮箱格式不正确" );
		}
		$this->q_model->editEmail ( $uid, $new_email );
		
		//通知下属app
		//		$DistributionModel=D('Distribution');
		//		$DistributionModel->notify("/qc_ucenter/user/editPassword.php");
		return $this->q_success ();
	}
	
	/**
	 * 第三方登录
	 * $reg_type:1-qq;2-weibo;3-weixin
	 * $reg_sign:唯一id值
	 */
	public function OAuth($reg_type, $reg_sign, $reg_channel) {
		$reg_type = I ( 'reg_type' );
		$reg_sign = I ( 'reg_sign' );
		$reg_channel = I ( 'reg_channel' );
		$ret = $this->q_model->oauth ( $reg_type, $reg_sign, $reg_channel );
		
		if ($ret) {
			return $this->q_success ( "登录成功！" );
		} else {
			return $this->q_error ( '登录失败' );
		}
	
	}
	
	function chgUserState() {
		$uid = I ( 'uid' );
		$state = I ( 'state' );
		if (empty ( $uid )) {
			return $this->q_error ( "参数有误" );
		}
		
		$user = $this->q_model->q_get ( $uid );
		if (empty ( $user )) {
			return $this->q_error ( "参数有误" );
		}
		
		$this->q_model->q_edit ( array ('state' => $state ), $uid );
	}

}