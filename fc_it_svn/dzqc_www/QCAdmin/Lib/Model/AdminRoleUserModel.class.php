<?php
class AdminRoleUserModel extends QModel{
	function getByUid($uid) {
		$where="user_id={$uid}";
		
		return $this->q_getList($where);
	}
}
