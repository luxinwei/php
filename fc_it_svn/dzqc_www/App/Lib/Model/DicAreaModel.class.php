<?php

class DicAreaModel extends QModel {
	function getListByDepth($depth) {
		$where = "depth={$depth}";
		$list = $this->q_getList ( $where );
		return $list;
	}
	
	function getListByPid($pid) {
		$where = "pid={$pid}";
		$list = $this->q_getList ( $where );
		return $list;
	}
	
	function getListByCondition($pid,$depth){
		$where = " pid={$pid} and depth={$depth} ";
		$list = $this->q_getList($where);
		return $list;
	}

}