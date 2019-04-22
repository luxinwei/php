<?php
class ComauthAction extends  QAction {
	function __construct() {
		parent::__construct ( "Company" );
		$this->q_model->isLogin();
	}
	/*实名认证页面1*/
	public  function   auth(){
		$info=$this->q_model->loginUser();
		$audit = $this->q_model->q_get($info['id'],'',array('audit','username'));
		if ($audit['audit']==0 ){//开始提交
			$this->assign('info',$audit);
		 return $this->display('auth1');
		}elseif ($audit['audit']==10) {//审核中
			$this->assign('info',$audit);
			return	$this->display('auth3');
		}elseif ($audit['audit']==20){//成功
			$this->assign('info',$audit);
			return	$this->display('auth4');
		}elseif ($audit['audit']==30){//失败
			$this->assign('info',$audit);
			return  $this->display('auth22');
		}
	}
	
	public  function  auth2(){
		$info=$this->q_model->loginUser();
		$audit = $this->q_model->q_get($info['id'],'',array('audit','username'));
		$this->assign('info',$audit);
		$this->display('auth2');
	}
	
	/**点击确定跳转审核中页面**/
	public  function  auth21(){
		$info=$this->q_model->loginUser();
		$audit = $this->q_model->q_get($info['id'],'',array('audit','username'));
		if ($audit['audit']==0 ){
			$this->assign('info',$audit);
		 return	$this->display('auth1');
		}elseif ($audit['audit']==10) {
			$this->assign('info',$audit);
		 return	$this->display('auth21');
		}elseif ($audit['audit']==20){
			$this->assign('info',$audit);
		 return	$this->display('auth4');
		}elseif ($audit['audit']==30){
			$this->assign('info',$audit);
		 return	$this->display('auth22');
		}
	}
	
	
	

	/*实名认证数据2**/
	function  realNameAuth(){
		$userinfo = $this->q_model->loginUser();//获得登录者的详细信息
		$uid = $userinfo['id'];
		$list = $this->q_model->q_get($uid,null,array('audit'));
		if ($list['audit']==10 || $list['audit']==20){
			return  $this->error('不允许重复认证！！',U('Comauth/auth21'));
		}else{
			$data = I('post.');
			$seat_of=I('seat_of');
			$data['seat_of'] = implode ( '-', $seat_of );//公司地址
			$data['audit']=10;//审核状态
			$codeModel = D('SMSCode');
			if (empty($data['companyname'])){
				return  $this->error('公司名称不能为空！');
			}
			if (empty($data['operators_phone'])){
				return  $this->error('运营者手机号不能为空！');
			}
			if (empty($data['lega_lperson'])){
				return  $this->error('公司法人不能为空！');
			}
			if(empty($data['industry'])){
				return  $this->error('公司行业不能为空！');
			}
			if (empty($data['companyimage'])){
				return  $this->error('营业证书图片不能为空！');
			}
			if (empty($data['reg_number'])){
				return  $this->error('营业执照注册号不能为空！');
			}
			if (empty($data['capital'])){
				return  $this->error('注册资金不能为空！');
			}
			if (empty($data['seat_of'])){
				return  $this->error('总部所在地不能为空！');
			}
			if (empty($data['card_name'])){
				return  $this->error('运营者身份证姓名不能为空！');
			}
			if (empty($data['id_card_number'])){
				return  $this->error('运营者身份证号不能为空！');
			}
			if (empty($data['card_image'])){
				return  $this->error('身份证图片上传不能为空！');
			}
			if (empty($data['seal_picture'])){
				return  $this->error('合照盖章图片不能为空！');
			}
			$info = $this->q_model->q_save($data,$uid);
			if ($info){
				return  $this->success('已提交,正在审核！！',U('Comauth/auth3'));
			}else {
				return  $this->error('提交失败');
			}
		}
	}
	/**重新认证**/
	public  function  reCertification(){
		$userinfo = $this->q_model->loginUser();//获得登录者的详细信息
		$uid = $userinfo['id'];
		$list = $this->q_model->q_get($uid,null,array('audit'));
		if ($list['audit']==10 || $list['audit']==20){
			return  $this->error('不允许重复认证！！',U('Comauth/auth21'));
		}else{
			$data['audit']=0;//审核状态
			$info = $this->q_model->q_save($data,$uid);
			if ($info){
				return  $this->success('已开始重新认证！！',U('Comauth/auth1'));
			}else {
				return  $this->error('重新认证失败');
			}
		}
	}
	/**多文件上传**/
	Public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 10000000000 ;// 设置附件上传大小
		$upload ->allowTypes = array('image/png','image/jpg','image/pjpeg','image/gif','image/jpeg');
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Uploads/';// 设置附件上传目录
		if(!$upload->upload() ){// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			return $info =  $upload->getUploadFileInfo();
		}
	}


}