<?php
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/TreeUtil.class.php");
class FimMenuitem {
	 public  $tablename="fim_menuitem";
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
	 	for($i=100;$i<1000;$i++){
	 		$newId=trim($i);
	 		$isOk=false;
	 		foreach ($listAll as $menu){
	 			if(strcmp($menu["ID"],$newId)==0){
	 				$isOk=true;
	 				break;
	 			}
	 		}
	 		if(!$isOk)break;
	 	}
	 	return $newId;
	 }
	 function getNewOrderIndex($parentid){
	 	$orderindex=0;
	 	$sql_select="select * from ".$this->tablename." where parentid='".$parentid."' order by orderindex desc";
	 	$obj = DB::getInstance()->getOneObjBySql($sql_select);
	 	if(count($obj)>0){
	 		$orderindex=Fun::getInt($obj["ORDERINDEX"],0);
	 	}else{
	 		$orderindex=1;
	 	}
	 	return $orderindex;
	 	
	 }
	 function getNewPosition($parentid){
	 	$fimMenuItem=self::getOne($parentid);
	 	
	 	$parentPosition=trim($fimMenuItem["POSITION"]);
	 	
	 	$maxIncCode="";
	 	$where="and position like '".$parentPosition."%' and position !='".$parentPosition."' and length(position)=".(strlen($parentPosition)+3);
	 	$where.=" order by position desc";
	 	
	 	$menuItem=DB::getInstance()->getOneObjByWhere($this->tablename, $where);
	 	if(count($menuItem)==0){
	 		$maxIncCode=$parentPosition."001";
	 	}else{
	 		$maxCode=trim($menuItem["POSITION"]);
	 		$currentLankCode=Fun::getInt(substr($maxCode,strlen($parentPosition),strlen($maxCode)),0)+1;
	 		if(strlen($currentLankCode)==1){
	 			$maxIncCode=$parentPosition."00".$currentLankCode;
	 		}elseif(strlen($currentLankCode)==2){
	 			$maxIncCode=$parentPosition."0".$currentLankCode;
	 		}else{
	 			$maxIncCode=$parentPosition.$currentLankCode;
	 		}
	 	}
	 	return $maxIncCode;
	 }
	
	 /* */
	 function getAllList(){
	 	$sql_select="select * from ".$this->tablename." order by orderindex";
	 	$list = DB::getInstance()->execQuery($sql_select);
	 	return $list;
	 }
	 function getOneByAll($id,$allList){
	 	$menunew=Array();
	 	foreach ($allList as $menu){
	 		if($id==$menu["ID"]){
	 			$menunew=$menu;
	 		}
	 	}
	 	return $menunew;
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
	 
	 function getNextList($id){
		$sql_select="select * from ".$this->tablename." where parentid='".$id."' order by orderindex";
		$list = DB::getInstance()->execQuery($sql_select);
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
				//$linkurl="manage/fim/fimcodecatalog/".$codeno."_".Fun::encode($id).".html";
				$linkurl="manage/fim/fimcodecatalog/fimcodelibrary_list.php?codeno=".$codeno;
				
			}
			if(strtolower(substr($linkurl,0,8))=="pagecode"){
				$pagecode=substr($linkurl,9);
				//$linkurl="manage/fim/fimpagecode/".$pagecode."_".Fun::encode($id).".html";
				$linkurl="manage/fim/fimpagecode/pagecode.php?pagecode=".$pagecode;
			}
			
			if(strtolower(substr($linkurl,0,11))=="weblinktype"){
				$weblinktype=substr($linkurl,12);
			//	$linkurl="manage/ims/imsweblink/".$weblinktype."_".Fun::encode($id).".html";
				$linkurl="manage/ims/imsweblink/imsweblink_list.php?weblinktype=".$weblinktype;
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
			if(strcmp($str,"")!=0)$str.="\n,";
			$str.="{id:\"".$id."\"";
			$str.=",pId:\"".trim($menu["PARENTID"])."\"";
			$str.=",name:\"".trim($menu["TITLE"])."\"";
			$str.=",url:\"".$url."\"";
			$str.=",target:\"".$target."\"";
			$str.=",position:\"".trim($menu["POSITION"])."\"";
			$str.=",text:\"".trim($menu["TITLE"])."\"";
			$str.=",qxbz:\"".trim($menu["QXBZ"])."\"";
			$str.=",qtip:\"".trim($menu["TITLE"])."\"";
			$str.=",valid:\"".$valid."\"";
			$list_sub=self::getNextListByAll($id,$allList);
			$list_count=count($list_sub);
			if($list_count>0)$str.=",leaf:false";
			if($list_count<=0)$str.=",leaf:true";
			//$str.=",expanded:true";
			$str.=",singleClickExpand:true";
			$str.=",checked: false";
			if($list_count>0)$str.=",children: [\n".self::getZtreeJsonStr($id,$allList,$sessionMenuList,$grouplevel)."\n]";
			$str.="}";
	
		}
		return $str;
}
//-------------------------------------------------------------------------------------------------------------------	 
	 function getTreeJsonData($isroot){
	 	$treedata="";
	 	$root=self::getRoot();
		$allList=self::getAllList();
	 	$id = trim($root["ID"]);
	 	if($isroot){
			$valid=false;
			if(trim($root["VALID"])=="1")$valid=true;
			
	 		$treedata = "[{";
	 		$treedata.="postid:\"".$id."\"";
			$treedata.=",id:\"".$id."\"";
	 		$treedata.=",parentId:\"\"";
	 		$treedata.=",position:\"".trim($root["POSITION"])."\"";
	 		$treedata.=",title:\"".trim($root["TITLE"])."\"";
			$treedata.=",text:\"".trim($root["TITLE"])."\"";
			$treedata.=",linkurl:\"".trim($root["LINKURL"])."\"";
			$treedata.=",qxbz:\"".trim($root["QXBZ"])."\"";
			$treedata.=",target:\"".trim($root["TARGET"])."\"";
			$treedata.=",qtip:\"".trim($root["TITLE"])."\"";
			$treedata.=",valid:\"".$valid."\"";
			$treedata.=",leaf:false";
			$treedata.=",expanded:true";
			$treedata.=",singleClickExpand:true";
			$treedata.=",checked: false";
	 		$treedata.= ", children:[".self::getTreeStrData($id,$allList)."]";
	 		$treedata.= "}]";
	 	}else{
			$treedata = "[".self::getTreeStrData($id,$allList)."]";
		}
	 	return $treedata;
	 }
	 function getTreeStrData($parentid,$allList){
	 	$str = "";
	 	$list=self::getNextListByAll($parentid,$allList);
	 	foreach ($list as $menu){
	 		$id = trim($menu["ID"]);
			$valid=false;
			if(trim($menu[VALID])=="1")$valid=true;
	 		if(strcmp($str,"")!=0)$str.="\n,";
	 		$str.="{postid:\"".$id."\"";
			$str.=",id:\"".$id."\"";
	 		$str.=",parentId:\"".trim($menu["PARENTID"])."\"";
	 		$str.=",position:\"".trim($menu["POSITION"])."\"";
	 		$str.=",title:\"".trim($menu["TITLE"])."\"";
			$str.=",text:\"".trim($menu["TITLE"])."\"";
			$str.=",linkurl:\"".trim($menu["LINKURL"])."\"";
			$str.=",target:\"".trim($menu["TARGET"])."\"";
			$str.=",qxbz:\"".trim($menu["QXBZ"])."\"";
			$str.=",qtip:\"".trim($menu["TITLE"])."\"";
			$str.=",valid:\"".$valid."\"";
	 		$list_sub=self::getNextListByAll($id,$allList);
			$list_count=count($list_sub);
			if($list_count>0)$str.=",leaf:false";
			if($list_count<=0)$str.=",leaf:true";
			//$str.=",expanded:true";
			$str.=",singleClickExpand:true";
			$str.=",checked: false";
	 		if($list_count>0)$str.=",children: [\n".self::getTreeStrData($id,$allList)."\n]";
	 		$str.="}";
		
	 	}
	 	return $str;
	 }
	 //==删除==============================================================================================================================
	 function del($menuid){
	 	$isok=false;
	 	if($menuid!=""){
		 	$treeUtil=new TreeUtil(self::getRootTree(),self::getLilsAllTree());
		 	$codeList=$treeUtil->getSubCodeListAllIncludeSymbol($menuid);
		 	if($codeList=="")$codeList=null;
		 	$sql="delete  from ".$this->tablename." where id in (".$codeList.")";
		 	$isok=DB::getInstance()->execUpdate($sql);
	 	}
	 	return $isok;
	 }
//===调整栏目===========================================================================================================================
	 function changeItem($menuid,$newParentCode){
	 	$fmi =DB::getInstance()->getOneObjByKey($this->tablename,"ID", $menuid);
	 	$oldParentCode=trim($fmi["PARENTID"]);
	 	$oldPosition=trim($fmi["POSITION"]);
	 	 
	 	$newPosition=self::getNewPosition($newParentCode);
	 	 
	 	$listSql=Array();
	 
	 	if($oldParentCode!=$newParentCode){
	 		$hql_cur="update ".$this->tablename." set parentid='".$newParentCode."', position='".$newPosition."' where id='".$fmi["ID"]."'";
	 		$listSql[]=$hql_cur;
	 
	 		$sql_select="select * from ".$this->tablename." where position like '".$oldPosition."%' and id!='".$fmi["ID"]."'";
	 		$list = DB::getInstance()->execQuery($sql_select);
	 		foreach ($list as $menuItem){
	 			$position=$newPosition.substr($menuItem["POSITION"],strlen($oldPosition),strlen($menuItem["POSITION"]));
	 			$sql_update="update ".$this->tablename." set position='".$position."' where id='".$menuItem["ID"]."'";
	 			$listSql[]=$sql_update;
	 		}
	 	}
	 	$isok=DB::getInstance()->InsertOrUpdateArray($listSql);
	 	return $isok;
	 }
//==============================================================================================================================
	 function getRootTree(){
	 	$root=self::getRoot();
	 	$treeRoot = array(
	 			"code" => $root["ID"],
	 			"parentCode" => $root["PARENTID"],
	 			"title" => $root["TITLE"]
	 	);
	 	return $treeRoot;
	 }
	 
	 function getLilsAllTree(){
	 	$listAll=self::getAllList();
	 	$listAllTree=array();
	 	foreach($listAll as $item){
	 		$tree = array(
	 				"code" => $item["ID"],
	 				"parentCode" => $item["PARENTID"],
	 				"title" => $item["TITLE"]
	 		);
	 		$listAllTree[]=$tree;
	 	}
	 	return $listAllTree;
	 }
	 function listFimMenuTree(){
	 	//------------------------------------------------------------------
	 	$treeUtil=new TreeUtil(self::getRootTree(),self::getLilsAllTree());
	 	return $treeUtil->getInitlistAll();
	 }
	 
	 function getMenuSelectOption($currentCode,$value){
	 	//------------------------------------------------------------------
	 	$treeUtil=new TreeUtil(self::getRootTree(),self::getLilsAllTree());
	 	return $treeUtil->findSelectOptionStrFilterCurrentCode($currentCode,$value);
	 }
	 
	 function initPosition(){
	 	$list=self::listFimMenuTree();
	 	$listSql=array();
	 	foreach($list as $treeInfo){
	 		$sql="update ".$this->tablename." set POSITION='".$treeInfo["position"]."' where id='".$treeInfo["code"]."'";
	 		$listSql[]=$sql;
	 	}
	 	$isOk=DB::getInstance()->InsertOrUpdateArray($listSql);
	 	return  $isOk;
	 }	 
//-----------------------------------------------------------------------------------------------
}
//$menu=new FimMenuitem();
//$root=$menu->changeItem('156','172');

/*
$menu=new FimMenuitem();
$root=$menu->getOne('125');

$menu=new FimMenuitem();
$root=$menu->getRoot();
$rootid=$root->id;
$list=$menu->getNextList($rootid);
//var_dump($list);
//$menu->getTreeJsonData(true,true);
$json=$menu->getTreeJsonData(true,true);

header ( "Content-type: text/javascript; charset=utf-8" );
$menu=new FimMenuitem();
$json=$menu->getZtreeJson();
echo($json);
echo($json);
*/
?>
