<?php
error_reporting(0);
header("Content-type: text/html; charset=utf-8");
include ('../com/base/util/Fun.class.php');
include ('../com/base/util/DB.class.php');
include ('../com/base/util/FileUtil.class.php');
include ('FimMenuitem.class.php');
$root=str_ireplace("/install/index.php","",$_SERVER ['PHP_SELF']);
$rootdir=str_ireplace("/install/index.php","",strtr(__FILE__,"\\","/"));

$FRONTROOT=$root;//前台根目录
$FRONTFOLDER=$rootdir;//网站前台目录地址

$FILESERVERURL=$root."/upload";//上传文件服务URL地址
$FILEUPLOADFOLDER=$rootdir."/upload";//文件上传目录路径
$sql_array=array();
$sql_array[]="update fim_para set PARACONTENT='".$FRONTROOT."'         where PARACODE='FRONTROOT'";
$sql_array[]="update fim_para set PARACONTENT='".$FRONTFOLDER."'       where PARACODE='FRONTFOLDER'";
$sql_array[]="update fim_para set PARACONTENT='".$FILESERVERURL."'     where PARACODE='FILESERVERURL'";
$sql_array[]="update fim_para set PARACONTENT='".$FILEUPLOADFOLDER."'  where PARACODE='FILEUPLOADFOLDER'";

$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
if($isok){
	$json = "{success:1,msg:'success,成功!'}";
	echo($json);
}else{
	$json = "{success:0,msg:'fail,请检查数据库连接是否正确!'}";
	echo($json);
}


//创建参数文件
Fun::clearCache();
//创建基础数据库
$contentx="<?php ";
$contentx.="\nclass BaseDataLib {";
$contentx.=getParaArrayContent();
$contentx.=getCodeArrayContent();
$contentx.=getFimUploadColArrayContent();
$contentx.=getFimGroupArrayContent();
$contentx.="\n}";
$contentx.="\n?>";
FileUtil::getInstance()->writetofile($rootdir."/com/base/common/BaseDataLib.class.php", $contentx);



//生成参数数组=====================================================================================================================================================
function getParaArrayContent(){
	$content_para="";
	$content_para_mid="";
	$list1=DB::getInstance()->execQuery("select * from fim_para");
	foreach ($list1 as $obj){
		if($content_para_mid!="")$content_para_mid.=",";
		$content_para_mid.="\n\t\"".$obj["PARACODE"]."\"=> \"".$obj["PARACONTENT"]."\"";
	}
	$content_para.="\n static \$baseDataFimPara=array(".$content_para_mid."\n);";
	return $content_para;
}
//--生成字典表数组=====================================================================================================================================================
function getCodeArrayContent(){
	$list_codecatalog=DB::getInstance()->execQuery("select * from fim_codecatalog");
	$content_code="";
	$content_code_mid="";
	foreach($list_codecatalog as $catalog){
		$list_lib=DB::getInstance()->execQuery("select * from fim_codelibrary where CODENO='".$catalog["CODENO"]."' order by ORDERINDEX");
		$content_lib="";
		$content_lib_mid="";
		foreach($list_lib as $lib){
			if($content_lib_mid!="")$content_lib_mid.=",";
			$content_lib_mid.="\"".trim($lib["ITEMNO"])."\"=> \"".trim($lib["ITEMNAME"])."\"";
		}
		$content_lib="array(\"CODENO\"=> \"".$catalog["CODENO"]."\",\"TITLE\"=> \"".$catalog["CODENAME"]."\",\"LIBS\"=> array(".$content_lib_mid."))";
		if($content_code_mid!="")$content_code_mid.=",";
		$content_code_mid.="\n\t\"".$catalog["CODENO"]."\"=> ".$content_lib."";
	}
	$content_code.="\n static \$baseDataFimcode=array(".$content_code_mid."\n);";
	return $content_code;
}
//--生成上传数组=====================================================================================================================================================
function getFimUploadColArrayContent(){
	$list=DB::getInstance()->execQuery("select * from fim_upload_col");
	$content="";
	$content_mid="";
	foreach($list as $uploadcol){
		$content_col="";
		$content_col.="\"TABLENAME\"=> \"".$uploadcol["TABLENAME"]."\"";
		$content_col.=",\"UPLOADCOL\"=> \"".$uploadcol["UPLOADCOL"]."\"";
		$content_col.=",\"ALLOWFILETYPE\"=> \"".$uploadcol["ALLOWFILETYPE"]."\"";
		$content_col.=",\"VIRTUALSAVEPATH\"=> \"".$uploadcol["VIRTUALSAVEPATH"]."\"";
		$content_col.=",\"DESCRIPTION\"=> \"".$uploadcol["DESCRIPTION"]."\"";
		$content_col.=",\"README\"=> \"".$uploadcol["README"]."\"";
		$content_col.=",\"FILEMAXLENTH\"=> \"".$uploadcol["FILEMAXLENTH"]."\"";
		$content_col.=",\"FILENUM\"=> \"".$uploadcol["FILENUM"]."\"";
		if($content_mid!="")$content_mid.=",";
		$content_mid.="\n\t";
		$content_mid.="\"".$uploadcol["UPLOADCOLKEY"]."\"=> array(".$content_col.")";
	}
	$content.="\n static \$baseDataFimUploadcol=array(".$content_mid."\n);";
	return $content;
	
}

//--生成权限数组=====================================================================================================================================================
function getFimGroupArrayContent(){
	$list_fim_group=DB::getInstance()->execQuery("select * from fim_group");
	$content_group="";
	$content_group_mid="";
	$menuList="";
	$groupid="-1";
	$content_group_mid.="\n\t\"".$groupid."\"=> array(\"MENULIST\"=> \"".$menuList."\"\n\t\t\t\t,\"ZTREEJSON\"=> \"".FimMenuitem::getInstance()->getZtreeJson("", $groupid)."\"\n\t\t\t\t)";
	foreach($list_fim_group as $group){
		if($content_group_mid!="")$content_group_mid.=",";
		$menuList=getMenuListByGroup($group["ID"]);
		$ztreejson=FimMenuitem::getInstance()->getZtreeJson($menuList, $group["ID"]);
		$content_group_mid.="\n\t\"".$group["ID"]."\"=> array(\"MENULIST\"=> \"".$menuList."\"\n\t\t\t\t,\"ZTREEJSON\"=> \"".$ztreejson."\"\n\t\t\t\t)";
		
	}
	$content_group.="\n static \$baseDataFimGroup=array(".$content_group_mid."\n);";
	return $content_group;
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
//--生成菜单数组=====================================================================================================================================================

?>