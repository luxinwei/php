<?php
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class FimUploadCol {
	 public  $tablename="fim_upload_col";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	 function getOne($keyvalue){
		$row=DB::getInstance()->getOneObjByKey($this->tablename,"UPLOADCOLKEY", $keyvalue);
		return $row;
	 }


}
?>