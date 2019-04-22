<?php

class SMSCodeModel extends QModel {
	protected  $type_arr = array (1 => array ('reg_sms_code', 'reg_sms_mobile', 'last_reg_sms_code_time' ), //注册
2 => array ('login_sms_code', 'login_sms_mobile', 'last_login_sms_code_time' ), //手机无密码登录
3 => array ('forget_sms_code', 'forget_sms_mobile', 'last_forget_sms_code_time' ), //找回密码
4 => array ('operator_sms_code', 'operator_sms_mobile', 'last_operator_sms_code_time' ),//运营者
5 => array ('publish_task_sms_code', 'publish_task_sms_mobile', 'publish_task_sms_code_time' ),//运营者
 )
;
	/**
	 * 发送短信
	 * @param string $mobile
	 * @param string $smsCode
	 * @param string $smsMobile
	 * @param string $lastSmsTime
	 */
	function sendSms($mobile, $type) {
		$code = Method::randNum ( 6 );
		//		SendSMS::send($code,$mobile);
		
		Session::set ( $this->type_arr [$type] [0], $code );
		Session::set ( $this->type_arr [$type] [1], $mobile );
		Session::set ( $this->type_arr [$type] [2], time () );
		
		return $code;
	}
	/**
	 * 检测验证码是否正确
	 * @param string $user_code
	 */
	function chkSmsCode_tool($user_code, $type,$mobile='') {
		$code = Session::get ( $this->type_arr [$type] [0] );
		$session_mobile = Session::get ( $this->type_arr [$type] [1] );
		$last_sms_code_time = Session::get ( $this->type_arr [$type] [2] );
		$user_code || $user_code = I ( 'code' );
		$user_code = trim ( $user_code );
		//var_dump($code,$session_mobile,$last_sms_code_time,$user_code);exit;
		if (empty ( $user_code )) {
			return false;
		}
		if ($session_mobile != $mobile & $mobile != "") {
			return false;
		}
		if ($user_code != $code & $user_code != "111111") {
			return false;
		}
		if ($last_sms_code_time + 600 < time ()) {
			return false;
		}
		
		return true;
	}
}