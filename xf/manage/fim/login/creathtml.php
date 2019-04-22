<?php 
error_reporting(0);
include '../../../com/base/util/DB.class.php';
include("../../../com/base/util/Fun.class.php");
include("../../../com/base/util/ParaUtil.class.php");
include("../../../com/base/util/FileUtil.class.php");
include dirname(__FILE__)."/../../../com/core/ims/ImsNewsitems.class.php";
include dirname(__FILE__)."/../../../manage/include/page/session_manage.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<script src="../../../etc/commonjs.php"></script>
<link rel="stylesheet" type="text/css" href="../../../manage/etc/css/main.css" />

<title>-----</title>
<style type="text/css">
body{margin:0px;padding:0px;}
.grid_list{}
.grid_list table{}
.grid_list table th{height:40px;line-height:40px;}

</style>
</head>
<body>
<form name="myform" id="myform" method="post" class="alert_info f12">  
<input class="button_paleblue6" type="button" value="生成首页"  onclick="javascript:window.location.href='creathtml.php?type=index'"/>             
<input class="button_paleblue6" type="button" value="信息页"  onclick="javascript:window.location.href='creathtml.php?type=news'"/>          
        
</form>

<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
<?php 
$type=Fun::request("type");
$isCreateHtml=ParaUtil::getInstance()->isCreateHtml();
if($isCreateHtml!="1"){
	FileUtil::getInstance()->delDirAndFile(ParaUtil::getInstance()->getRootDir()."/a");
	echo "系统不允许生成html静态页面";return;
}
if($type==""||$type=="index")CreateIndexHtml();
if($type==""||$type=="news"){
	CreateNewsItemsHtml();
	CreateNewsHtml();
}

?>
</table>

<?php 
function CreateIndexHtml(){
	$url=ParaUtil::getInstance()->getRoot()."/web/web.php?isCreateHtml=1";
	echo "\n<tr>";
	echo "<th>首页</th>";
	echo "<th>提示</th>";
	echo "</tr>";
	echo "\n<tr>";
	echo "<td>生成首页</td>";
	echo "<td><iframe width=\"400\" height=\"40\" frameborder=\"0\" style=\"margin:0px; padding:0px;\" src=\"".$url."\"></iframe></td>";
	//echo "<td class=\"msg\">".file_get_contents("http://127.0.0.5/hm/web/index.php?isCreateHtml=1")."</td>";
	echo "</tr>";
}
//==新闻栏目=============
function CreateNewsItemsHtml(){
	$listnewitems =DB::getInstance()->execQuery("select * from ims_newsitems");
	$sql_array=array();
	foreach ($listnewitems as $items){
		$htmlname=$items["ITEMSCODE"];
		if($items["ENTITLE"]!="")$htmlname=$items["ENTITLE"];
		$htmlurl="a/n".$htmlname.".html";
		$sql_array[]="update ims_newsitems set HTMLURL='".$htmlurl."' where ITEMSCODE='".$items["ITEMSCODE"]."'";//生成html地址
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	if(!$isok){
		echo "<p>栏目未成功生成html地址</p>";
		return false;
	}
	echo "\n<tr>";
	echo "<th>栏目页</th>";
	echo "<th>提示</th>";
	echo "</tr>";
	for($i=0;$i<count($listnewitems);$i++){
		$items=$listnewitems[$i];
		$url=getNewsItemsUrl($items);
		if(substr_count($url,"http")>0)continue;
		echo "\n<tr>";
		echo "<td>生成栏目<font class='cred'>".$items["ITEMSCODE"]."</font>.".$items["TITLE"]."</td>";
		echo "<td><iframe width=\"400\" height=\"40\" frameborder=\"0\" style=\"margin:0px; padding:0px;\" src=\"".$url."\"></iframe></td>";
		echo "</tr>";
	}

}

//==新闻=============
function CreateNewsHtml(){
	$listNews=DB::getInstance()->execQuery("select * from ims_news");
	$sql_array=array();
	foreach ($listNews as $newsObj){
		$htmlurl="a/news/".$newsObj["ID"].".html";
		$sql_array[]="update ims_news set HTMLURL='".$htmlurl."' where id='".$newsObj["ID"]."'";//生成html地址
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	if(!$isok){
		echo "新闻未成功生成html地址";
		return false;
	}
	echo "\n<tr>";
	echo "<th>信息页</th>";
	echo "<th>提示</th>";
	echo "</tr>";
	foreach ($listNews as $newsObj){
		$url = ParaUtil::getInstance()->getRoot()."/web/front/news/detail.php?isCreateHtml=1&newsid=".$newsObj["ID"];
		echo "\n<tr>";
		echo "<td>生成新闻ID为<font class='cred'>".$newsObj["ID"]."</font></td>";
		echo "<td><iframe width=\"400\" height=\"40\" frameborder=\"0\" style=\"margin:0px; padding:0px;\" src=\"".$url."\"></iframe></td>";
		echo "</tr>";
	}
}

//==新闻链接地址=============
function getNewsItemsUrl($items){
	$url="";
	$modeltype=trim($items["MODELTYPE"]);
	$url="";
	if($modeltype=="NEWSITEM"){
		$url="web/front/news/news.php?itemscode=".$items["ITEMSCODE"]."&isCreateHtml=1";
	}elseif($modeltype=="SUPPLYCLASS"){
		$classcode=trim($items["KEYVALUE"]);
		$url="web/front/supply/supplys.php?itemscode=".$items["ITEMSCODE"]."&classcode=".$classcode."&isCreateHtml=1";
	}elseif($modeltype=="URL"){
		$linkurl=trim($items["KEYVALUE"]);
		if(substr_count($linkurl,"?")>0){
			if(substr_count($linkurl,"itemscode")>0){
				$url=$linkurl;
			}else{
				$url=$linkurl."&itemscode=".$items["ITEMSCODE"];
			}
		}else{
			$url=$linkurl."?itemscode=".$items["ITEMSCODE"];
		}
		if(substr_count($url,"http")>0){
		}else{
			$url=ParaUtil::getInstance()->getRoot()."/".$url."&isCreateHtml=1";
		}
	}
	return $url;
}
//===========================================================================================================================================================================
?>
<?php include '../../../manage/include/page/bottom.php';?>