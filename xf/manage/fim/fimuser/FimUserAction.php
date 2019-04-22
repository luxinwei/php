<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
include("../../../com/core/csm/CsmMember.class.php");
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if($action=="add"){
	$usercode    =CsmMember::getInstance()->getNewCode();                                                     //会员编号(不能重复)
	$useraccount = Fun::request("useraccount");
	$mobile      = Fun::request("mobile");                                                         //业务联系手机(不能重复)
	$email       = Fun::request("email");                                                           //业务联系邮箱(不能重复)
	$nickname    = Fun::request("nickname");                                                     //昵称
	$orgid       = Fun::request("orgid");
	$linkarea  	 = Fun::request("linkarea");                                                     //联系地址
	$linkaddress = Fun::request("linkaddress");                                               //联系地址(详细地址)
	$linkpost    = Fun::request("linkpost");                                                     //邮编
	$linktel     = Fun::request("linktel");                                                       //固定电话-
	$pwd         = Fun::request("pwd");
	$endtime     = Fun::request("endtime");                                                       //会员有效期如果为空，则永久有效
	$fimgroupid  = Fun::requestInt("fimgroupid");                                              //管理员组ID
	$qq 		 = Fun::request("qq");                                                                 //QQ
	$msn 		 = Fun::request("msn");                                                               //MSN
	$ww 		 = Fun::request("ww");                                                                 //阿里旺旺
	$pic = Fun::request("pic");                                                               //会员头像
    if($useraccount!=""){
		$member1=DB::getInstance()->getOneObjBySql("select * from csm_member where useraccount='".$useraccount."'");
		if(count($member1)>0){
			$json="{success:0,msg:'账号重复!'}";
			echo($json);
			exit(0);
		}
	}
	if($mobile!=""){
		$member2=DB::getInstance()->getOneObjBySql("select * from csm_member where mobile='".$mobile."'");
		if(count($member2)>0){
			$json="{success:0,msg:'手机号重复!'}";
			echo($json);
			exit(0);
		}
	}
	if($email!=""){
		$member3=DB::getInstance()->getOneObjBySql("select * from csm_member where email='".$email."'");
		if(count($member3)>0){
			$json="{success:0,msg:'邮箱重复!'}";
			echo($json);
			exit(0);
		}
	}
	

	$sql_col =" USERCODE";        $sql_val="'".$usercode."'";
	$sql_col.=",USERACCOUNT";     $sql_val.=",'".$useraccount."'";
	$sql_col.=",MOBILE";          $sql_val.=",'".$mobile."'";
	$sql_col.=",EMAIL";           $sql_val.=",'".$email."'";
	$sql_col.=",NICKNAME";        $sql_val.=",'".$nickname."'";
	$sql_col.=",ORGID";        $sql_val.=",'".$orgid."'";
	$sql_col.=",USERTYPE";        $sql_val.=",'9'";
	$sql_col.=",USERLEVEL";       $sql_val.=",'1'";
	$sql_col.=",LINKAREA";        $sql_val.=",'".$linkarea."'";
	$sql_col.=",LINKADDRESS";     $sql_val.=",'".$linkaddress."'";
	$sql_col.=",LINKPOST";        $sql_val.=",'".$linkpost."'";
	$sql_col.=",PWD";             $sql_val.=",'".md5($pwd)."'";
	$sql_col.=",LINKTEL";         $sql_val.=",'".$linktel."'";
	$sql_col.=",REGTIME";         $sql_val.=",'".date("Y-m-d H:i:s")."'";
	$sql_col.=",ENDTIME";         $sql_val.=",'".$endtime."'";
	$sql_col.=",FIMGROUPID";      $sql_val.=",'".$fimgroupid."'";
	$sql_col.=",QQ";              $sql_val.=",'".$qq."'";
	$sql_col.=",MSN";             $sql_val.=",'".$msn."'";
	$sql_col.=",WW";              $sql_val.=",'".$ww."'";
	$sql_col.=",PIC";             $sql_val.=",'".$pic."'";
	$sql_col.=",LOGINCOUNT";      $sql_val.=",0";
	$sql="insert into csm_member(".$sql_col.") values(".$sql_val.")";
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);	
}elseif($action=="edit"){
	$usercode    = Fun::request("usercode");                                                     //会员编号(不能重复)
	$mobile      = Fun::request("mobile");                                                         //业务联系手机(不能重复)
	$email       = Fun::request("email");                                                           //业务联系邮箱(不能重复)
	$nickname    = Fun::request("nickname");                                                     //昵称                                                                     //会员类型
	$orgid       = Fun::request("orgid");
	$linkarea  	 = Fun::request("linkarea");                                                     //联系地址
	$linkaddress = Fun::request("linkaddress");                                               //联系地址(详细地址)
	$linkpost    = Fun::request("linkpost");                                                     //邮编
	$linktel     = Fun::request("linktel");                                                       //固定电话-
	$endtime     = Fun::request("endtime");                                                       //会员有效期如果为空，则永久有效
	$fimgroupid  = Fun::requestInt("fimgroupid");                                              //管理员组ID
	$qq 		 = Fun::request("qq");                                                                 //QQ
	$msn 		 = Fun::request("msn");                                                               //MSN
	$ww 		 = Fun::request("ww");                                                                 //阿里旺旺
	$pic         = Fun::request("pic");                                                               //会员头像
	if($useraccount!=""){
		$member1=DB::getInstance()->getOneObjBySql("select * from csm_member where usercode!='".$usercode."' and useraccount='".$useraccount."'");
		if(count($member1)>0){
			$json="{success:0,msg:'账号重复!'}";
			echo($json);
			exit(0);
		}
	}
	if($mobile!=""){
		$member2=DB::getInstance()->getOneObjBySql("select * from csm_member where usercode!='".$usercode."' and mobile='".$mobile."'");
		if(count($member2)>0){
			$json="{success:0,msg:'手机号重复!'}";
			echo($json);
			exit(0);
		}
	}
	if($email!=""){
		$member3=DB::getInstance()->getOneObjBySql("select * from csm_member where usercode!='".$usercode."' and email='".$email."'");
		if(count($member3)>0){
			$json="{success:0,msg:'邮箱重复!'}";
			echo($json);
			exit(0);
		}
	}
	$sql_mid="MOBILE='".$mobile."'";
	$sql_mid.=",EMAIL='".$email."'";
	$sql_mid.=",NICKNAME='".$nickname."'";
	$sql_mid.=",ORGID='".$orgid."'";
	$sql_mid.=",LINKAREA='".$linkarea."'";
	$sql_mid.=",LINKADDRESS='".$linkaddress."'";
	$sql_mid.=",LINKPOST='".$linkpost."'";
	$sql_mid.=",LINKTEL='".$linktel."'";
	$sql_mid.=",ENDTIME='".$endtime."'";
	$sql_mid.=",FIMGROUPID='".$fimgroupid."'";
	$sql_mid.=",QQ='".$qq."'";
	$sql_mid.=",MSN='".$msn."'";
	$sql_mid.=",WW='".$ww."'";
	$sql_mid.=",PIC='".$pic."'";
	$sql="update csm_member set ".$sql_mid." where USERCODE='".$usercode."'";
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok){
		$json="{success:1,msg:'成功!'}";
	}else{
		$json="{success:0,msg:'系统繁忙!'}";
	}
	echo($json);
	
}elseif($action=="del"){
	$keylist=Fun::request("keylist");
	$keyvalueArray=explode(",",$keylist);
	$isok=DB::getInstance()->deleteBykey("csm_member","USERCODE",$keyvalueArray);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
	
}elseif($action=="list"){
	$start = Fun::requestInt("start");
	$length= Fun::requestInt("length");
	$fimgroupid=Fun::request("fimgroupid");
	$orgid=Fun::request("orgid");
	$where=" and usertype='9' and (FIMGROUPID!=-1 or FIMGROUPID is null)";
	if($orgid!="")$where.=" and orgid='".$orgid."'";
	if($fimgroupid!="")$where.=" and FIMGROUPID='".$fimgroupid."'";
	$orderstr="";
	$json=DB::getInstance()->findPageJson("csm_member",$where,$orderstr,$start,$length);
	echo($json);
}elseif($action=="modifypwd"){
	$usercode    = Fun::request("usercode"); 
	$pwd         = Fun::request("pwd");
	$sql_mid="PWD='".md5($pwd)."'";
	$sql="update csm_member set ".$sql_mid." where USERCODE='".$usercode."'";
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif($action=="groups"){
	$orgid    = Fun::request("orgid");
	$groups=DB::getInstance()->execQuery("select * from fim_group where orgid='".$orgid."'");
	$content="";
	foreach($groups as $groupObj){
		$content.="<option value=\"".$groupObj["ID"]."\">".$groupObj["TITLE"]."</option>";
	}
	if($content=="")$content.="<option value=\"\">岗位</option>";
	echo($content);
}

?>