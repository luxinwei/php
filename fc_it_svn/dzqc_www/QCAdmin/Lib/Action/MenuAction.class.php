<?php
class MenuAction extends CommonAction {
	function myList() {
		$AdminUserModel = D ( 'AdminUser' );
		$user = $AdminUserModel->loginUser ();
		
		$AdminAccessModel = D ( 'AdminAccess' );
		$nodeList = $AdminAccessModel->getNodeListByUser ( $user ['id'] );
		
		$menuTree = Tree::get ( $nodeList ['rows'], 0 );
		var_dump ( $menuTree );
	}

}