<?php
class IdeasAction extends QAction {
	function __construct() {
		parent::__construct ( "Ideas" );
		$UserModel = D ( 'User' );
		$UserModel->isRealNameAudit ();
	}
    public function getMyList(){
    	$comModel=D('Company');
    	$list=$this->q_model->getMyList();
    	foreach ($list['rows'] as $k=>&$v){
    		$username=	$comModel->q_get($v['uid'],null,array('username'));
    		foreach ($username as $ks=>&$vs){
    			$v['username']=$vs;
    		}
    	}
    	$this->q_pageList($list);
    	//print_r($list);die;
		$this->display("MyList");
    }
	public function detail(){
    	$id=I('id');
    	$comModel=D('Company');
    	
    	$bean=$this->q_model->q_get($id);
    	$username=$comModel->q_get($bean['uid'],null,array('username'));
    	foreach ($username as $k=>$v){
    		$bean['username']=$username['username'];
    	}
    	//print_r($bean);die;
    	$this->assign('bean',$bean);
		$this->display("detail");
    }
	public function agree(){
    	$id=I('id');
		if (empty($id)){
			return $this->q_error('id为空');
		}
		$userModel = D('User');
		$userData = $userModel->regetLoginUser();
		$ideasModel = D('Ideas');
		$updateAgree = $ideasModel->updateAgree($id,$userData['id']);
		if ($updateAgree){
			return $this->q_success('点赞成功');
		}else {
			return $this->q_error('您已经点赞过了');
		}
//    	$this->q_model->where('id='.$id)->setInc('agree');
    	return   $this->q_success("成功！");
    }
    
}