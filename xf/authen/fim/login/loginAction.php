<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once ('../../../com/base/util/ParaUtil.class.php');


		
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
	$apptype       = Fun::request("apptype");
	$currMask = strtoupper($_SESSION['checkCode']);// 获得session中验证码
  	Fun::log("dddddddd".$apptype);  
/*
	if($maskcode<>$currMask){
	 	$json="{success:0,msg:'验证码不正确'}";
	 	echo($json);
	 	exit(); n  
	}
	*/
	$rsultjson=loginfunction($useraccount,$password,$apptype);
	if($rsultjson){
		//{"code":200,"message":"成功","success":true}
		$resulobj=json_decode($rsultjson);
		$success=$resulobj->success;
		if($success){
			$sessionid=session_id();
			$clientip=$_SERVER["REMOTE_ADDR"];
			$sessionManageUserArray = array(
					'USERACCOUNT' => $useraccount,
					'PWD'         => $password,
					'APPTYPE'    => $apptype,
					'SESSIONID'   => $sessionid,
					'IP'          => $clientip,
					'CREATETIME'  => date("Y-m-d H:i:s")
			);
			$_SESSION["XF_SESSION_MANAGE_USER"] = $sessionManageUserArray;
			$json="{success:1,msg:'成功'}";
		}else{
			$json="{success:0,msg:'".$resulobj->code.$resulobj->message."'}";
		}
	}else{
		$json="{success:0,msg:'服务器无法连接'}";
	}	
	echo($json);
	exit();
}elseif($action=="exit"){
	//退出========================================================================================
	$sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];
	$apptype=trim($sessionManageUserArray["APPTYPE"]);
	$tourl=ParaUtil::getInstance()->getRoot()."/authen/fim/login/index.php";
	if($apptype=="")$tourl="";               
	if($apptype=="")$tourl="";
	if($apptype=="")$tourl="";
	if($apptype=="")$tourl="";
	session_destroy(); //清空以创建的所有SESSION
	session_unset("XF_SESSION_MANAGE_USER");
	unset($_SESSION["XF_SESSION_MANAGE_USER"]);//清空指定的session
	echo "<script type=\"text/javascript\">";
	echo "parent.window.location.href=\"".$tourl."\"";
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

function  loginfunction($loginName,$pwd,$appcode){
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$rooturl=ParaUtil::getInstance()->getContent("XFURL");
	$ursl=$rooturl."/users/login";

	$params=array();
	$params["loginName"]=$loginName;
	//$params["appCode"]=ParaUtil::getInstance()->getContent("XFAPPCODE");
	$params["appCode"]=$appcode;
	$params["randVal"]=$randVal;
	$params["pwdHash"]=$pwdHash;
	$json=Fun::http_request($ursl,$params);
	return $json; 
}

?>