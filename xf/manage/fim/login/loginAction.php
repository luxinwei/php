<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once ('../../../com/base/util/ParaUtil.class.php');
include_once '../../../com/core/fim/FimGroup.class.php';

		
?>
<?php
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
session_start();
if($action=="login"){
	//登陆========================================================================================
	//$useraccount    = Fun::CheckReplace(base64_decode($_POST["useraccount"]));
	$useraccount    = Fun::CheckReplace($_POST["useraccount"]);
	$password       = Fun::CheckReplace(base64_decode($_POST["password"]));
	$maskcode       = strtoupper(Fun::request("maskcode"));
	$remuseraccount = Fun::request("remuseraccount");
	$currMask = strtoupper($_SESSION['checkCode']);// 获得session中验证码


	if($maskcode<>$currMask){
	 	$json="{success:0,msg:'验证码不正确'}";
	 	echo($json);
	 	exit();
	}

	$sql_select="select * from csm_member where useraccount='".$useraccount."' and pwd='".md5($password)."' and usertype=9";

	$obj=DB::getInstance()->getOneObjBySql($sql_select);
	if (count($obj)>0){
		$json="{success:1,msg:'成功!'}";
		$sessionid=session_id();
		$clientip=$_SERVER["REMOTE_ADDR"];
		$fimGroupId=trim($obj["FIMGROUPID"]);
		$menulist="";
		$level=0;
		if($fimGroupId=="-1"){
			$level=-1;//具有所有权限
		}else{
			$fimGroup=new FimGroup();
			$group=FimGroup::getInstance()->getOne($fimGroupId);
			$menulist=getMenuListByGroup($fimGroupId);
		}
		$sessionManageUserArray = array(
				'USERCODE'    => $obj["USERCODE"],
				'USERACCOUNT' => $obj["USERACCOUNT"],
				'MOBILE'      => $obj["MOBILE"],
				'EMAIL'       => $obj["EMAIL"],
				'NICKNAME'    => $obj["NICKNAME"],
				'USERTYPE'    => $obj["USERTYPE"],
				'USERLEVEL'   => $obj["USERLEVEL"],
				'LOGINCOUNT'  => $obj["LOGINCOUNT"],
				'CSMGROUPID'  => $obj["CSMGROUPID"],
				'FIMGROUPID'  => $obj["FIMGROUPID"],
				'FIMORGID'    => $obj["ORGID"],
				'MENULIST'    => $menulist,
				'NEWITEMSLIST'=> "",
				'LEVEL'       => $level,
				'SESSIONID'   => $sessionid,
				'IP'          => $clientip,
				'CREATETIME'  => date("Y-m-d H:i:s")
		);
		$_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MANAGE_USER"] = $sessionManageUserArray;

		setcookie("manage_useraccount", $useraccount);
		setcookie("manage_remuseraccount", $remuseraccount);
			
		$sql_update="update csm_member set  LOGINCOUNT=LOGINCOUNT+1";
		$sql_update.=",PREVLOGINIP='".$row["PREVLOGINIP"]."'";
		$sql_update.=",LASTLOGINIP='".$clientip."'";
		$sql_update.=",PREVLOGINTIME='".$row["PREVLOGINTIME"]."'";
		$sql_update.=",LASTLOGINTIME='".date("Y-m-d H:i:s")."'";
		$sql_update.=",SESSIONID='".$sessionid."'";
		$sql_update.=" where useraccount='".$useraccount."'";
		DB::getInstance()->execUpdate($sql_update);

	}else{
		$json="{success:0,msg:'用户名或密码不正确'}";
	}
	echo($json);
	exit();
}elseif($action=="exit"){
	//退出========================================================================================
	session_destroy(); //清空以创建的所有SESSION
	session_unset(ParaUtil::getInstance()->getRoot()."_SESSION_MANAGE_USER");
	unset($_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MANAGE_USER"]);//清空指定的session
	echo "<script type=\"text/javascript\">";
	echo "parent.window.location.href=\"".ParaUtil::getInstance()->getRoot()."/manage/fim/login/login.php\"";
	echo "</script>";
	exit();
}elseif($action=="clearcache"){
	//清除缓存
	$json="{success:0,msg:'失败'}";
	$json="{success:1,msg:'成功'}";
	Fun::clearCache();
    echo ($json);
}elseif($action=="modifypwd"){
	$oldpassword       = base64_decode(Fun::request("oldpassword"));
	$newpassword       = base64_decode(Fun::request("newpassword"));
	$sessionManageUserArray=$_SESSION[ParaUtil::getInstance()->getRoot()."_SESSION_MANAGE_USER"];
	$sql_select="select * from csm_member where usercode='".$sessionManageUserArray["USERCODE"]."' and pwd='".md5($oldpassword)."' and usertype=9";
	$obj=DB::getInstance()->getOneObjBySql($sql_select);
	if (count($obj)>0){
		$sql_update="update csm_member set pwd='".md5($newpassword)."' where usercode='".$sessionManageUserArray["USERCODE"]."'";
		$isok=DB::getInstance()->execUpdate($sql_update);
		$json="{success:0,msg:'失败!'}";
		if($isok)$json="{success:1,msg:'成功!'}";
		echo($json);
		exit(0);
	}else{
		$json="{success:2,msg:'原始密码不正确'}";
		echo $json;
		exit(0);
	}
}

function getMenuListByGroup($groupid){
	$content="";
	$sql_select="select * from fim_groupmenu where groupid='".$groupid."'";
	$list = DB::getInstance()->execQuery($sql_select);
	foreach($list as $groupmenu){
		if($content!="")$content.=",";
		$qxbz=trim($groupmenu["QXBZ"]);
		if($qxbz=="")$content.=$groupmenu["MENUID"];
		if($qxbz!="")$content.=$groupmenu["MENUID"]."|".$qxbz;
	}
	return $content;
}
?>