<?php
include_once (dirname(__FILE__)."/../common/BaseDataLib.class.php");
class FimGroupUtil {
	private $_instance=null;
	//所谓的单态设计模式就是一个类只能产生/创建唯一一个对象
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	public function getqx($menuId,$qxbz,$groupid){
		$isOk=false;
		$getPermisionMenuList="";
		if($groupid==-1){
			$isOk=true;
		}else{
			$menuList=BaseDataLib::$baseDataFimGroup[$groupid]["MENULIST"];
			if($qxbz==""&&substr_count($menuList,$menuId)>0)$isOk=true;
			if($qxbz!=""&&substr_count($menuList,$menuId."|".$qxbz)>0)$isOk=true;
		}
		return $isOk;
	}
	public function getZTreeJson($groupid){
		$ztreeJson=BaseDataLib::$baseDataFimGroup[$groupid]["ZTREEJSON"];
		return $ztreeJson;
	}
}