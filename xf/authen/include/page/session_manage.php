<?php
include_once(dirname(__FILE__)."/../../../com/base/util/ParaUtil.class.php");
$rootPath=ParaUtil::getInstance()->getRoot();
session_start();

$sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];
if($sessionManageUserArray=="" || !isset($sessionManageUserArray)){
	echo "登录超时";
	echo "<script type=\"text/javascript\">";
	echo "window.top.location.href=\"".$rootPath."/authen/fim/login/login.php\"";
	echo "</script>";
	exit();
}
$manageuseraccount=trim($sessionManageUserArray["USERACCOUNT"]);
$manageuserpwd=trim($sessionManageUserArray["PWD"]);
$manageapptype=trim($sessionManageUserArray["APPTYPE"]);
?>