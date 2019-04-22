<?php
class AuditAction extends CommonAction{
	//实名认证列表
	public function realNameAudit(){
		$userModel = D('User');
		$this->audit = $userModel->q_getList('audit !=0','user_no',1);
		
		$this->q_pageList($this->audit);
		
		$this->display();
	}
	//修改认证页面
	public function updateAudit(){
		$id = $this->q_param('id');
		$userModel = D('User');
		$this->info = $userModel->q_get($id);
		$this->display();
	}
	//审核认证处理表单
	public function updateAuditHandle(){
		$data = I('post.');
		$id = $data['id'];
		$userModel = D('User');
		$res = $userModel->q_save($data,$id);  //更新信息
		if ($res){
			$audit = $userModel->q_get($id,'',array('audit'));
			if($audit['audit']==0){
				return $this->q_error('未认证',U('Audit/realNameAudit'),0);
			}elseif($audit['audit']==10){
				return $this->q_error('认证中',U('Audit/realNameAudit'),0);
			}elseif ($audit['audit']==20){
				return $this->q_success('认证通过',U('Audit/realNameAudit'),0);
			}elseif ($audit['audit']==30){
				return $this->q_error('认证失败',U('Audit/realNameAudit'),0);
			}
		}else{
			return $this->q_error('修改失败',U('Audit/realNameAudit'),0);
		}
	}
	//清除实名认证信息
	public function clearAudit(){
		$id = $this->q_param('id');
		$userModel = D('User');
		$data = array(
			'realname' => '',
			'user_no'  => '',
			'id_card'  => '',
			'sex'      => '',
			'birthday' => '',
			'university' => '',
			'major'    => '',
			'student_and_photo' => '',
			'audit'    => 0,
			'school_years' => '',
		);
		$res =$userModel->q_save($data,$id);
		//echo $userModel->getLastSql();die;
		if($res){
			return $this->q_success('清除实名认证成功',U('Audit/realNameAudit'),0);
		}else{
			return $this->q_error('清除实名认证失败',U('Audit/realNameAudit'),0);
		}
	}
}