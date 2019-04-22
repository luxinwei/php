<?php
class AdminUserModel extends QModel {
	
	function loginUser() {
		$user = array ();
		if (! empty ( $_SESSION [C ( "USER_AUTH_KEY" )] )) {
			$user ['id'] = $_SESSION [C ( "USER_AUTH_KEY" )];
			$user ['username'] = $_SESSION ['username'];
		}
		
		return $user;
	}
	function chkLogin() {
		$user=$this->loginUser();
		if(empty($user)){
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( U ( "/" ), 5, "您尚未登录，请先登录" );
		}
	}
}
