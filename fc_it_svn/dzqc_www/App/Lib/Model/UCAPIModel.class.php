<?php

class UCAPIModel extends QModel {
	function argSort($para) {
		ksort ( $para );
		reset ( $para );
		return $para;
	}
	function curl_post($url, $arg = NULL, $getCookie = 0, $sendCookie = 0, $header = null, $ingore = false) {
		if (empty ( $arg )) {
			$arg = array ();
		}
		
		$arg ['ajax'] = 1;
		
		$ch = curl_init ();
		$ip = rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 );
		$ip = '125.41.178.17';
		$headers ['CLIENT-IP'] = $ip;
		$headers ['X-FORWARDED-FOR'] = $ip;
		
		$headerArr = array ();
		foreach ( $headers as $n => $v ) {
			$headerArr [] = $n . ':' . $v;
		}
		//		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headerArr ); //构造IP
		//		curl_setopt ( $ch, CURLOPT_REFERER, "http://www.sohu.com/ " ); //构造来路
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $arg ) );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
		if ($getCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEJAR, C ( 'DATA_CACHE_PATH' ) . '/cookie.txt' );
		}
		if ($sendCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEFILE, C ( 'DATA_CACHE_PATH' ) . '/cookie.txt' );
		}
		if (is_array ( $header )) {
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		}
		curl_setopt ( $ch, CURLOPT_NOBODY, FALSE );
		if ($ingore) {
			curl_setopt ( $ch, CURLOPT_TIMEOUT, 1 );
			curl_exec ( $ch );
			curl_close ( $ch );
			return;
		}
		$output = curl_exec ( $ch );
		if ($output === FALSE) {
			//			echo "<p>curlException：" . curl_errno ( $ch );
			//			echo "<p>curlException：" . curl_error ( $ch );
			curl_close ( $ch );
			throw new Exception ( curl_error ( $ch ) );
		}
		curl_close ( $ch );
		return $output;
	}
	function gre_uc_miyao($action_name, $arg, $key = '') {
		$key || $key = C ( 'UC_API_MIYAO' );
		
		$arg = $this->argSort ( $arg );
		$miyao = $key . $action_name;
		$param_str = "";
		foreach ( $arg as $name => $val ) {
			if ($name == "secret_key" || $name == '_URL_'|| $name == 'ajax') {
				continue;
			}
			$param_str .= $name;
		}
		if (empty ( $param_str )) {
			return true;
		
		}
		$hash = md5 ( $param_str . $miyao );
		return $hash;
	}
	function regByMobile($mobile, $password) {
		$arg = array ();
		$arg ['mobile'] = $mobile;
		$arg ['password'] = $password;
		
		$arg ['secret_key'] = $this->gre_uc_miyao ( "regByMobile", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/regByMobile';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	function regByEmail($email, $password, $isNeedChk = 1) {
		$arg = array ();
		$arg ['email'] = $email;
		$arg ['password'] = $password;
		$arg ['isNeedChk'] = $isNeedChk;
		
		$arg ['secret_key'] = $this->gre_uc_miyao ( "regByEmail", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/regByEmail';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	function login($username, $password, $password_has_md = 0) {
		$arg = array ();
		$arg ['username'] = $username;
		$arg ['password'] = $password;
		$arg ['password_has_md'] = $password_has_md;
		
		$arg ['secret_key'] = $this->gre_uc_miyao ( "login", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/login';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	function editPassword($uid, $old_password, $newPassword) {
		$arg = array ();
		$arg ['uid'] = $uid;
		$arg ['new_password'] = $newPassword;
		$arg ['old_password'] = $old_password;
		
		$arg ['secret_key'] = $this->gre_uc_miyao ( "editPassword", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/editPassword';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	/**
	 * 通过用户名得到一条记录
	 * @param string $username
	 */
	function getByUsername($username) {
		$arg = array ();
		$arg ['username'] = $username;
		$arg ['secret_key'] = $this->gre_uc_miyao ( "getByUsername", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/getByUsername';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	/**
	 * 通过手机号得到一条记录
	 * @param string $mobile
	 */
	function getByMobile($mobile) {
		$arg = array ();
		$arg ['mobile'] = $mobile;
		$arg ['secret_key'] = $this->gre_uc_miyao ( "getByMobile", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/getByMobile';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	function chkMobileExist($mobile) {
		$arg = array ();
		$arg ['mobile'] = $mobile;
		$arg ['secret_key'] = $this->gre_uc_miyao ( "chkMobileExist", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/chkMobileExist';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	function chkUsernameExist($username) {
		$arg = array ();
		$arg ['username'] = $username;
		$arg ['secret_key'] = $this->gre_uc_miyao ( "chkUsernameExist", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/chkUsernameExist';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	
	function OAuth($reg_type, $reg_sign, $reg_channel) {
		$arg = array ();
		$arg ['username'] = $reg_type;
		$arg ['reg_sign'] = $reg_sign;
		$arg ['reg_channel'] = $reg_channel;
		$arg ['secret_key'] = $this->gre_uc_miyao ( "OAuth", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/OAuth';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
	function chgUserState($uid, $state) {
		$arg = array ();
		$arg ['uid'] = $uid;
		$arg ['state'] = $state;
		
		$arg ['secret_key'] = $this->gre_uc_miyao ( "chgUserState", $arg );
		
		$url = C ( "UC_API_HOST" ) . '/User/chgUserState';
		try {
			$ret = $this->curl_post ( $url, $arg );
			$ret = json_decode ( $ret, 1 );
			return $ret;
		
		} catch ( Exception $e ) {
			return $this->q_error ( $e->getMessage () );
		}
	
	}
}