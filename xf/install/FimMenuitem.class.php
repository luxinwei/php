<?php
include_once(dirname(__FILE__)."/../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../com/base/util/Fun.class.php");
class FimMenuitem {
 public  $tablename="fim_menuitem";
 private $_instance=null;
 public static function getInstance(){
 	if(!$_instance instanceof self){
 		$_instance = new self;
 	}
 	return $_instance;
 }
	 function getAllList(){
	 	$sql_select="select * from ".$this->tablename." order by orderindex";
	 	$list = DB::getInstance()->execQuery($sql_select);
	 	return $list;
	 }

	 function getNextListByAll($id,$allList){
	 	$list=Array();
	 	foreach ($allList as $menu){
	 		$parentid=$menu["PARENTID"];
	 		if($parentid==$id){
	 			$list[]=$menu;
	 		}
	 	}
	 	return $list;
	 }
	 function getRoot(){
	 	$sql_select="select * from ".$this->tablename." where parentid='' or parentid='0' or parentid is null";
		$root=DB::getInstance()->getOneObjBySql($sql_select);
	 	return $root;
	 }
//-------------------------------------------------------------------------------------------------------------------
function getZtreeJson($sessionMenuList,$grouplevel){
	$treedata="";
	$root=self::getRoot();
	$allList=self::getAllList();
	$rootid = trim($root["ID"]);
	$treedata = "[".self::getZtreeJsonStr($rootid,$allList,$sessionMenuList,$grouplevel)."]";
	return $treedata;
}
function getZtreeJsonStr($parentid,$allList,$sessionMenuList,$grouplevel){
		$str = "";
		$list=self::getNextListByAll($parentid,$allList);
		foreach ($list as $menu){
			$id = trim($menu["ID"]);
			if(substr_count($sessionMenuList,$id)==0&&$grouplevel!=-1)continue;
			
			$linkurl=trim($menu["LINKURL"]);
			if(strtolower(substr($linkurl,0,6))=="codeno"){
				$codeno=substr($linkurl,7);
				$linkurl="manage/fim/fimcodecatalog/fimcodelibrary_list.php?codeno=".$codeno;
			}
			$isHttp=strripos($linkurl,"http");
			if(!is_int($isHttp)&&$linkurl!=""){
				$linkurl="../../../".$linkurl;
				if(is_int(strripos($linkurl,"?"))){
					$linkurl.="&m=".Fun::encode($id);
				}else{
					$linkurl.="?m=".Fun::encode($id);
				}
			}
			
			$url=$linkurl;
			$target=trim($menu["TARGET"]);
			if(strcasecmp($target,"")==0)$target="contentFrame";
			$valid=false;
			if(trim($menu["VALID"])=="1")$valid=true;
			if(trim($menu["VALID"])=="0")continue;
			if(strcmp($str,"")!=0)$str.=",";
			$str.="{id:'".$id."'";
			$str.=",pId:'".trim($menu["PARENTID"])."'";
			$str.=",name:'".trim($menu["TITLE"])."'";
			$str.=",url:'".$url."'";
			$str.=",target:'".$target."'";
			$str.=",position:'".trim($menu["POSITION"])."'";
			$str.=",text:'".trim($menu["TITLE"])."'";
			$str.=",qxbz:'".trim($menu["QXBZ"])."'";
			$str.=",qtip:'".trim($menu["TITLE"])."'";
			$str.=",smallicon:'".trim($menu["SMALLICON"])."'";
			$str.=",valid:'".$valid."'";
			$list_sub=self::getNextListByAll($id,$allList);
			$list_count=count($list_sub);
			if($list_count>0)$str.=",leaf:false";
			if($list_count<=0)$str.=",leaf:true";
			//$str.=",expanded:true";
			$str.=",singleClickExpand:true";
			$str.=",checked: false";
			if($list_count>0)$str.=",children: [".self::getZtreeJsonStr($id,$allList,$sessionMenuList,$grouplevel)."]";
			$str.="}";
	
		}
		return $str;
}

}

?>
