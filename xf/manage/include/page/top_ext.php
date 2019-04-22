<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
</head>
<body>
<?php 
error_reporting(0);
include dirname(__FILE__)."/../../../com/base/util/DB.class.php";
include dirname(__FILE__)."/../../../com/base/util/Fun.class.php";
include dirname(__FILE__)."/../../../com/base/util/ParaUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/CodeUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/FileUtil.class.php";
include dirname(__FILE__)."/../../../manage/include/page/session_manage.php";
$m=Fun::request("m");
if(strlen(Fun::decode($m))!=3){
	echo ("非法访问");
	exit;
}
//禁止在 地址栏里输入 访问!
if(substr_count($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])==0){
	//echo ("禁止非法访问");
	//exit;
}
?>
<script>
var m="<?php echo($m);?>";
var fileServerUrl="<?php echo ParaUtil::getInstance()->getFileServerUrl();?>";
</script>
<script src="../../../etc/extjs.php"></script>
