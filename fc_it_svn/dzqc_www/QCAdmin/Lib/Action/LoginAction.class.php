<?php
/*
 * 登录
 */
class LoginAction extends QAction {
	// 检查用户是否登录
    protected function isLogin() {
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录','Login/index');
        }
    }
 	//用户登录视图
    public function index(){
         $this->display();
    }
 
    //用户登录处理表单
    public function loginHandle(){
        if(!IS_POST) halt('页面不存在，请稍后再试~');
       
//        if(session('verify') != I('param.verify','','md5')) {
//            $this->error('验证码错误', U('Admin/Login/index'));
//        }
 
        $user = I('username','','string');
        $passwd = I('password','','md5');
 		
        $userModel = M('AdminUser');
        $userinfo = $userModel->where("username = '$user' AND password = '$passwd'")->find();
       
        if(!$userinfo) $this->error('用户名或密码错误',U('Login/index'));
 
        if(!$userinfo['state']) $this->error('该用户被锁定，暂时不可登录', U('Login/index'));
 
        //更新登录信息
        $userModel->save(array("id"=> $userinfo["id"], "last_login_time"=> time(), "loginip" => get_client_ip()));
         //写入session值
         $_SESSION[C("USER_AUTH_KEY")] = $userinfo['id'];
         $_SESSION['username'] = $userinfo['username'];
         $_SESSION['last_login_time'] = $userinfo['last_login_time'];
         $_SESSION[C('loginip')] = $userinfo['loginip'];
 			//var_dump($_SESSION[C("USER_AUTH_KEY")]);exit;
       
        //如果为超级管理员，则无需验证
        if($userinfo['username'] == C('RBAC_SUPERADMIN')) {
            $_SESSION[C("ADMIN_AUTH_KEY")] = true;
        }
 
        //载入RBAC类
        import('ORG.Util.RBAC');
        //读取用户权限
        RBAC::saveAccessList();
 
        $this->success('登录成功',U('Index/index'));
    }
 
    //登出登录
    public function logout(){
    	if ($_SESSION[C("USER_AUTH_KEY")]){
    		unset($_SESSION[C("USER_AUTH_KEY")]);
    		unset($_SESSION);
	        session_destroy();
	        $this->success('登出成功！', U('Login/index'));
    	}else{
    		$this->error('已经登出！', U('Login/index'));
    	}
    }
 
    //验证码
    public function verify(){
        import('ORG.Util.Image');
    	Image::buildImageVerify();
    }
	//修改密码
    public function changePwd(){
    	$this->isLogin();
    	if (IS_POST){
	    	 //对表单提交处理进行处理或者增加非表单数据
	//        if(md5($_POST['verify'])	!= $_SESSION['verify']) {
	//            $this->error('验证码错误！');
	//        }
	
			$data = I('post.');
			$data['password'] = I('post.password');
			$data['repassword'] = I('post.repassword');
			if (empty($data['password'])){
				$this->error('密码不能为空');
			}
    		if ($data['password']!=$data['repassword']){
				$this->error('2次密码输入不一致');
			}
			$userModel = D('AdminUser');
			$res = $userModel->q_get($_SESSION[C("USER_AUTH_KEY")]);
			
			if ($res){
				$userModel->q_save(array('password'=>md5($data['password'])),$_SESSION[C("USER_AUTH_KEY")]);
				//echo $adminModel->getLastSql();exit;
				$this->success('修改密码成功',U('Index/index'));
			}else{
				$this->error('旧密码不符或者用户名错误！');
			}
	    }else{
			$this->display();	    
	    }
    }

}