<?php

class CompanyModel extends QModel {
	/**
	 * 检测是否登录
	 */
	function isLogin() {
		$v = Session::get ( "company_has_login" );
		if ($v != 1) {
			//未登录
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "Company/log" ), 5, "您尚未登录，请先登录" );
		}
	}
	
	/**
	 * 注册
	 * @param string $mobile
	 * @param string $password
	 */
	function reg($email, $password) {
		$data = array ();
		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->regByEmail ( $email, $password, 1 );
		//print_r($api_ret);die;
		if ($api_ret ['status'] == 0) {
			return $this->q_error ( $api_ret ['info'] );
		}
		$data ['username'] = $api_ret ['userData'] ['username'];
		$data ['regtime'] = $api_ret ['userData'] ['regtime'];
		$data ['id'] = $api_ret ['userData'] ['id'];
		
		$this->add ( $data );
		//$this->linkEmail($data ['username']);
		$link = $this->sendActiveEmail ( $data ['username'] );
		//return $this->q_success ();
		Session::set ( "emaillink", $link );
		return $link;
	}
	
	/**
	 * 邮箱链接
	 * **/
	//	function  linkEmail($username){
	//		$UCAPIModel = D ( 'UCAPI' );
	//		$api_ret=$UCAPIModel->getByUsername($username);
	//		$userData=$api_ret['userData'];
	//		$mailArg = array ();
	//		$time = date ( 'Y-m-d H:i:s' );
	//		$now=time();
	//		$key=md5($userData['username'].$userData['password'].$now);
	//		$hash_code=base64_encode($key.'*'.$now.'*'.$userData[username]);
	//		$link=C('DZQC_WWW_HOST')."Company/active?code={$hash_code}";
	//		return  $link;
	//	}
	//	
	

	function sendActiveEmail($username) {
		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->getByUsername ( $username );
		$userData = $api_ret ['userData'];
		$mailArg = array ();
		$time = date ( 'Y-m-d H:i:s' );
		
		$now = time ();
		
		$key = md5 ( $userData ['username'] . $userData ['password'] . $now );
		$hash_code = base64_encode ( $key . '*' . $now . '*' . $userData [username] );
		
		$link = C ( 'DZQC_WWW_HOST' ) . "Company/active?code={$hash_code}";
		
		$mailParams = array ();
		$mailParams ['to'] = $userData ['username'];
		$mailParams ['subject'] = "请激活您的账户";
		$mailParams ['message'] = <<<aaa
<div style="padding:1em;">
<div>感谢您的注册!</div><div>&nbsp;</div><div><b>
点击以下链接即可激活账户：</b></div><div>
<a href="{$link}">
<font color="#ff0000">{$link}</font>
</a></div><div>
-------------------------------------------------
----------------------------------</div><div><br></div><div>&nbsp;
aaa;
		Emailer::send ( $mailParams );
		return $link;
	}
	
	/**
	 * 通过用户名得到一条记录
	 * @param string $username
	 */
	function getByUsername($username) {
		$where = "username='{$username}'";
		return $this->q_get ( '', $where );
	}
	
	/**
	 * 通过手机号得到一条记录
	 * @param string $mobile
	 */
	function getByMobile($mobile) {
		$where = "mobile='{$mobile}'";
		return $this->q_get ( '', $where );
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
		if (empty ( $atemp )) {
			$data = array ();
			$data ['username'] = $api_ret ['userData'] ['username'];
			$data ['regtime'] = $api_ret ['userData'] ['regtime'];
			$data ['id'] = $api_ret ['userData'] ['id'];
			$data ['mobile'] = $api_ret ['userData'] ['mobile'];
			$this->add ( $data );
		}
		
		Session::set ( "company_has_login", 1 );
		Session::set ( "login_company_data", $api_ret ['userData'] );
		
		return $atemp;
	
	}
	/**
	 * 登出、退出
	 */
	function logout() {
		Session::set ( "company_has_login", 0 );
	}
	/**
	 * 记录登陆者的session信息
	 */
	function loginUser() {
		return Session::get ( "login_company_data" );
	}
	function regetLoginUser() {
		$user = $this->loginUser ();
		
		$user = $this->q_get ( $user ['id'] );
		Session::set ( "login_company_data", $user );
		
		return Session::get ( "login_company_data" );
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
	 * 检测是否实名认证
	 */
	function isRealNameAudit() {
		$company = $this->loginUser ();
		if (empty ( $company )) {
			//未登录
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "Company/log" ), 5, "您尚未登录，请先登录" );
			die ();
		}
		
		$data = $this->q_get ( $company ['id'], '', array ('audit' ) );
		if ($data ['audit'] != 20) {
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "Comauth/auth" ), 5, "您尚未通过实名认证" );
			die ();
		}
	}
	function getCompany($uid) {
		return $this->q_get ( $uid );
	}
	function addMyMoney($number) {
		$user = $this->loginUser ();
		$table = $this->getTableName ();
		$sql = "update {$table} set money=money+{$number} where id={$user[id]}";
		$this->execute ( $sql );
		$this->regetLoginUser ();
		return $this->q_success ();
	}
	function diffMyMoney($number) {
		$user = $this->regetLoginUser ();
		if ($user ['money'] < $number) {
			return $this->q_error ( '余额不足' );
		}
		$table = $this->getTableName ();
		$sql = "update {$table} set money=money-{$number} where id={$user[id]}";
		$this->execute ( $sql );
		$this->regetLoginUser ();
		return $this->q_success ();
	}
	function myMoney() {
		$user = $this->regetLoginUser ();
		return $user ['money'];
	}
}