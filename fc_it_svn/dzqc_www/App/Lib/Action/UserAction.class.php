<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends QAction {
	function __construct() {
		parent::__construct ( "User" );
		$this->q_model->isLogin();
	}
	/*注册页面*/
	public function reg(){
		return $this->display('User/reg');
	}
	/*注册*/
    public function regAct(){
    	
    	$mobile = I('post.mobile');
    	$verify = I('post.verify');  
    	$password = I('post.password');
    	$repassword = I('post.repassword');
    	$codeModel = D('Code');
    	$smsModel = D ( 'SMSCode' );
    	$userModel = D('User');
    	
	    if (empty ( $mobile )) {
			return $this->error ( "请输入手机号" );
		}
		if (! Chker::isMobile ( $mobile )) {
			return $this->error ( "手机号格式不正确" );
		}
    	
    	if ($userModel->getByMobile($mobile)) {
			return $this->error ( "该手机号已注册" );
		}
		if (empty ( $password )) {
			return $this->error ( "请输入密码" );
		}
		if (! Chker::len ( $password, 6, 20 )) {
			return $this->error ( "密码格式不正确" );
		}
    	if ($password != $repassword){
    		return $this->error('2次密码输入不一致');
    	}
	    if (empty ( $verify )) {
			return $this->error ( "请输入验证码" );
		}
		
		if (! $smsModel->chkSmsCode_tool ($verify,1)) {
			return $this->error ( "验证码错误" );
		}
    	
    	$res = $userModel->reg($mobile,$password);
    	//var_dump($res);exit;
    	if ($res){
    		return $this->success('注册成功',U('User/login'));
    	}else{
    		return $this->error('注册失败');
    	}
    	
    }
   /*登陆页面*/
    public function login(){
    	return $this->display('User/login');
    }
    /*登陆*/
    public function loginAct(){
     	$username = $this->q_param( 'name' );
		$password = $this->q_param( 'password' );
		$autoLogin = $this->q_param( 'autoLogin' );
		$userModel = D('User');
		if (! Chker::isMobile ( $username )) {
			return $this->error ( "手机号格式不正确" );
		}
		if (empty ( $username )) {
			return $this->error ( "请输入已注册的手机号" );
		}
		if (empty ( $password )) {
			return $this->error ( "请输入密码" );
		}
		if (! Chker::len ( $password, 6, 20 )) {
			return $this->error ( "密码格式不正确" );
		}
			
		$ret = $userModel->login ( $username, $password );
		//var_dump($ret);exit;
		if ($ret['state'] == 1) {
			if ($autoLogin){
				//一周内自动登陆
				$time = 7*86400+time();
				$str = $time.$ret['mobile'].$password;
				import('ORG.Crypt.Base64');
				$value = Base64::encrypt($str, C("M_API_MIYAO"));
				Method::setCookie("autologin", $value, 7*86400);
				//print_r($str);exit;
			}
			return $this->success ('登陆成功',U('StudentAudit/auditOne') );
		}else {
			return $this->error ( $ret['info'], U('User/login') );
		}
     	
     }
     /*忘记密码第一步--页面*/
    public function forgetPwd(){
    	return $this->display('User/forget');
    }
    /*忘记密码第一步--验证手机号*/
    public function forgetPwdAct(){
    	
    	$name = $this->q_param('name');
//    	$verify = $this->q_param('verify');
    	$code = $this->q_param('code');
    	$smsModel = D('SMSCode');
    	$codeModel = D('Code');
    	$userModel = D('User');
    	
    	if (empty ( $name )) {
			return $this->error ( "请输入手机号" );
		}
		if (! Chker::isMobile ( $name )) {
			return $this->error ( "手机号格式不正确" );
		}
    	
    	if (!$userModel->getByMobile($name)) {
			return $this->error ( "该手机号还没有注册" );
		}
    	
//    	if (!$codeModel->chkVerify($verify)){
//    		return $this->error('当前输入图片验证码错误！');
//    	}
    	
		if(!$smsModel->chkSmsCode_tool($code,3,$name)){
			return $this->error('当前输入发送验证码错误！');
		}
		$info = $userModel->getByMobile ( $name );
    	if ($info){
			$codeModel->setSession($codeModel->value_arr[1][0], $info);
    		return $this->redirect('User/resetPwd');
    		//return $this->success('已查到您的信息，请重置您的密码',U('User/resetpwd'));
    	}else{
    		return $this->error('未查到该手机信息');
    	}
    	
    }
    /*忘记密码第二步--页面*/
    public function resetPwd(){
    	return $this->display('User/reset');
    }
   /* 忘记密码第二步--重置密码*/
    public function resetPwdAct(){
    	$codeModel = D('Code');
    	$userModel = D('User');
    	$userData = $codeModel->getSession($codeModel->value_arr[1][0]);
    	if (empty($userData)){
    		return $this->error('非法操作',U('User/forgetPwd'));
    	}else{
	    	$password = $this->q_param('password');
	    	$repassword = $this->q_param('repassword');
	    	if (empty ( $password )) {
				return $this->error ( "密码不能为空" );
			}
	    	if (empty ( $repassword )) {
				return $this->error ( "确认密码不能为空" );
			}
	    	if ($password != $repassword){
	    		return $this->error('2次输入密码不一致');
	    	}

	    	$info = $userModel->editPassword( $userData ['id'], "FORGET_PASSWORD", $password);
	    	if ($info){
				$codeModel->setSession($codeModel->value_arr[1][0]);
	    		return $this->success('您的密码已重置，请重新登陆',U('User/login'));
	    	}else{
    			$codeModel->setSession($codeModel->value_arr[1][0]);
	    		return $this->error('密码重置失败');
	    	}
    	}
    }
    function modifyPwd() {
    	return $this->display('User/change');
    }
    
	/**修改密码**/
	function modifyPwdAct() {
		$user_info = $this->q_model->loginUser ();
		if (empty ( $user_info )) {
			return $this->isLogin ();
		} else {
			$user_pwd = $this->q_model->q_get ( $user_info ['id'], array ('password' ) );
			$old_pwd = $this->q_param ( 'oldPwd' );
			$new_pwd = $this->q_param ( 'newPwd' );
			$re_new_pwd = $this->q_param ( 'reNewPwd' );
			if (empty ( $old_pwd )) {
				return $this->error ( '原始密码不能为空！' );
			}
			if (empty ( $new_pwd )) {
				return $this->error ( '新密码不能为空！' );
			}
			if (empty ( $re_new_pwd )) {
				return $this->error ( '确认密码不能为空！' );
			}
			if ($re_new_pwd) {
				if ($re_new_pwd != $new_pwd)
				return $this->error ( '2次修改密码输入不一致！' );
			}
			$ret = $this->q_model->editPassword ( $user_info ['id'], $old_pwd, $new_pwd );
			return $this->success('修改成功',U('User/login'));
		}
	}
  
    /*登出*/
    public function logout(){
    	$this->q_model->logout();
    	return $this->success('登出成功', U('User/login'));
    }
   
   
}