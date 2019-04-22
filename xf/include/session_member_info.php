<?php
include_once(dirname(__FILE__)."/../com/base/util/ParaUtil.class.php");
include_once(dirname(__FILE__)."/../com/base/util/DB.class.php");
$rootPath=ParaUtil::getInstance()->getRoot();
session_start();
$vipIsOPen=ParaUtil::getInstance()->getContent("VIP_ISOPEN");
$sessionMemberUserArray = $_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MEMBER_USER"];
$memberusercode         = trim($sessionMemberUserArray["USERCODE"]);
$membermobile           = trim($sessionMemberUserArray["MOBILE"]);
$memberuseraccount      = trim($sessionMemberUserArray["USERACCOUNT"]);
$membernickname         = trim($sessionMemberUserArray["NICKNAME"]);
$memberuserlevel        = trim($sessionMemberUserArray["USERLEVEL"]);
$memberuserorgid       = trim($sessionMemberUserArray["ORGID"]);
$memberpic             = trim($sessionMemberUserArray["PIC"]);
if($memberpic==""){
	$memberpic=$rootPath."/wap/etc/img/person.jpg";
}else{
	$memberpic=ParaUtil::getInstance()->getFileServerUrl()."/".$memberpic;
}
if($membernickname=="")$membernickname="访客";
?>
