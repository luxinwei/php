<?php
include_once(dirname(__FILE__)."/../../../com/base/util/ParaUtil.class.php");
$rootPath=ParaUtil::getInstance()->getRoot();
session_start();

$sessionManageUserArray=$_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MANAGE_USER"];
if($sessionManageUserArray=="" || !isset($sessionManageUserArray)){
	echo "登录超时";
	echo "<script type=\"text/javascript\">";
	echo "window.top.location.href=\"".$rootPath."/authen/fim/login/login.php\"";
	echo "</script>";
	exit();
}

$manageusercode=trim($sessionManageUserArray["USERCODE"]);
$manageuseraccount=trim($sessionManageUserArray["USERACCOUNT"]);
$managenickname=trim($sessionManageUserArray["NICKNAME"]);
$managefimgroupid=trim($sessionManageUserArray["FIMGROUPID"]);
$managefimorgid=trim($sessionManageUserArray["FIMORGID"]);
$manageusertype=trim($sessionManageUserArray["USERTYPE"]);

?>