<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php

include ("../../../com/core/fim/FimCodecatalog.class.php");
header ( "Content-type: text/html; charset=utf-8" );
$action=$_GET["action"];
if(strcmp($action,"add")==0){
	$codeno       = Fun::request ( "codeno" ); // 类别
	$codename     = Fun::request ( "codename" ); // 类别名称
	$codedescribe = Fun::request ( "codedescribe" ); // 类别描述
	$itemnolength = Fun::requestInt ( "itemnolength",0); // 编码长度
	$sql_select="select * from fim_codecatalog where codeno='".$codeno."'";
	$obj=DB::getInstance()->getOneObjBySql($sql_select);
	if(count($obj)>0){
		$json = "{success:0,msg:'类别代码重复!'}";
		echo ($json);
		exit;
	}
	$colArr=array();
	$colArr["CODENO"]=$codeno;
	$colArr["CODENAME"]=$codename;
	$colArr["CODEDESCRIBE"]=$codedescribe;
	$colArr["ITEMNOLENGTH"]=$itemnolength;
	$isok = DB::getInstance()->saveByArray("fim_codecatalog", $colArr);
	$json = "{success:0,msg:'操作失败!'}";
	if ($isok)$json = "{success:1,msg:'成功!'}";
	echo ($json);
} elseif (strcmp($action,"edit")==0) {
	$codeno       = Fun::request ( "codeno" ); // 类别
	$codename     = Fun::request ( "codename" ); // 类别名称
	$codedescribe = Fun::request ( "codedescribe" ); // 类别描述
	$itemnolength = Fun::requestInt ( "itemnolength",0 ); // 编码长度
	$kind = Fun::request ( "kind" ); // 种类
	$colArr=array();
	$colArr["CODENO"]=$codeno;
	$colArr["CODENAME"]=$codename;
	$colArr["CODEDESCRIBE"]=$codedescribe;
	$colArr["ITEMNOLENGTH"]=$itemnolength;
	$colArr["KIND"]=$kind;
	$isok = DB::getInstance()->saveOrUpdateByArray("fim_codecatalog", "CODENO", $colArr);
	$json = "{success:0,msg:'失败!'}";
	if ($isok)
		$json = "{success:1,msg:'成功!'}";
	echo ($json);
} elseif (strcmp($action,"del")==0) {
	$keylist = Fun::request ( "keylist" );
	$keyvalueArray = explode ( ",", $keylist );
	$isok = DB::getInstance()->deleteBykey ( "fim_codecatalog","CODENO", $keyvalueArray );
	$json = "{success:0,msg:'失败!'}";
	if ($isok)$json = "{success:1,msg:'成功!'}";
	echo ($json);
}
?>