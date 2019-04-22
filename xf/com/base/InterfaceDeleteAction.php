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
    $randVal=Fun::getUUID();
    $pwdHash=base64_encode(sha1($pwd.$randVal));
    $ursl=$rooturl."/".$uri;
    /**/
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
	
 
	//$data=Fun::callRequest($ursl,$postParams,$type='DELETE',"","");
	$data=Fun::httpRequestDelete($ursl,$postParams);
 
	echo $data;