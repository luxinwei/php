<?php
class StudentAuditAction extends QAction{
	function __construct() {
		parent::__construct ( "User" );
		//检查实名认证
		$userModel = D ( 'User' );
		$info = $userModel->regetLoginUser();
		$this->assign('info', $info);
	}
	
 /* 实名认证第一步--页面*/
    public function auditOne(){
    	$user = $this->q_model->regetLoginUser();
    	$audit = $this->q_model->q_get($user['id'],'',array('audit'));
    	//var_dump($audit);exit;
    	if($audit['audit'] == 0 || $audit['audit'] == 30 ){
    		return $this->display('StudentAudit/audit1');
    	}else{
    		if ($audit['audit'] == 10){
    			return $this->redirect('StudentAudit/audit31');
    		}elseif ($audit['audit'] == 20){
    			return $this->redirect('StudentAudit/audit4');
    		}
    	}
    }
   /* 实名认证第一步--同意协议*/
    public function auditOneAct(){
    	$codeModel = D('Code');
    	$userModel = D('User');
    	$user = $userModel->loginUser();
    	if (empty($user)){
    		return $this->error('请先登陆', U('User/login'));
    	}else{
	    	$audit = $userModel->q_get($user['id'],'',array('audit'));
	    	if($audit['audit']==10 || $audit['audit']==20){
	    		return $this->error('不允许重复认证',U('StudentAudit/auditThreeAct'));
	    	}else{
		    	$agree = $this->q_param('agreement');
		    	$codeModel->setSession($codeModel->value_arr[2][0] , $agree );
		    	return $this->redirect('StudentAudit/auditTwo');
		    	//return $this->success('下一步',U('User/auditTwo'));
	    	}
    	}
    }
    /* 实名认证第二步--页面*/
    public function auditTwo(){
    	return $this->display('StudentAudit/audit2');
    }
   /* 实名认证第二步--提交数据*/
    public function auditTwoAct(){
   		$user = $this->q_model->loginUser();
   		if (empty($user)){
    		return $this->error('请先登陆', U('User/login'));
    	}else{
	    	$audit = $this->q_model->q_get($user['id'],'',array('audit'));
	    	if($audit['audit']==10 || $audit['audit']==20){
	    		return $this->error('不允许重复认证');
	    	}else{
	    		$codeModel = D('Code');
	    		$agree = $codeModel->getSession($codeModel->value_arr[2][0] );
	    		if (empty($agree)){
	    			return $this->error('非法操作，请先同意协议',U('StudentAudit/auditOne'));
	    		}else{
			    	$uid = $user['id'];
					$data = I('post.');
					$data['audit'] = 10;  // 改变认证状态：认证中
					
					if (empty($data['realname'])){
						return $this->error('请填写您的真实姓名');
					}
					if (!Chker::isCard($data['id_card'])){
						return $this->error('请填写正确的身份证信息');
					}
					if (empty($data['user_no'])){
						return $this->error('请填写您的学号');
					}
					if (empty($data['university'])){
						return $this->error('请填写您的学校');
					}
					if (empty($data['major'])){
						return $this->error('请填写您的专业');
					}
					if (empty($data['school_years'])){
						return $this->error('请填写您的入学年份');
					}
					if (empty($data['student_and_photo'])){
						return $this->error('请上传您与学生证的合照');
					}
					
					
				
					//判断身份证号的位数
					if (strlen($data['id_card'])==18||strlen($data['id_card'])==17){
						//18位：413026 19920207 151(4)
						$data['birthday'] =strtotime(trim(substr($data['id_card'],6,4).'-'.substr($data['id_card'],10,2).'-'.substr($data['id_card'],12,2)));
						$data['sex'] = substr($data['id_card'],-4,3)/2 ? 1 : 2;
					}else{
						//15位：413026 920207 151
						$data['birthday'] =strtotime(trim('19'.substr($data['id_card'],6,2).'-'.substr($data['id_card'],8,2).'-'.substr($data['id_card'],10,2)));
						$data['sex'] = substr($data['id_card'],-3,3)/2 ? 1 : 2;
					}
					
					$res = $this->q_model->q_save($data,$uid);
					
					if ($res){
						return $this->redirect('StudentAudit/auditThree');
						//return $this->success('更新信息成功，正在认证中...',U('User/auditThree'));
					}else{
						return $this->error('您的操作不成功！');
					}
	    		}
	    	}
    	}
    }
	/* 实名认证第三步--页面*/
    public function auditThree(){
    	return $this->display('StudentAudit/audit3');
    }
   /* 实名认证第三步--审核*/
    public function auditThreeAct(){
    	$user = $this->q_model->loginUser();
    	$audit = $this->q_model->q_get($user['id'],'',array('audit'));
    	//var_dump($audit);exit;
    	if(empty($audit)){
    		return $this->error('非法操作，请先实名认证',U('StudentAudit/auditOne'));
    	}else{
    		if ($audit['audit'] == 10){
    			return $this->redirect('StudentAudit/audit31');
    		}elseif ($audit['audit'] == 20){
    			return $this->redirect('StudentAudit/audit4');
    		}elseif ($audit['audit'] == 30){
    			return $this->redirect('StudentAudit/audit32');
    		}
    	}
    }
	/* 实名认证第四步--页面*/
    public function auditFour(){
    	return $this->display('StudentAudit/audit4');
    }
}