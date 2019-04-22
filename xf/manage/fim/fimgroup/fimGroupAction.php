<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
include("../../../com/core/fim/FimGroup.class.php");
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
$fimGroup=new FimGroup();
if($action=="edit"){
	$id          = Fun::request("id");                                                        //编号
	if($id=="")$id= $fimGroup->getNewId();
	$description = Fun::request("description");                                               //描述
	$title       = Fun::request("title");                                                     //用户组名称
	$valid       = Fun::requestInt("valid",1);                                                   //有效标志	
    $colArr=array();
	$colArr["ID"]=$id;
	$colArr["TITLE"]=$title;
	$colArr["VALID"]=$valid;
	$colArr["DESCRIPTION"]=$description;
	$isok=DB::getInstance()->saveOrUpdateByArray("fim_group", "ID", $colArr);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif($action=="del"){
	$groupidlist=Fun::request("keylist");
	$isok=FimGroup::getInstance()->del($groupidlist);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif($action=="list"){
	$where="";
	$orderstr="";
	$json=DB::getInstance()->findJson(FimGroup::getInstance()->tablename,$where,$orderstr);
	echo($json);
}elseif($action=="saveqx"){
	$groupid  = Fun::request("groupid");                                                       
	$menuList = Fun::request("menuList");
	$sql_array=array();
	$sql_del="delete from fim_groupmenu where groupid='".$groupid."'";
	$sql_array[]=$sql_del;
	if($menuList!=""){
		$menuArray=explode(",",$menuList);
		foreach ($menuArray as $menustr){
			$key="";
			$menuid="";
			$qxbz="";
			$qxbzArray=explode("|",$menustr);
			if(count($qxbzArray)==2){
				$menuid=$qxbzArray[0];
				$qxbz=$qxbzArray[1];
			}else{
				$menuid=$menustr;
			}
			$key=$groupid."_".$menuid."_".$qxbz;
			$sql_insert="insert into fim_groupmenu(ID,GROUPID,MENUID,QXBZ) values('".$key."','".$groupid."','".$menuid."','".$qxbz."')";
			$sql_array[]=$sql_insert;
		}
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);	
	}elseif($action=="saveNewsitemsQx"){
		$groupid  = Fun::request("groupid");
		$newitemslist = Fun::request("newitemslist");
		$colArr=array();
		$colArr["NEWITEMSLIST"]=$newitemslist;
		$isok=DB::getInstance()->updateByArray("fim_group", $colArr, " and ID='".$groupid."'");
		$json="{success:0,msg:'失败!'}";
		if($isok)$json="{success:1,msg:'成功!'}";
		echo($json);
}

?>