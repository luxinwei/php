<?php
// 
class EmailCodeAction extends QAction {
	
	/**
	 * 邮件验证码
	 */
	function send() {
		$email = $this->q_param( 'email' );
		$type = $this->q_param( 'type' );
		
		$EmailModel = D('EmailCode');
			
		if (empty ( $email )) {
			return $this->q_error ( "请输入邮箱" );
		}
		if (! Chker::isEmail ( $email )) {
			return $this->q_error ( "邮箱格式不正确" );
		}
		$code=	$EmailModel->sendEmail($email,$type);
		
		return $this->q_success ($code);
	
	}

	function chkEmailCode() {
	    $user_code = $this->q_param( 'code' );
	    $email = $this->q_param( 'email' );
		$type = $this->q_param( 'type');
		$EmailModel = D('EmailCode');
		if ($EmailModel->chkEmailCode_tool ($email, $user_code,$type)) {
			return $this->q_success ( "验证成功!" );
		} else {
			return $this->q_error ( "验证码错误" );
		}
	}
}  


