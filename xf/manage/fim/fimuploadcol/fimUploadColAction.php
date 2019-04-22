<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
include("../../../com/core/fim/FimUploadCol.class.php");
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];

$fimUploadCol=new FimUploadCol();
if($action=="list"){
	$where="";
	$orderstr="";
	$json=DB::getInstance()->findJson(FimUploadCol::getInstance()->tablename, $where, $orderStr);
	echo($json);
}
?>