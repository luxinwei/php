<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/ParaUtil.class.php");
include_once(dirname(__FILE__)."/../../authen/include/page/session_manage_info.php");
?>
<?php


//$loginName="13938503678";
//$pwd="123456";
//$rooturl="http://39.107.33.59:8080";
$loginName= $manageuseraccount;
$pwd      = $manageuserpwd;
$appCode  = $manageapptype;
$rooturl=ParaUtil::getInstance()->getContent("XFURL");
header("Content-type: text/html; charset=utf-8");
initcode1($loginName,$pwd,$appCode);
initcode2($loginName,$pwd,$appCode);
initArea($loginName,$pwd,$appCode);
function initcode1($loginName,$pwd,$appCode){
	$resutltJson=getFunData("dictionary_types",$loginName,$pwd,$appCode);
	$resutltArray=json_decode($resutltJson);
	//var_dump($resutltArray);
	$success=$resutltArray->success;
	if($success){
		$sql_array=array();
		$sql_array[]="delete from dicationary_types";
		$data=$resutltArray->data;
		foreach ($data as $obj){

			$colobj=array();
			$colobj["ID"]=$obj->id;
			$colobj["TITLE"]=$obj->name;
			$colobj["CODE"]=$obj->code;
			$sql_array[]=DB::getInstance()->getInsertSql("dicationary_types", $colobj);
		}
	
		$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
		var_dump("code1=".$isok);
	}else{
	
	}
}
function initcode2($loginName,$pwd,$appCode){
	$resutltJson=getFunData("dictionary_datas",$loginName,$pwd,$appCode);
	$resutltArray=json_decode($resutltJson);
	$success=$resutltArray->success;
	if($success){
		$sql_array=array();
		$sql_array[]="delete from dicationary_datas";
		$data=$resutltArray->data;
		foreach ($data as $obj){
			$colobj=array();
			$colobj["ID"]=$obj->id;
			$colobj["CODE"]=$obj->code;
			$colobj["TYPEID"]=$obj->typeId;
			$colobj["VALUE"]=$obj->value;
			$colobj["TITLE"]=$obj->name;
			$colobj["SORT"]=$obj->sort;
			$sql_array[]=DB::getInstance()->getInsertSql("dicationary_datas", $colobj);
		}
	
		$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
		var_dump("code2=".$isok);
	}else{
	
	}
}

function initArea($loginName,$pwd,$appCode){
	$resutltJson=getFunData("areas",$loginName,$pwd,$appCode);
	$resutltArray=json_decode($resutltJson);
	//var_dump($resutltArray);
	$success=$resutltArray->success;
	if($success){
		$sql_array=array();
		$sql_array[]="delete from fim_area";
		$data=$resutltArray->data;
		foreach ($data as $obj){
			$colobj=array();
			$colobj["ID"]=$obj->id;
			$colobj["LEVEL"]=$obj->level;
			$colobj["PARENTID"]=$obj->parentId;
			$colobj["TITLE"]=$obj->name;
			$colobj["SORTNUM"]=$obj->sortNum;
			$colobj["SIGN"]=$obj->sign;
			$sql_array[]=DB::getInstance()->getInsertSql("fim_area", $colobj);
		}
		
		$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
		var_dump("area=".$isok);
	}else{
	
	}
	
	
}
	
function getFunData($uri,$loginName,$pwd,$appCode){
 
	$rooturl=ParaUtil::getInstance()->getContent("XFURL");
 	$length=100000000;
	$curpage=1;
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$paramobj=array();
	$paramobj["pageSize"]           = $length;
	$paramobj["currentPage"]        = $curpage;
	$paramscontent=str_replace("\\/", "/", json_encode($paramobj));
	$paramscontent=preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $paramscontent);
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
	//	$ursl.="&params=".urlencode ("{\"pageSize\":\"".$length."\",\"currentPage\":\"".$curpage."\"}");
	$ursl.="&params=".urlencode ($paramscontent);
 
	$data=Fun::http_requestGet($ursl);
 
	return $data;
}