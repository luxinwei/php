<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
include("../../../com/core/fim/FimMenuitem.class.php");
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if(strcmp($action,"add")==0){
	$id 			= FimMenuitem::getInstance()->getNewId();                                                          //编号
	$parentid 		= Fun::request("parentid");                                                     //父编号
	$position 		= FimMenuitem::getInstance()->getNewPosition($parentid);                                     //位置
	$title 			= Fun::request("title");                                                           //菜单名称
	$shorttitle 	= Fun::request("shorttitle");                                                 //简称
	$orderindex 	= FimMenuitem::getInstance()->getNewOrderIndex($parentid);                                              //排序
	$linkurl 		= Fun::request("linkurl");                                                       //url地址
	$target 		= Fun::request("target");                                                         //
	$qxbz 			= Fun::request("qxbz");                                                             //权限标志
	$smallicon 		= Fun::request("smallicon");                                                   //小图标
	$bigicon 		= Fun::request("bigicon");                                                       //大图标
	$valid 			= Fun::requestInt("valid",0);                                                        //有效标志
	$sql_col="ID";             $sql_val="'".$id."'";
	$sql_col.=",PARENTID";     $sql_val.=",'".$parentid."'";
	$sql_col.=",POSITION";     $sql_val.=",'".$position."'";
	$sql_col.=",TITLE";        $sql_val.=",'".$title."'";
	$sql_col.=",ORDERINDEX";   $sql_val.=",'".$orderindex."'";
	$sql_col.=",LINKURL";      $sql_val.=",'".$linkurl."'";
	$sql_col.=",TARGET";       $sql_val.=",'".$target."'";
	$sql_col.=",SMALLICON";       $sql_val.=",'".$smallicon."'";
	$sql_col.=",QXBZ";         $sql_val.=",'".$qxbz."'";
	$sql_col.=",VALID";        $sql_val.=",'".$valid."'";
	$sql="insert into fim_menuitem(".$sql_col.") values(".$sql_val.")";
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"edit")==0){
	$id 			= Fun::request("id");                                                                 //编号
	$title 			= Fun::request("title");                                                           //菜单名称
	$shorttitle 	= Fun::request("shorttitle");                                                    //简称
	$linkurl 		= Fun::request("linkurl");                                                       //url地址
	$target 		= Fun::request("target");                                                         //
	$qxbz 			= Fun::request("qxbz");                                                           //权限标志
	$smallicon 		= Fun::request("smallicon");                                                      //小图标
	$bigicon 		= Fun::request("bigicon");                                                        //大图标
	$valid 			= Fun::requestInt("valid",0);                                                       //有效标志
	$sql_mid.="TITLE    ='".$title."'";
	$sql_mid.=",LINKURL ='".$linkurl."'";
	$sql_mid.=",TARGET  ='".$target."'";
	$sql_mid.=",SMALLICON  ='".$smallicon."'";
	$sql_mid.=",QXBZ    ='".$qxbz."'";
	$sql_mid.=",VALID   ='".$valid."'";
	$sql="update fim_menuitem set ".$sql_mid." where ID='".$id."'";
	
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"del")==0){
	$keyvalue=Fun::request("keyvalue");
	if($keyvalue==""){
		$json="{success:0,msg:'失败!'}";
		echo($json);
		exit(0);
	}
	$isok=FimMenuitem::getInstance()->del($keyvalue);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"order")==0){
	$keylist=Fun::request("keylist");
	$keyvalueArray=explode(",",$keylist);
	$sql_array=array();
	for($i=0;$i<count($keyvalueArray);$i++){
		$sql="update fim_menuitem set orderindex=".$i." where id='".$keyvalueArray[$i]."'";
		$sql_array[]=$sql;
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
	
}elseif(strcmp($action,"changeitem")==0){
	$keyvalue    = Fun::request("keyvalue");
	$newparentid = Fun::request("newparentid");
	$isok=FimMenuitem::getInstance()->changeItem($keyvalue, $newparentid);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"tree")==0){
	$jsonx=FimMenuitem::getInstance()->getTreeJsonData(true);
	echo($jsonx);
}
?>

