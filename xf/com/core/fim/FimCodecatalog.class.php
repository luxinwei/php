<?php
include_once (dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class FimCodecatalog {
	public $tablename = "fim_codecatalog";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	function __construct() {
	}
	function __destruct() {
	}
	 function getCatalogTitle($codeno){
		$row = self::getOne($codeno);
		return $row[CODENAME];
	}
	function getOne($keyvalue) {
		$row = DB::getInstance()->getOneObjByKey( $this->tablename,"CODENO", $keyvalue );
		return $row;
	}
	/* */
	function getAllList(){
		$sql_select="select * from ".$this->tablename." order by kind,codeno";
		$list = DB::getInstance()->execQuery($sql_select);
		return $list;
	}
}
?>