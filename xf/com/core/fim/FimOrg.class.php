<?php
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/TreeUtil.class.php");
class FimOrg {
	 public  $tablename="fim_org";
	 private $_instance=null;
	 public static function getInstance(){
	 	if(!$_instance instanceof self){
	 		$_instance = new self;
	 	}
	 	return $_instance;
	 }
	 function createRoot(){
	 	$isok=false;
	 	if(count(self::getAllList())==0){
	 		$colArr=array();
	 		$colArr["ID"]=self::getNewId();
	 		$colArr["POSITION"]="100";
	 		$colArr["ORDERINDEX"]=1;
	 		$colArr["TITLE"]="机构根目录";
	 		$isok=DB::getInstance()->saveOrUpdateByArray($this->tablename,"ID",$colArr);
	 	}
	 	return $isok;
	 }
	 
	 function updateMemberNum(){
	 	$sqlArry=array();
	 	$sql="select count(*) MEMBERNUM,ORGID from csm_member where orgid!='' group by orgid";
	 	$list=DB::getInstance()->execQuery($sql);
	 	foreach ($list as $obj){
	 		$membernum=Fun::getInt($obj["MEMBERNUM"], 0);
	 		$sqlArry[]="update fim_org set MEMBERNUM=".$membernum." where ID='".$obj["ORGID"]."'";
	 		
	 	}

	 	$isok=DB::getInstance()->InsertOrUpdateArray($sqlArry);
	 	return $isok;
	 }
	 
	 function getOne($keyvalue){
	 	$row=DB::getInstance()->getOneObjByKey($this->tablename,"ID", $keyvalue);
	 	return $row;
	 }
	 function getNewId(){
	 	$newId="";
	 	$listAll=self::getAllList();
	 	for($i=10000;$i<100000;$i++){
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
	 function getTreeJsonData($isroot){
	 	$treedata="";
	 	$root=self::getRoot();
		$allList=self::getAllList();
	 	$id = trim($root["ID"]);
	 	if($isroot){
			
			
	 		$treedata = "[{";
	 		$treedata.="postid:\"".$id."\"";
			$treedata.=",id:\"".$id."\"";
	 		$treedata.=",parentId:\"\"";
	 		$treedata.=",position:\"".trim($root["POSITION"])."\"";
	 		$treedata.=",title:\"".trim($root["TITLE"])."\"";
	 		$treedata.=",name:\"".trim($root["TITLE"])."\"";
			$treedata.=",text:\"".trim($root["TITLE"])."\"";
			$treedata.=",type:\"".trim($root["TYPE"])."\"";
			$treedata.=",orgkind:\"".trim($root["ORGKIND"])."\"";
			$treedata.=",url:\"\"";
			$treedata.=",qtip:\"".trim($root["TITLE"])."\"";

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
			$str.=",name:\"".trim($menu["TITLE"])."\"";
			$str.=",type:\"".trim($menu["TYPE"])."\"";
			$str.=",orgkind:\"".trim($menu["ORGKIND"])."\"";
			$str.=",url:\"\"";
			$str.=",qtip:\"".trim($menu["TITLE"])."\"";
		
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
	 public function getOrgJsArray(){
	 	$jsArray_mid="";
	 	$jsArray_mid.="['','']";
	 	$list=self::getAllList();

	 	foreach ($list as $orgObj){
	 		$itemno=$orgObj["ID"];
	 		$itemname=$orgObj["TITLE"];
	 		if(strcmp(jsArray_mid,"")!=0)$jsArray_mid.=",";
	 		$jsArray_mid.="['".$itemno."','".$itemname."']";
	 
	 	}
	 	$jsArray="[".$jsArray_mid."]";
	 	return $jsArray;
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
	 function getMenuSelectOptionAtNews($orgid){
	 	//------------------------------------------------------------------
	 	$treeUtil=new TreeUtil(self::getRootTree(),self::getLilsAllTree());
	 	return $treeUtil->findSelectOptionNoRootStr($orgid);
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
