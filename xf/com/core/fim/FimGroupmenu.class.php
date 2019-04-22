<?php
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class FimGroupmenu {
	 public  $tablename="fim_groupmenu";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	 function getOne($keyvalue){
		$row=DB::getInstance()->getOneObjByKey($this->tablename,"ID", $keyvalue);
		return $row;
	 }


}
?>