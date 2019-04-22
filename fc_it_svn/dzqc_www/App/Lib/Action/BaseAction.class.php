<?php
class BaseAction extends QAction{
	function __construct() {
		parent::__construct ( "User" );
		if ($_COOKIE['autologin']){
			$str = Method::getCookie("autologin");
	   		
	   		import('ORG.Crypt.Base64');
			$value = Base64::decrypt($str, C("M_API_MIYAO"));
					
			$cookie_time = substr($value, 0, 10);
			$cookie_name = substr($value, 10, 11);
			$cookie_pwd = substr($value, 21);
			//var_dump($value);var_dump($cookie_name);var_dump($cookie_pwd);
			if ($cookie_time<time()){
				Method::setCookie("autologin"); //清除cookie
				redirect(U('User/login'),3,'请重新登陆');
			}else{
				$ret = $this->q_model->login ( $cookie_name, $cookie_pwd);
				//var_dump($ret);exit;
				if ($ret['state'] ==1 ){
					//redirect(U('Index/index'),3,'登陆成功');
				}else{
					redirect(U('User/login'),3,'手机号或密码错误');
				}
			}
		}else{
			$ret = $this->q_model->loginUser();
			if ($ret){
				//redirect(U('Index/index'),3,'登陆成功');
			}else{
				redirect(U('User/login'),3,'请登陆');
			}
		}
	}
	
	
}