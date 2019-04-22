<?php
class AdminAccessModel extends QModel {
	function getNodeListByRoles($roles) {
		
		$AdminNodeModel = D ( 'AdminNode' );
		$T_AdminNodeModel = $AdminNodeModel->getTableName ();
		$T_AdminAccessModel = $this->getTableName ();
		
		$from = " {$T_AdminAccessModel} a,{$T_AdminNodeModel} b 
		
		where a.node_id=b.id and a.role_id in({$roles}) and b.status=1 and b.isshow=1";
		$fields = "b.*";
		$list = $this->q_alist ( $from, $fields );
		return $list;
	}
	
	function getNodeListByUser($uid) {
		if ($uid == 1) {
			$AdminNodeModel = D ( 'AdminNode' );
			$list = $AdminNodeModel->q_getList ( "status=1 and isshow=1" );
			return $list;
		}
		
		$AdminRoleUserModel = D ( 'AdminRoleUser' );
		
		$roleList = $AdminRoleUserModel->getByUid ( $uid );
		$role_str = "0";
		foreach ( $roleList ['rows'] as $row ) {
			$role_str .= ",{$row[role_id]}";
		}
		
		return $this->getNodeListByRoles ( $role_str );
	}
}
