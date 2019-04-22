<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../com/base/util/Fun.class.php");?>
<?php
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if($action=="list"){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers";
	$ursl.="?loginName=".$loginName;
	$ursl.="&appCode=ownerDepartment";
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
	$data=Fun::http_request($ursl);
	echo $data;
	
}elseif ($action=="del"){
	$keylist=Fun::request("keylist");
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers/".$keylist;
	$ursl.="?loginName=".$loginName;
	$ursl.="&appCode=ownerDepartment";
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
	$data=Fun::http_request($ursl);
	echo $data;
}
