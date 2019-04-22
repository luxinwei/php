<?php
class CompanyAction extends CommonAction{
	/*
	 * 输入数据到页面
	 * */
	public  function  realNameAuth(){
		$comModel = D('Company');
		$this->info = $comModel->q_getList('audit!=0','regtime',1);
		$this->q_pageList($this->info);
		$this->display();
	}
	/*
	 * 修改页面
	 * */
	public  function updateAudit(){
		$id = $this->q_param('id');
		$comModel = D('Company');
		$this->info = $comModel->q_get($id);
		$this->display();
	}
	//通过审核判断处理表单
	public  function  updateAuditHandle(){
		$data = I('post.');
		$id = $data['id'];
		$comModel = D('Company');
		$res = $comModel->q_save($data,$id);  //更新信息
		if ($res){
			$audit = $comModel->q_get($id,'',array('audit'));
			if($audit['audit']==0){
				return $this->q_error('未认证',U('Company/realNameAuth'),0);
			}elseif($audit['audit']==10){
				return $this->q_error('认证中',U('Company/realNameAuth'),0);
			}elseif ($audit['audit']==20){
				return $this->q_success('认证通过',U('Company/realNameAuth'),0);
			}elseif ($audit['audit']==30){
				return $this->q_error('认证失败',U('Company/realNameAuth'),0);
			}
		}else{
			return $this->q_error('修改失败',U('Company/realNameAuth'),0);
		}
	}
	//删除实名认证信息
	public  function  	deleteAudit(){
		$id = $this->q_param('id');
		$comModel = D('Company');
		$data['companyname']=null;
		$data['lega_lperson']=null;
		$data['companyimage']=null;
		$data['reg_number']=null;
		$data['capital']=null;
		$data['seat_of']=null;
		$data['card_name']=null;
		$data['id_card_number']=null;
		$data['operators_phone']=null;
		$data['card_image']=null;
		$data['seal_picture']=null;
		$data['industry']=null;
		$data['audit']=0;
		$res =$comModel->q_save($data,$id);
		if($res){
			return $this->q_success('清除实名认证成功',U('Company/realNameAuth'),0);
		}else{
			return $this->q_error('清除实名认证失败',U('Company/realNameAuth'),0);
		}
	}
}