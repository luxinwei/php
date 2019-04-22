<?php
//header("Access-Control-Allow-Origin: *");
class SMSCodeAction extends QAction {
	
	/**
	 * 手机短信验证码
	 */
	function sendSmsCode() {
		$mobile = $this->q_param( 'mobile' );
		$type = $this->q_param( 'type' );
		$smsModel = D('SMSCode');
			
		if (empty ( $mobile )) {
			return $this->error ( "请输入手机号" );
		}
		if (! Chker::isMobile ( $mobile )) {
			return $this->error ( "手机号格式不正确" );
		}
		
		if ($type==1){
			//注册
			$userModel = D('User');
			$temp = $userModel->getByMobile ( $mobile );
			if (!empty($temp)) {
				return $this->error ( "该手机号已被注册" );
			}
		}
		
		$code=	$smsModel->sendSms($mobile,$type);
		//var_dump($code);
		//$code = json_encode($code);
		//echo $code;
		return $this->q_success ( $code );
	
	}

	function chkSmsCode() {
	    $user_code = $this->q_param( 'code' );
	    $mobile = $this->q_param( 'mobile' );
		$type = $this->q_param( 'type' );
		$smsModel = D('SMSCode');
		if ($smsModel->chkSmsCode_tool ( $user_code,$type,$mobile)) {
			return $this->success ( "验证成功!" );
		} else {
			return $this->error ( "验证码错误" );
		}
	}
}  


