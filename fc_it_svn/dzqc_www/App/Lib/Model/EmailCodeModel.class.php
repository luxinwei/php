<?php

class EmailCodeModel extends QModel {
	public  $type_arr = array (1 => array ('forget_password_code', 'forget_password_email', 'last_forget_password_email_code_time' ) );//找回密码

	/**
	 * 发送邮件验证码
	 * @param string $mobile
	 * @param string $emailCode
	 * @param string $emailMobile
	 * @param string $lastemailTime
	 */
	function sendEmail($email, $type) {
		$code = Method::randNum ( 6 );
		
		$mailParams = array ();
		$mailParams ['to'] = $email;
		$mailParams ['subject'] = "您的验证码";
		$mailParams ['message'] = <<<aaa
<div style="padding:1em;">
<div>感谢您的使用!</div><div>&nbsp;</div><div><b>
您的此次验证码为：</b></div><div>
{$code}
</div><div>
-------------------------------------------------
----------------------------------</div><div><br></div><div>&nbsp;
aaa;
		Emailer::send ( $mailParams );
		
		Session::set ( $this->type_arr [$type] [0], $code );
		Session::set ( $this->type_arr [$type] [1], $email );
		Session::set ( $this->type_arr [$type] [2], time () );
		//print_r($code);die;
		return $code;
	}
	
	/**
	 * 检测验证码是否正确
	 * @param string $user_code
	 */
	function chkemailCode_tool($email, $user_code, $type) {
		$code = Session::get ( $this->type_arr [$type] [0] );
		
		$last_email_code_time = Session::get ( $this->type_arr [$type] [2] );
		
		$forget_email = Session::get ( $this->type_arr [$type] [1] );
		
		$user_code = trim ( $user_code );

		if ($forget_email != $email) {
			return false;
		}
		
		if (empty ( $user_code )) {
			return false;
		}
		if ($user_code != $code) {
			return false;
		}
		if ($last_email_code_time + 600 < time ()) {
			return false;
		}
		return true;
		}
}