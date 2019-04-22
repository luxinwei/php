<?php
include_once (dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class FimCodelibrary {
	public $tablename = "fim_codelibrary";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	function getOne($keyvalue) {
		$row = DB::getInstance()->getOneObjByKey ( $this->tablename,"ID", $keyvalue );
		return $row;
	}
	function getOneByItemno($codeno,$itemno) {
		$sql_select="select * from fim_codelibrary where codeno='".$codeno."' and itemno='".$itemno."'";
		$row = DB::getInstance()->getOneObjBySql($sql_select);
		return $row;
	}
	function getList($codeno){
		$sql_select="select * from fim_codelibrary where codeno='".$codeno."' order by orderindex";
		$list = DB::getInstance()->execQuery($sql_select);
		return $list;
	}
	function getOrderIndexInc($codeno) {
		$sql_select="select * from fim_codelibrary where codeno='".$codeno."' order by orderindex desc";
		$row = DB::getInstance()->getOneObjBySql($sql_select);
		$orderindex=Fun::getInt($row[ORDERINDEX],0)+1;
		return $orderindex;
	}
}
?>