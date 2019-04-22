<?php
class CodeModel extends QModel{
	public $value_arr = array(1=>array('get_mobile_data'), //忘记密码验证手机信息
							  2=>array('get_agree_data'), //学生实名认证同意协议
	);
	public function getSession($name){
		return Session::get($name); 
	}
	
	public function setSession($name,$value){
		if ($value===null){
			//清除session
			return Session::set($name, 0);
		}else{
			return Session::set($name, $value);
		} 
	}
	
	public function chkVerify($verify){
		$ver = $this->getSession('verify');
		if ($ver != md5($verify)){
			return false;
		}
		return true;
	}
}