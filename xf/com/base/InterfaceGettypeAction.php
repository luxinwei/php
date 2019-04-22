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
   $uri=Fun::request("uri");
    $type=Fun::request("type");
   $length=Fun::requestInt("length", 40);
   $curpage=Fun::requestInt("curpage", 1);
   if($length==0)$length=20;
   if($curpage==0)$curpage=1;
    $randVal=Fun::getUUID();
    $pwdHash=base64_encode(sha1($pwd.$randVal));
    $paramobj=array();
    $paramobj["pageSize"]           = $length;
    $paramobj["currentPage"]        = $curpage;
    $paramobj["type"]                 = $type;
     foreach ($_REQUEST as $key => $value){
    	if($key=="uri")continue;
    	if($key=="start")continue;
    	if($key=="length")continue;
    	if($key=="curpage")continue;
    	$paramobj[$key]  = $value;
    }
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
  	
	echo $data;