<?php

class UserModel extends QModel {
	
	function isLogin() {
		$v = Session::get ( "user_has_login" );
		if ($v != 1) {
			//未登录
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "User/loginIndex" ), 5, "您尚未登录，请先登录" );
		}
	}
	
	function regByMobile($mobile, $password) {
		$data = array ();
		$temp = $this->where ( "mobile='{$mobile}'" )->find ();
		if (! empty ( $temp )) {
			return $this->q_error ( "该手机号已存在" );
		}
		$data ['username'] = strtoupper ( Method::randChar ( 4 ) ) . $mobile;
		$data ['mobile'] = $mobile;
		$data ['password'] = $this->password_md5 ( $password );
		$data ['regtime'] = time ();
		
		$this->add ( $data );
		$this->login ( $mobile, $password );
		$data ['id'] = $this->q_lastInsertID ();
		return $this->q_success ( array ('userData' => $data ) );
	}
	
	function regByEmail($email, $password,$isNeedChk=1) {
		$data = array ();
		$temp = $this->where ( "email='{$email}'" )->find ();
		if (! empty ( $temp )) {
			return $this->q_error ( "该邮箱已存在" );
		}
		if($isNeedChk){
			$data ['state'] = 0;
		}
		$data ['username'] = $email;
		$data ['email'] = $email;
		$data ['password'] = $this->password_md5 ( $password );
		$data ['regtime'] = time ();
		
		$this->add ( $data );
		$this->login ( $email, $password );
		$data ['id'] = $this->q_lastInsertID ();
		return $this->q_success ( array ('userData' => $data ) );
	}
	
	function password_md5($password) {
		return md5 ( "dzqc" . $password . "xiaoqi" );
	}
	
	function getByUsername($username) {
		$where = "username='{$username}'";
		return $this->q_get ( '', $where );
	}
	
	function getByMobile($mobile) {
		$where = "mobile='{$mobile}'";
		return $this->q_get ( '', $where );
	}
	
	function login($username, $password, $password_has_md = false) {
		$data = array ();
		$temp = $this->where ( " username='{$username}' or mobile='{$username}'" )->find ();
		if (empty ( $temp )) {
			return $this->q_error ( "该用户尚未注册" );
		}
		
		if ($temp ['password'] != $this->password_md5 ( $password )) {
			
			return $this->q_error ( "密码不正确" );
		}
		
		if ($temp ['state']==0 ) {
			
			return $this->q_error ( "账户尚未激活" );
		}
		
		$data ['last_login_time'] = time ();
		$this->q_edit ( $data, $temp ['id'] );
		
		Session::set ( "user_has_login", 1 );
		unset ( $temp ['password'] );
		Session::set ( "login_user_data", $temp );
		
		return $this->q_success ( array ('userData' => $temp ) );
	
	}
	
	function logout() {
		Session::set ( "user_has_login", 0 );
	}
	
	function loginUser() {
		return Session::get ( "login_user_data" );
	}
	
	function editPassword($uid, $newPassword) {
		$this->q_edit ( array ('password' => $this->password_md5 ( $newPassword ) ), $uid );
		return $this->q_success ();
	}
	function editEmail($uid, $newEmail) {
		$this->q_edit ( array ('email' => $newEmail ), $uid );
		return $this->q_success ();
	}
	
	/**
	 * 第三方登录的参数
	 * @param string $sign 登录类型的字段
	 * @param string $reg_sign 登录的唯一ID
	 * @param string $prefix  前缀
	 * @param number $regchannel 1-Android;2-ios;3-web;
	 */
	function oauth($reg_type, $reg_sign, $reg_channel) {
		$prefix = "";
		if ($reg_type == 1) {
			//qq登录
			$prefix = "qq_";
			$res = $this->q_get ( '', $prefix . "sign='" . $reg_sign . "'" );
		} elseif ($reg_type == 2) {
			//微博登录
			$prefix = "weibo_";
			$res = $this->q_get ( '', $prefix . "sign='" . $reg_sign . "'" );
		} elseif ($reg_type == 3) {
			//微信登录
			$prefix = "weixin_";
			$res = $this->q_get ( '', $prefix . "sign='" . $reg_sign . "'" );
		}
		
		if ($res) {
			$this->login ( $res ['username'], $res ['password'], 1 );
			return $this->q_success ( "登录成功！" );
		} else {
			$arr ['username'] = $prefix . Method::random ( 6 );
			$arr ['password'] = $this->password_md5 ( $prefix . Method::random ( 10 ) );
			$arr ['caneditusername'] = 1;
			$arr ['regchannel'] = $reg_channel;
			$arr ['regtime'] = time ();
			$arr ['other_reg_type'] = $reg_type;
			$ret = $this->q_save ( $arr, $prefix . "sign='" . $reg_sign . "'" );
			if ($ret) {
				$this->login ( $arr ['username'], $arr ['password'] );
				return $this->q_success ( "登录成功！" );
			} else {
				return $this->q_error ( '登录失败' );
			}
		}
	}

}