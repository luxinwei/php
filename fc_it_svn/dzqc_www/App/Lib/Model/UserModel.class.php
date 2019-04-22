<?php
class UserModel extends QModel{
	/**
	 * 检测是否登录
	 */
	function isLogin() {
		$v = Session::get ( "user_has_login" );
		if ($v != 1) {
			//未登录
			return $this->q_error('请先登陆');
		}
	}
	
	/**
	 * 检测是否实名认证
	 */
	function isRealNameAudit() {
		$user = $this->loginUser ();
		if (empty ( $user )) {
			//未登录
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "User/login" ), 5, "您尚未登录，请先登录" );
		}
		
		$data = $this->q_get ( $user ['id'], '', array ('audit' ) );
		if ($data['audit'] != 20) {
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "StudentAudit/auditOne" ), 5, "您尚未通过实名认证" );
			die ();
		}
		return $data;
	}
	/**
	 * 通过手机号得到一条记录
	 * @param string $mobile
	 */
	function getByMobile($mobile) {
		$where = "mobile='{$mobile}'";
		return $this->q_get ( '', $where );
	}
	function reg($mobile,$password){
		$data = array ();
		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->regByMobile ( $mobile, $password );
		if ($api_ret ['status'] == 0) {
			return $this->q_error ( $api_ret ['info'] );
		}
		$data ['username'] = $api_ret ['userData'] ['username'];
		$data ['regtime'] = $api_ret ['userData'] ['regtime'];
		$data ['id'] = $api_ret ['userData'] ['id'];
		$data ['mobile'] = $mobile;
		$ret = $this->add ( $data );
		return $ret;
	}
	
/**
	 * 登录
	 * @param string $username
	 * @param string $password
	 * @param bool $password_has_md
	 */
	function login($username, $password, $password_has_md = false) {
		//		$data = array ();
		//		$temp = $this->where ( " username='{$username}' or mobile='{$username}'" )->find ();
		//		if (empty ( $temp )) {
		//			return $this->q_error ( "该用户不存在" );
		//		}
		//		
		//		if ($temp ['password'] != $this->password_md5 ( $password )) {
		//			
		//			return $this->q_error ( "密码不正确" );
		//		}
		//		
		//		$data ['last_login_time'] = time ();
		//		$this->q_edit ( $data, $temp ['id'] );
		

		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->login ( $username, $password, $password_has_md );
		
		if ($api_ret ['status'] == 0) {
			return $this->q_error ( $api_ret ['info'] );
		}
		$atemp = $this->q_get ( $api_ret ['userData'] ['id'] );
		//echo $this->getLastSql();exit;
		if (empty ( $atemp )) {
			$data = array ();
			$data ['username'] = $api_ret ['userData'] ['username'];
			$data ['regtime'] = $api_ret ['userData'] ['regtime'];
			$data ['id'] = $api_ret ['userData'] ['id'];
			$data ['mobile'] = $api_ret ['userData'] ['mobile'];
			$this->add ( $data );
		}
		
		Session::set ( "user_has_login", 1 );
		Session::set ( "login_user_data", $api_ret ['userData'] );
		return $atemp;
	
	}
	
	/**
	 * 记录登陆者的session信息
	 */
	function loginUser() {
		return Session::get ( "login_user_data" );
	}
	
	function editPassword($uid, $old_password, $newPassword) {
		
		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->editPassword ( $uid, $old_password, $newPassword );
		if ($api_ret ['status'] == 0) {
			return $this->q_error ( $api_ret ['info'] );
		}
		return $this->q_success ( "修改成功！" );
	}
	
	/**
	 * 登出、退出
	 */
	function logout() {
		return Session::set ( "user_has_login", 0 );
	}
	
	function regetLoginUser() {
		$user = $this->loginUser ();
		
		$user = $this->q_get ( $user ['id'] );
		Session::set ( "login_user_data", $user );
		
		return Session::get ( "login_user_data" );
	}
	
}
