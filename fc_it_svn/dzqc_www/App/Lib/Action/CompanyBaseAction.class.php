<?php
class  CompanyBaseAction extends QAction {
	function __construct() {
		parent::__construct ( "Company" );
			if ($_COOKIE['action']){
					$str = Method::getCookie("action");	
					import('ORG.Crypt.Base64');
					$value = Base64::decrypt($str, C("C_API_EMAIL"));
					$data= explode('/', $value);
					//print_r($value);print_r($data);die;
				$cookie_time = $data['0'];
				$cookie_name =  $data['1'];
				$cookie_pwd =  $data['2'];
				if ($cookie_time<time()){
				Method::setCookie("action"); //清除cookie
				redirect(U('Company/log'),3,'请重新登陆');
			}else{
				$ret = $this->q_model->login ( $cookie_name, $cookie_pwd);
				//var_dump($ret);exit;
				if ($ret['state'] ==1 ){
					//redirect(U('Index/index'),3,'登陆成功');
				}else{
					redirect(U('Company/log'),3,'邮箱或密码错误');
				}
			}
		}else{
			$ret = $this->q_model->loginUser();
			if ($ret){
				//redirect(U('Index/index'),3,'登陆成功');
			}else{
				redirect(U('Company/login'),3,'请登陆');
			}
		}
	}
}