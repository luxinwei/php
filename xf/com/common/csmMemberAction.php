<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/ParaUtil.class.php");
include_once(dirname(__FILE__)."/../../com/base/util/FileUtil.class.php");
?>

<?php
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if($action=="getMemberInfoJson"){
	$usercodelist=Fun::request("usercodelist");
	$usercodelist=Fun::getMarksStrByComma($usercodelist);
	if($usercodelist=="")$usercodelist=null;
	$sql_select="select USERCODE,USERACCOUNT,NICKNAME,EMAIL,MOBILE,USERTYPE,USERLEVEL from csm_member where usercode in (".$usercodelist.")";
	$data_array=DB::getInstance()->execQuery($sql_select);
	$json=json_encode($data_array);
	echo $json;
}