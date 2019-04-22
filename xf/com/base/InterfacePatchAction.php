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
$appCode  =$manageapptype;
$rooturl=ParaUtil::getInstance()->getContent("XFURL");
header("Content-type: text/html; charset=utf-8");
	$postParams=array();
	
	$getprams_str="";
	foreach ($_REQUEST as $key => $value){
		if(array_key_exists($key,$_POST)){
			$postParams[$key]=$value;
		}else{
			
			$getprams_str.="&".$key."=".$value;
		}
	}
    $uri=Fun::request("uri");
    $randVal=Fun::getUUID();
    $pwdHash=base64_encode(sha1($pwd.$randVal));
    $ursl=$rooturl."/".$uri;
    
   
	
	$postParams["loginName"]=$loginName;
	$postParams["appCode"]=$appCode;
	$postParams["randVal"]=$randVal;
	$postParams["pwdHash"]=$pwdHash;
 
 	$data=Fun::httpRequestPATCH($ursl,$postParams);
	//$data=Fun::callRequest($ursl,$postParams,'PUT',"","");
	echo $data;
	
	
	
	function decodeUnicode($str)
	{
		return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
				create_function(
						'$matches',
						'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
				),
				$str);
	}