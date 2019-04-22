<?php
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
class FimGroup {
	 public  $tablename="fim_group";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	 function getOne($keyvalue){
		$row=DB::getInstance()->getOneObjByKey($this->tablename,"ID", $keyvalue);
		return $row;
	 }
	 function getNewId(){
	 	$newId="";
	 	$listAll=self::getAllList();
	 	for($i=1;$i<1000;$i++){
	 		$newId=trim($i);
	 		$isOk=false;
	 		foreach ($listAll as $group){
	 			if(strcmp($group["ID"],$newId)==0){
	 				$isOk=true;
	 				break;
	 			}
	 		}
	 		if(!$isOk)break;
	 	}
	 	return $newId;
	 }
	 function getFimGroupJsArray(){
	 	$jsArray_mid="";
	 	$jsArray_mid.="['','']";
	 	$list=self::getAllList();
	 	foreach($list as $group){
	 		if(strcmp(jsArray_mid,"")!=0)$jsArray_mid.=",";
	 		$itemno=$group["ID"];
	 		$itemname=$group["TITLE"];
	 		$jsArray_mid.="['".$itemno."','".$itemname."']";
	 	}
	 	$jsArray="[".$jsArray_mid."]";
	 	return $jsArray;
	 }
	 function getSelectOptionStr($value){
	 	$listAll=self::getAllList();
	 	$content="";
	 	foreach ($listAll as $group){
	 		$itemno=$group["ID"];
	 		$itemname=$group["TITLE"];
	 		$grouplevel=Fun::getInt($group["GROUPLEVEL"], 0);
	 		$selected="";
	 		if(strcmp($itemno,$value)==0)$selected="selected";
	 		$content.="\n<option ".$selected." value=\"".$itemno."\">".$itemname."</option>";
	 	}
	 	return $content;
	 }
	 function getAllList(){
	 	$sql_select="select * from ".$this->tablename;
	 	$list = DB::getInstance()->execQuery($sql_select);
	 	return $list;
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
	 function del($groupidlist){
	 	$sql_array=array();
	 	$groupidArray=explode(",",$groupidlist);
	 	foreach ($groupidArray as $groupid){
	 		$sql_group="delete from fim_group where id='".$groupid."'";
	 		$sql_group_menu="delete from fim_groupmenu where groupid='".$groupid."'";
	 		$sql_array[]=$sql_group;
	 		$sql_array[]=$sql_group_menu;
	 	}
	 	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	 	return $isok;
	 }
	 
	 //-------------------------------------------------------------------------------------------------------------------
	 public function getqx($menuId,$qxbz,$sessionManageUserArray){
	 	$isOk=false;
	 	$level=Fun::getInt($sessionManageUserArray["LEVEL"], 0);
	 	$getPermisionMenuList="";
	 	if($level==-1){
	 		$getPermisionMenuList=self::getMenuButtonAllList($menuId);
	 	}else{
	 		$getPermisionMenuList=self::getMenuButtonList($menuId, $sessionManageUserArray["FIMGROUPID"]);
	 	} 
	 	if(substr_count($getPermisionMenuList,$menuId."|".$qxbz)>0)$isOk=true;
	 	return $isOk;
	 }
	 private function getMenuButtonList($menuId,$groupid){
	 	$menuId=trim($menuId);
	 	$menuItemsstr="";
	 	$fg=self::getOne($groupid);
	 	$menuList=self::getMenuListByGroup($groupid);
	 	$menuArrayList[]=explode(",",$menuList);
	 	foreach ($menuArrayList as $menuItems){
	 		if($menuItems=="")continue;
	 		if(strlen($menuItems)<strlen($menuId))continue;
	 		$menuItems=trim($menuItems);
	 		
	 		
	 		if(substr($menuItems,0,strlen($menuId))==$menuId){
	 			if($menuItemsstr!="")$menuItemsstr.=",";
	 			$menuItemsstr.=$menuItems;
	 		}
	 	}
	 	return $menuItemsstr;
	 }

	 private function getMenuButtonAllList($menuid){
	 
	 	$menu=DB::getInstance()->getOneObjBySql("select * from fim_menuitem where id='".$menuid."'");
	 	$menuItemsstr=$menuid;
	 	$qxbz=$menu["QXBZ"];
	 	 
	 	if($qxbz!=""){
	 		$qxbz_flag=explode(",",$qxbz);
	 		foreach ($qxbz_flag as $flagstr){
	 			$flagArray=explode("|",$flagstr);
	 			if(count($flagArray)==2){
	 				$menuItemsstr.=",".$menuid."|".$flagArray[0];
	 			}
	 				
	 		}
	 	}
	 
	 	return $menuItemsstr;
	 }
	 
}
//$fimGroup=new FimGroup();
//$fimGroup->del("5,6,7");
?>