<?php
// 本类由系统自动生成，仅供测试用途
class CompanyAction extends QAction {
	function __construct() {
		parent::__construct ( "Company" );
	}
	public function active() {
		$code = I ( 'code' );
		$code = trim ( $code );
		if (empty ( $code )) {
			return $this->q_error ( "参数有误" );
		}
		$code = base64_decode ( $code );
		list ( $key, $time, $username ) = explode ( '*', $code );
		if ($time + 60 * 30 < time ()) {
			return $this->q_error ( "此链接已失效,请重新获取",'',0 );
		}
		$UCAPIModel=D('UCAPI');
		$apiData=	$UCAPIModel->getByUsername($username);
		$userData=$apiData['userData'];
		if(empty($userData)){
			return $this->q_error ( "无效链接",'/',0 );
		}
		if ($userData['state']!=0) {
			return $this->q_error ( "链接已失效",'/',0 );
		}
		$local_key=md5($userData['username'].$userData['password'].$time);
		if($local_key!=$key){
			return $this->q_error ( "无效链接",'/',0 );
		}
		$UCAPIModel->chgUserState($userData['id'],1);
		return $this->q_success("账户激活成功!",'/',0);
	}
	/**
	 * 注册
	 * */
	public  function  register(){
		$this->display('reg');
	}
	/**
	 * 登录
	 * */
	public  function  log(){
		$this-> display('login');
	}


	/**
	 * 提示页面
	 * **/
	public  function  emaillink(){
		$link=Session::get('emaillink');
		$this->assign('link',$link);
		$this->display('emaillink');
	}

	/**
	 * 注册
	 * */
	function reg(){
		$code=Session::get('verify');
		$verify=$this->q_param('verify');
		$email = $this->q_param ('email');
		$checkbox2=$this->q_param('checkbox2');
		$password = $this->q_param ('password' );
		$password2=$this->q_param('password2');
		if ($checkbox2 == ""){
//			return  $this->error('请同意用户协议');
		}
		if (empty ( $email )) {
			return	$this->error ( "请输入邮箱" );
		}
		if (! Chker::isEmail ( $email )) {
			return	$this->error ( "邮箱格式不正确" );
		}
		if (empty ( $password )) {
			return	$this->error ( "请输入密码" );
		}
		if (! Chker::len ( $password, 6, 20 )) {
			return	$this->error ( "密码格式不正确" );
		}
		if ($password !=$password2){
			return 	$this->error('2次密码不正确！');
		}
//		if($code !=md5($verify)) {
//			return	$this->error('验证码错误！');
//		}
		if (! $this->chkeEmail_tool ( $email )) {
			return	$this->error ( "该邮箱已存在" );
		}
		$companyModel = D ( "Company" );
		$ret = $companyModel->reg ( $email, $password );
		if ($ret) {
			return $this->success('注册成功',U('Company/emaillink'));
		} else {
			return $this->error ( $ret ['info'] );
		}
	}
	/**
	 * 登录
	 * */
	function login() {
		$name = I ( 'name' );
		$password = I ( 'password' );
		$action   =  I ('action');
		//print_r($name);
		//print_r($password);die;
		if (empty ( $name )) {
			return $this->error ( "请输入用户名" );
		}
		if (empty ( $password )) {
			return $this->error ( "请输入密码" );
		}
		$companyModel = D ( "Company" );
		$ret = $companyModel->login ( $name, $password );
		//echo $companyModel->getLastSql();
		//print_r($ret);die;
		if ($ret['state'] == 1) {
			if($action){
				//一周内自动登陆
				$time = 7*86400+time();
				$str = $time.'/'.$name.'/'.$password;
				import('ORG.Crypt.Base64');
				$value = Base64::encrypt($str, C("C_API_EMAIL"));
				Method::setCookie("action", $value, 7*86400);
			}
			return $this->success('登录成功',U('Comauth/auth'));
		}else{
			return $this->error('登录失败') ;
		}
	}
	/**
	 * 忘记密码第一步--页面
	 * */
	public  function  forgetPwd(){
		return $this->display('Company/forgetpwd');
	}

	/**
	 * 忘记密码第一步--检测邮箱
	 * **/
	public function forgetPwdAct() {

		$email = $this->q_param('email');
		$code = $this->q_param('code');
		$codeModel = D('EmailCode');
		$codModel=D('Code');
		if (empty($email)){
			return $this->error('邮箱不允许为空！');
		}
		if (empty($code)){
			return $this->error('发送验证码不允许为空！');
		}
		if ($this->chkeEmail_tool($email)){
			return $this->error('此邮箱还没有注册！');
		}
		$list=$codeModel->chkemailCode_tool($email,$code,1);
		if ($list==0 ){
			return $this->error('邮箱验证错误');
		}
		$info = $this->q_model->getByUsername ( $email );
		//print_r($info);die;
		if ($info){
			 $codModel->setSession("get_email_data", $info);
			return $this->success('已查到您的信息，请重置您的密码',U('Company/resetPwd'));
		}else{
			return $this->error('未查到该邮箱信息');
		}
	}
	/**
	 * 忘记密码第二步--页面
	 * **/
	public  function resetPwd(){
		$this->display('Company/resetpwd');
	}
	/**
	 * 忘记密码第二步--重置密码
	 * **/
	public  function  resetPwdAct(){
		$codModel=D('Code');
		$companyData = $codModel->getSession("get_email_data");
		//print_r($companyData);die;
		if (empty($companyData)){
			return $this->error('非法操作,请先验证邮箱',U('Company/forgetPwd'));
		}else{
			$password = $this->q_param('password');
			$repassword = $this->q_param('repassword');
			if (empty($password) || empty($repassword)){
				return $this->error('密码不允许为空！');
			}
			if ($password != $repassword){
				return $this->error('2次输入密码不一致');
			}

			$info = $this->q_model->editPassword( $companyData ['id'], "FORGET_PASSWORD", $password);
			if ($info){
				return $this->success('您的密码已重置，请重新登陆',U('Company/log'));
			}else{
				return $this->error('密码重置失败');
			}
		}
	}
	/**修改密码**/
	function modifyPwd() {
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
			return $this->success('修改成功','Index/index');
		}
	}
	/**退出登录**/
	function logout() {
		$companyModel = D ( "Company" );
		$companyModel->logout ();
		return $this->success('退出成功','log');
	}
	
	/**
	 * 验证码
	 * */
	
	Public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	
	/**
	 * 检验用户名是否存在
	 * **/
	function chkeEmail_tool($email) {
		$UCAPIModel = D ( 'UCAPI' );
		$api_ret = $UCAPIModel->chkUsernameExist ( $email );
		//var_dump($api_ret);
		if ($api_ret ['status'] == 1) {
			return false;
		}
		return true;
	}

		






}