<?php
require_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class CsmMember {
	 public  $tablename="csm_member";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	 function getOneByUsercode($usercode){
	 	$sql="select * from csm_member where usercode='".$usercode."'";
	 	$row=DB::getInstance()->getOneObjBySql($sql);
	 	return $row;
	 }
	 function getOneByAccount($useraccount){
	 	$sql="select * from csm_member where useraccount='".$useraccount."'";
	 	$row=DB::getInstance()->getOneObjBySql($sql);
	 	return $row;
	 }
	 function getOneByEmail($email){
	 	$sql="select * from csm_member where email='".$email."'";
	 	$row=DB::getInstance()->getOneObjBySql($sql);
	 	return $row;
	 }
	 function getOneByMobile($mobile){
	 	$sql="select * from csm_member where mobile='".$mobile."'";
	 	$row=DB::getInstance()->getOneObjBySql($sql);
	 	return $row;
	 }
	 
	 function getNewCode(){
	 	$newCode="";
	 	$sql_select="select MAX(USERCODE) MAXID from csm_member";
	 	$row=DB::getInstance()->getOneObjBySql($sql_select);
	 	$newCode=Fun::getInt($row["MAXID"], 1000000000)+1;
	 	return $newCode;
	 }


}
?>