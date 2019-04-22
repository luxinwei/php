<?php
include_once (dirname(__FILE__)."/../../../com/base/util/DB.class.php");

class FimPara {
	public $tablename = "fim_para";
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	function getOne($keyvalue) {
		$row = DB::getInstance()->getOneObjByKey( $this->tablename,"PARACODE", $keyvalue );
		return $row;
	}
	function getOneByAll($code,$allList){
		$paranew=Array();
		foreach ($allList as $para){
			if($code==$para["PARACODE"]){
				$paranew=$para;
			}
		}
		return $paranew;
	}
	function getAllList(){
		$sql_select="select * from ".$this->tablename;
		$list = DB::getInstance()->execQuery($sql_select);
		return $list;
	}
}
?>