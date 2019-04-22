<?php

class DicMajorModel extends QModel {
	function getListByIDS($ids) {
		$where="id in ({$ids})";
		return $this->q_getList($where);
	}

	function getNameById($id){
		$info = $this->q_get('',"id={$id}",array('name'));
		return $info['name'];
	}
}