<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php

include ("../../../com/core/fim/FimCodelibrary.class.php");
header ( "Content-type: text/html; charset=utf-8" );
$action=$_GET["action"];
if(strcmp($action,"add")==0){
	$codeno = Fun::request ( "codeno" ); // 类别
	$itemno = Fun::request ( "itemno" ); // 代码
	$id = $codeno."_".$itemno; // 主键ID
	$id =Fun::getUUID();
	$itemname = Fun::request ( "itemname" ); // 名称
	$orderindex = FimCodelibrary::getInstance()->getOrderIndexInc($codeno); // 排序
	$remark = Fun::request ( "remark" ); // 备注
	$sql_select="select * from fim_codelibrary where codeno='".$codeno."' and itemno='".$itemno."'";
	$obj=DB::getInstance()->getOneObjBySql($sql_select);
	if(count($obj)>0){
		$json = "{success:0,msg:'编码重复!'}";
		echo ($json);
		exit;
	}
	$sql_col  = "ID";              $sql_val =  "'" . $id . "'";
	$sql_col .= ",CODENO";         $sql_val .= ",'" . $codeno . "'";
	$sql_col .= ",ITEMNO";         $sql_val .= ",'" . $itemno . "'";
    $sql_col .= ",ITEMNAME";       $sql_val .= ",'" . $itemname . "'";
	$sql_col .= ",ORDERINDEX";     $sql_val .= ",'" . $orderindex . "'";
	$sql_col .= ",REMARK";         $sql_val .= ",'" . $remark . "'";
	$sql = "insert into fim_codelibrary(" . $sql_col . ") values(" . $sql_val . ")";
	$isok = DB::getInstance()->execUpdate ( $sql );
	$json = "{success:0,msg:'失败!'}";
	if ($isok)
		$json = "{success:1,msg:'成功!'}";
	echo ($json);
} elseif (strcmp($action,"edit")==0) {
	$id = Fun::request ( "id" ); // 主键ID
	$codeno = Fun::request ( "codeno" ); // 类别
	$itemno = Fun::request ( "itemno" ); // 代码
	$itemname = Fun::request ( "itemname" ); // 名称
	$remark = Fun::request ( "remark" ); // 备注
	$sql_select="select * from fim_codelibrary where codeno='".$codeno."' and itemno='".$itemno."' and id!='".$id."'";
	$obj=DB::getInstance()->getOneObjBySql($sql_select);
	if(count($obj)>0){
		$json = "{success:0,msg:'编码重复!'}";
		echo ($json);
		exit;
	}
	
	
	$sql_mid .= "ITEMNO='" . $itemno . "'";
	$sql_mid .= ",ITEMNAME='" . $itemname . "'";
	$sql_mid .= ",REMARK='" . $remark . "'";
	$sql = "update fim_codelibrary set " . $sql_mid . " where ID='" . $id . "'";
	$isok = DB::getInstance()->execUpdate ( $sql );
	$json = "{success:0,msg:'操作失败!'}";
	if ($isok)$json = "{success:1,msg:'成功!'}";
	echo ($json);
} elseif (strcmp($action,"del")==0) {
	$keylist = Fun::request ( "keylist" );
	$keyvalueArray = explode ( ",", $keylist );
	$isok = DB::getInstance()->deleteBykey ( "fim_codelibrary","ID", $keyvalueArray );
	$json = "{success:0,msg:'失败!'}";
	if ($isok) $json = "{success:1,msg:'成功!'}";
	echo ($json);
}elseif(strcmp($action,"order")==0){
	$keylist=Fun::request("keylist");
	$keyvalueArray=explode(",",$keylist);
	$sql_array=array();
	for($i=0;$i<count($keyvalueArray);$i++){
		$sql="update fim_codelibrary set orderindex=".$i." where id='".$keyvalueArray[$i]."'";
		$sql_array[]=$sql;
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
	
} elseif (strcmp($action,"list")==0) {
	$codeno= Fun::request ( "codeno" );
	$where =  " and codeno = '" . $codeno . "' ";
	$orderstr = " order by orderindex";
	$json = DB::getInstance()->findJson(FimCodelibrary::getInstance()->tablename, $where, $orderstr);
	echo ($json);
}
?>