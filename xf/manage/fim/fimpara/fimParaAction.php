<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/FileUtil.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php

include ("../../../com/core/fim/FimPara.class.php");
header ( "Content-type: text/html; charset=utf-8" );
$action=$_GET["action"];
if(strcmp($action,"edit")==0){
	$paracode = Fun::request ( "paracode" ); // 参数代码
	$paracontent = Fun::request ( "paracontent" ); // 参数内容
	$description = Fun::request ( "description" ); // 描述
	$sql_mid = "PARACONTENT='" . $paracontent . "'";
	$sql_mid .= ",DESCRIPTION='" . $description . "'";
	$sql = "update fim_para set " . $sql_mid . " where PARACODE='" . $paracode . "'";
	$isok = DB::getInstance()->execUpdate ( $sql );
	$json = "{success:0,msg:'失败!'}";
	if ($isok)$json = "{success:1,msg:'成功!'}";
	echo ($json);
}elseif (strcmp($action,"config")==0) {
	$arrayObj=$_POST["arrayObj"];
	$obj=json_decode($arrayObj);
	$sql_array=array();
	foreach ($obj as $para){
		$code = $para->code;
		$content = $para->content;
		$sql = "update fim_para set PARACONTENT='" . $content . "' where PARACODE='" . $code . "'";
		$sql_array[]=$sql;
	}
	$isok = false;
	$isok = DB::getInstance()->InsertOrUpdateArray($sql_array);
	$json = "{success:0,msg:'失败!'}";
	if ($isok)$json = "{success:1,msg:'成功!'}";
	echo ($json);
	
} elseif (strcmp($action,"list")==0) {
	$start       = Fun::requestInt ( "start",0 );
	$length      = Fun::requestInt ( "length",0 );
	$paracode    = Fun::request ( "paracode" );
	$paracontent = Fun::request ( "paracontent" );
	$description = Fun::request ( "description" );
	$where = "";
	if (strcmp ( $paracode, "" ) != 0)
		$where .= " and paracode like '%" . $paracode . "%' ";
	if (strcmp ( $paracontent, "" ) != 0)
		$where .= " and paracontent like '%" . $paracontent . "%' ";
	if (strcmp ( $description, "" ) != 0)
		$where .= " and description like '%" . $description . "%' ";
	$orderstr = "";
	$json = DB::getInstance()->findPageJson ( FimPara::getInstance()->tablename, $where, $orderstr, $start, $length );
	echo ($json);
}
?>