<?php
	
class IndexAction extends CommonAction{
	public function index(){
		
		$AdminUserModel = D ( 'AdminUser' );
		$user = $AdminUserModel->loginUser ();
		
		$AdminAccessModel = D ( 'AdminAccess' );
		$nodeList = $AdminAccessModel->getNodeListByUser ( $user ['id'] );
		
		$menuTree = Tree::get ( $nodeList ['rows'], 0 );
//		var_dump($menuTree);
		$this->assign('menuTree',$menuTree);
		$this->assign('user',$user['username']);
		
		$this->display();
	}
}
