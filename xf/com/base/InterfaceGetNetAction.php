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
    $params=Fun::request("params");
 	//$params=strtr($params,"quot;","\"");
	$arr = array("quot;" => "\"");
	$params= strtr($params,$arr);
     $randVal=Fun::getUUID();
    $pwdHash=base64_encode(sha1($pwd.$randVal));
	
   //  $params=str_replace("\\/", "/", json_encode($params));
  //  $params=preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $params);
     $ursl=$rooturl."/".$uri;
    if(substr_count($ursl,"?")==0){
    	$ursl.="?";
    }else{
    	$ursl.="&";
    }
	$ursl.="params=".urlencode ($params);
	$ursl.="&loginName=".$loginName;
	$ursl.="&appCode=".$appCode;
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
//	$ursl.="&params=".urlencode ("{\"pageSize\":\"".$length."\",\"currentPage\":\"".$curpage."\"}");
  	$data=Fun::http_requestGet($ursl);
	echo $data;