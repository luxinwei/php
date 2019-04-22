<?php
include_once(dirname(__FILE__)."/../com/base/util/ParaUtil.class.php");
$rootPath=ParaUtil::getInstance()->getRoot();
session_start();
$sessionMemberUserArray=$_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MEMBER_USER"];


if($sessionMemberUserArray=="" || !isset($sessionMemberUserArray)){
	echo "登录超时";
	echo "<script type=\"text/javascript\">";
	echo "window.top.location.href=\"".$rootPath."/wap/vip/login/login.php\"";
	echo "</script>";
	exit();
}
$memberusercode    = trim($sessionMemberUserArray["USERCODE"]);
$membermobile      = trim($sessionMemberUserArray["MOBILE"]);
$memberuseraccount = trim($sessionMemberUserArray["USERACCOUNT"]);
$membermobile      = trim($sessionMemberUserArray["MOBILE"]);
$membernickname    = trim($sessionMemberUserArray["NICKNAME"]);
$memberuserlevel   = trim($sessionMemberUserArray["USERLEVEL"]);
$memberuserorgid   = trim($sessionMemberUserArray["ORGID"]);
$memberpic         = trim($session_member_user_array["PIC"]);
if($memberpic=="")$memberpic=$rootPath."/wap/etc/img/person.png";
?>