<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
include("../../../com/core/fim/FimOrg.class.php");
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if(strcmp($action,"add")==0){
	$id 			= FimOrg::getInstance()->getNewId();                                                          //编号
	$parentid 		= Fun::request("parentid");                                                     //父编号
	$position 		= FimOrg::getInstance()->getNewPosition($parentid);                                     //位置
	$title 			= Fun::request("title");                                                           //菜单名称
	$type 			= Fun::request("type");
	$orgkind        = Fun::request("orgkind");
	$orderindex 	= FimOrg::getInstance()->getNewOrderIndex($parentid);                                              //排序                                         //大图标
	$valid 			= Fun::requestInt("valid",0);                                                        //有效标志
	
	$colArr=array();
	$colArr["ID"]=$id;
	$colArr["PARENTID"]=$parentid;
	$colArr["POSITION"]=$position;
	$colArr["TITLE"]=$title;
	$colArr["TYPE"]=$type;
	$colArr["ORGKIND"]=$orgkind;
	$colArr["ORDERINDEX"]=$orderindex;

	$sql=DB::getInstance()->getInsertSql("fim_org", $colArr);
	$isok=DB::getInstance()->execUpdate($sql);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"edit")==0){
	$id 			= Fun::request("id");                                                                 //编号
	$title 			= Fun::request("title");                                                           //菜单名称
	$type 			= Fun::request("type");
	$orgkind        = Fun::request("orgkind");
	$colArr=array();
	
	$colArr["TITLE"]=$title;
	$colArr["TYPE"]=$type;
	$colArr["ORGKIND"]=$orgkind;
	$sql=DB::getInstance()->getUpdateSql("fim_org", $colArr, "and ID='".$id."'");

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
	$isok=FimOrg::getInstance()->del($keyvalue);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif(strcmp($action,"order")==0){
	$keylist=Fun::request("keylist");
	$keyvalueArray=explode(",",$keylist);
	$sql_array=array();
	for($i=0;$i<count($keyvalueArray);$i++){
		$sql="update fim_org set orderindex=".$i." where id='".$keyvalueArray[$i]."'";
		$sql_array[]=$sql;
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
	
}elseif(strcmp($action,"changeitem")==0){
	$keyvalue    = Fun::request("keyvalue");
	$newparentid = Fun::request("newparentid");
	$isok=FimOrg::getInstance()->changeItem($keyvalue, $newparentid);
	$json="{success:0,msg:'失败!'}";
	if($isok)$json="{success:1,msg:'成功!'}";
	echo($json);
}elseif($action=="savemapinfo"){
	    $orgid = Fun::request("orgid");
		$mapx = Fun::request("mapx");
		$mapy = Fun::request("mapy");
		$address = Fun::request("address");
		$sql_mid="mapx='".$mapx."'";
		$sql_mid.=",mapy='".$mapy."'";
		$sql_mid.=",address='".$address."'";
		$sql="update fim_org set ".$sql_mid." where id='".$orgid."'";
		$isok=DB::getInstance()->execUpdate($sql);
		$json="{success:0,msg:'失败!'}";
		if($isok)$json="{success:1,msg:'成功!'}";
		echo($json);	
}elseif($action=="mappoint"){
	$type 			= Fun::request("type");
	$orgkind        = Fun::request("orgkind");
	$title               = Fun::request("title");
	if($type!="")$where.="  and TYPE  ='".$type."'";
	if($orgkind!="")$where.="  and ORGKIND  ='".$orgkind."'";
	if($title!="")$where.=" and title like '%".$title."%'";
	$sql_select="select * from fim_org where mapx!='' and mapy!=''".$where;
	$json=DB::getInstance()->findJsonBySql($sql_select);
	echo($json);
	
}elseif(strcmp($action,"list")==0){
	$start = Fun::requestInt("start",0);
	$length= Fun::requestInt("length",0);
	$type 			= Fun::request("type");
	$orgkind        = Fun::request("orgkind");
	$title               = Fun::request("title");
	$interal1            = Fun::request("interal1");
	$interal2            = Fun::request("interal2");
	$interalorder1       = Fun::request("interalorder1");
	$interalorder2       = Fun::request("interalorder2");
	$num1            = Fun::request("num1");
	$num2            = Fun::request("num2");
	
	
	$where="";
	if($type!="")$where.="  and TYPE  ='".$type."'";
	if($orgkind!="")$where.="  and ORGKIND  ='".$orgkind."'";
	if($title!="")$where.=" and title like '%".$title."%'";
	if($interal1!="")$where.="  and INTERAL  >='".$interal1."'";
	if($interal2!="")$where.="  and INTERAL  <='".$interal2."'";
	if($interalorder1!="")$where.="  and INTERALORDER  >='".$interalorder1."'";
	if($interalorder2!="")$where.="  and INTERALORDER  <='".$interalorder2."'";
	if($num1!="")$where.="  and MEMBERNUM  >='".$num1."'";
	if($num2!="")$where.="  and MEMBERNUM  <='".$num2."'";
	$orderStr=" order by INTERALORDER asc";
	$json=DB::getInstance()->findPageJson("fim_org", $where, $orderStr, $start, $length);
	echo($json);
}elseif(strcmp($action,"tree")==0){
	$jsonx=FimOrg::getInstance()->getTreeJsonData(true);
	Fun::log($jsonx);
	echo($jsonx);
}
?>

