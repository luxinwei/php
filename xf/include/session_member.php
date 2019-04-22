<?php
include_once(dirname(__FILE__)."/../com/base/util/ParaUtil.class.php");
$rootPath=ParaUtil::getInstance()->getRoot();
session_start();
$sessionMemberUserArray=$_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MEMBER_USER"];
if($sessionMemberUserArray=="" || !isset($sessionMemberUserArray)){
	echo "登录超时";
	echo "<script type=\"text/javascript\">";
	//echo "window.top.location.href=\"".$rootPath."/vip/login/login.php\"";
	echo "window.top.location.href=\"".$rootPath."/\"";
	echo "</script>";
	exit();
}
$memberusercode    = trim($sessionMemberUserArray["USERCODE"]);
$membermobile      = trim($sessionMemberUserArray["MOBILE"]);
$memberuseraccount = trim($sessionMemberUserArray["USERACCOUNT"]);
$membernickname    = trim($sessionMemberUserArray["NICKNAME"]);
$memberusername    = trim($sessionMemberUserArray["USERNAME"]);
$memberuserlevel   = trim($sessionMemberUserArray["USERLEVEL"]);
$memberusertype    = trim($sessionMemberUserArray["USERTYPE"]);
$memberuserorgid   = trim($sessionMemberUserArray["ORGID"]);
$memberpic         = trim($sessionMemberUserArray["PIC"]);
if($memberpic==""){
	$memberpic=ParaUtil::getInstance()->getFileServerUrl()."/etc/member/personal_headportrait.png";
}else{
	$memberpic=ParaUtil::getInstance()->getFileServerUrl()."/".$memberpic;
}
?>