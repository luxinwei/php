<?php
class QModel extends Model {
	protected static $blankList = array ('rows' => array (), 'total' => 0 );
	protected $ret = array ('status' => 1, 'info' => '' );
	protected function filterData($arrData, $allowField = array(), $notAllowFileds = array()) {
		$ret = array ();
		foreach ( $arrData as $field => $value ) {
			if (! empty ( $allowField ) && ! in_array ( $field, $allowField )) {
				continue;
			}
			if (! empty ( $notAllowFileds ) && in_array ( $field, $notAllowFileds )) {
				continue;
			}
			if ($value === null) {
				continue;
			}
			
			$ret [$field] = $value;
		}
		return $ret;
	}
	public function q_add($data, $allowField = array(), $notAllowFileds = array()) {
		$data = $this->filterData ( $data, $allowField, $notAllowFileds );
		$flag = $this->add ( $data );
		if ($flag === false) {
			return $this->q_error ();
		} else {
			return $this->q_success ( $flag );
		}
	}
	public function q_edit($data, $id = '', $where = '', $allowField = array(), $notAllowFileds = array()) {
		$data = $this->filterData ( $data, $allowField, $notAllowFileds );
		if (! empty ( $id )) {
			$where = "`" . $this->getPk () . "` ={$id}";
		}
		if (empty ( $where )) {
			
			return $this->q_error ();
		
		}
		$flag = $this->where ( $where )->save ( $data );
		if ($flag === false) {
			return $this->q_error ();
		} else {
			return $this->q_success ();
		}
	}
	function q_save($data, $id = '', $where = '', $allowField = array(), $notAllowFileds = array()) {
		$data = $this->filterData ( $data, $allowField, $notAllowFileds );
		if (! empty ( $id )) {
			$where = "`" . $this->getPk () . "` ={$id}";
		}
		if (empty ( $where )) {
			
			return $this->q_error ();
		
		}
		if (empty ( $id ) && empty ( $where )) {
			return $this->q_add ( $data, $allowField, $notAllowFileds );
		} else {
			return $this->q_edit ( $data, $id, $where, $allowField, $notAllowFileds );
		}
	
	}
	public function q_delete($id = '', $where = '') {
		
		if (! empty ( $id )) {
			$arrId = explode ( ',', $id );
			foreach ( $arrId as &$aid ) {
				if (! is_numeric ( $aid )) {
					$aid = "'$aid'";
				}
			}
			$id = implode ( ',', $arrId );
			
			$where = "`" . $this->getPk () . "`  in ($id)";
		}
		
		$flag = $this->where ( $where )->delete ();
		if ($flag === false) {
			return $this->q_error ();
		} else {
			return $this->q_success ();
		}
	}
	public function q_get($id = '', $where = '', $fields = array()) {
		if (! empty ( $id )) {
			$where = "`" . $this->getPk () . "` ={$id}";
		}
		$result = $this->where ( $where )->field ( $fields )->find ();
		return $result;
	}
	public function q_gets($ids = '', $where = '', $fields = array()) {
		if (! empty ( $ids )) {
			$arrId = explode ( ',', $ids );
			foreach ( $arrId as &$aid ) {
				if (! is_numeric ( $aid )) {
					$aid = "'$aid'";
				}
			}
			$id = implode ( ',', $arrId );
			
			$where = "`" . $this->getPk () . "`  in ($id)";
		}
		$result = $this->where ( $where )->field ( $fields )->select ();
		return $result;
	}
	public function q_getList($where = '', $order = null, $isPage = false, $end = false, $start = false, $fields = array()) {
		if (is_string ( $fields )) {
			//			$fields = array ($fields );
		}
		$sql = "select count(*) as count from " . $this->getTableName ();
		if (! empty ( $where )) {
			$sql .= " where $where";
		}
		$result ['total'] = $this->q_getOne ( $sql );
		
		if ($isPage) {
			$objPager = new QPage ( $result ['total'] );
			$start = $objPager->firstRow;
			$end = $objPager->listRows;
		}
		if (! empty ( $fields )) {
			if (is_array ( $fields )) {
				$f = '';
				foreach ( $fields as $fv ) {
					$f .= '`' . $fv . '`,';
				}
				$f = rtrim ( $f, ',' );
			} else {
				$f = $fields;
			}
		} else {
			$f = "*";
		}
		$sql = "select $f from " . $this->getTableName ();
		
		if (! empty ( $where )) {
			$sql .= " where $where";
		}
		if (! empty ( $order )) {
			$sql .= ' order by ' . $order;
		}
		if($start>0 or $end>0){
			$sql .= " limit {$start},{$end}";
		}
		
		$result ['rows'] = $this->db->query ( $sql );
		
		return $result;
	}
	function q_getOne($sql) {
		$temp = $this->db->query ( $sql );
		if (! empty ( $temp [0] )) {
			$temp = array_values ( $temp [0] );
			return $temp [0];
		} else {
			
			return false;
		}
	}
	
	function q_pageList($from, $fields) {
		$fullSql = "select count(*) as total from (select $fields from $from ) qtable";
		$result ['total'] = $this->q_getOne ( $fullSql );
		
		$objPager = new QPage ( $result ['total'] );
		$start = $objPager->firstRow;
		$end = $objPager->listRows;
		
		$fullSql = "select $fields from $from";
		$fullSql .= " limit {$start},{$end}";
		$result ['rows'] = $this->db->query ( $fullSql );
		return $result;
	}
	function q_alist($from, $fields, $limit = false, $start = false, $order = null) {
		$fullSql = "select count(*) as total from (select $fields from $from ) qtable";
		$result ['total'] = $this->q_getOne ( $fullSql );
		$fullSql = "select $fields from $from";
		$result ['rows'] = $this->db->query ( $fullSql );
		return $result;
	}
	function q_lastInsertID() {
		return $this->getLastInsID ();
	}
	function q_count($where = '') {
		return $this->where ( $where )->count ();
	}
	function q_isExist($where = '') {
		if ($this->q_count ( $where ) == 0) {
			return false;
		} else {
			return true;
		}
	}
	function q_error($msg = '', $isException = false) {
		if ($isException && is_string ( $msg )) {
			throw new Exception ( $msg );
		}
		if (is_array ( $msg )) {
			$this->ret ['status'] = isset ( $msg ['status'] ) ? $msg ['status'] : 0;
			$this->ret = array_merge ( $this->ret, $msg );
		} else {
			$this->ret ['status'] = 0;
			$this->ret ['info'] = $msg;
		}
		return $this->ret;
	}
	function q_success($msg = '') {
		if (is_array ( $msg )) {
			$this->ret ['status'] = isset ( $msg ['status'] ) ? $msg ['status'] : 1;
			$this->ret = array_merge ( $this->ret, $msg );
		} else {
			$this->ret ['status'] = 1;
			$this->ret ['info'] = $msg;
		}
		return $this->ret;
	}
	function q_ret($flag = 1, $msg = '') {
		$this->ret ['status'] = $flag;
		$this->ret ['info'] = $msg;
		return $this->ret;
	}
	
}

?>