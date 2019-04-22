<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/ParaUtil.class.php");


class InterfaceUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	
	function getList($loginName,$pwd,$appCode,$uri){
		$rooturl=ParaUtil::getInstance()->getContent("XFURL");
		header("Content-type: text/html; charset=utf-8");
		$postParams=array();
		$getprams_str="";
		
		$randVal=Fun::getUUID();
		$pwdHash=base64_encode(sha1($pwd.$randVal));
		$ursl=$rooturl."/".$uri;
		if(substr_count($ursl,"?")==0){
			$ursl.="?";
		}else{
			$ursl.="&";
		}
		
		$ursl.="loginName=".$loginName;
		$ursl.="&appCode=".$appCode;
		$ursl.="&randVal=".$randVal;
		$ursl.="&pwdHash=".$pwdHash;
		$ursl.=$getprams_str;
		$data=Fun::http_request($ursl);
		return $data;
	}
	
	
	
	function getDetail($loginName,$pwd,$appCode,$uri){
		$rooturl=ParaUtil::getInstance()->getContent("XFURL");
		header("Content-type: text/html; charset=utf-8");
		$postParams=array();
		$getprams_str="";
	
		$randVal=Fun::getUUID();
		$pwdHash=base64_encode(sha1($pwd.$randVal));
		$ursl=$rooturl."/".$uri;
		if(substr_count($ursl,"?")==0){
			$ursl.="?";
		}else{
			$ursl.="&";
		}
		$ursl.="loginName=".$loginName;
		$ursl.="&appCode=".$appCode;
		$ursl.="&randVal=".$randVal;
		$ursl.="&pwdHash=".$pwdHash;
		$ursl.=$getprams_str;
		$data=Fun::http_request($ursl);
		echo $data;

	}
	

	
	
}
?>