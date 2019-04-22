<?php include '../../../manage/include/page/top.php';?>

<?php
	$keyvalue=Fun::request("keyvalue");
	$obj=FimOrg::getInstance()->getOne($keyvalue);//当前对象
    $address=trim($obj["ADDRESS"]);
	$mapx=trim($obj["MAPX"]);
	$mapy=trim($obj["MAPY"]);
	
	
	$root=FimOrg::getInstance()->getRoot();
	$rmapx=trim($root["MAPX"]);
	$rmapy=trim($root["MAPY"]);
?>


<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="orgid" id="orgid"  value="<?php echo($obj["ID"]);?>">

<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<tr>
	<td width="100">组织：</td>
	<td><?php echo($obj["TITLE"]);?></td>
</tr>

<tr>
	<td>地址：</td>
	<td><input class="hmui-input w300" name="address" id="address"  value="<?php echo($obj["ADDRESS"]);?>">
	<input value="搜索位置" type="button" style="margin:5px;" onclick="getPint()" class="layui-btn layui-btn-normal layui-btn-small"/>
	</td>
</tr>
<tr>
	<td>标注：</td>
	<td>
	<div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
		维度：<input readonly class="hmui-input " id="mapx" name="mapx" style="width:80px" value="<?php echo $mapx;?>" />
		经度：<input readonly class="hmui-input " id="mapy" name="mapy" style="width:80px" value="<?php echo $mapy;?>"/>
		<input value="保存标注" type="button" style="margin:5px;" onclick="save()"  class="layui-btn layui-btn-normal layui-btn-small"/>
		<input value="取消标注" type="button" style="margin:5px;" onclick="clearfn()"  class="layui-btn layui-btn-normal layui-btn-small"/>
		 <input id="btn_his" value="返回" type="button" style="margin:5px;"class="layui-btn layui-btn-normal layui-btn-small"/>
	</td>
</tr>

</table>
</form>
<style type="text/css">
	#container {height: 600px;;width:100%;}
</style>


<br/>
<div id="container"></div>
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript">
    var shopname="<?php echo $obj["TITLE"];?>";
    var mapx="<?php echo $mapx;?>";
	var mapy="<?php echo $mapy;?>";
	var address="<?php echo $address;?>";
	   var rmapx="<?php echo $rmapx;?>";
		var rmapy="<?php echo $rmapy;?>";
</script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo ParaUtil::getInstance()->getContent("BAIDU_AK");?>"></script>
<script type="text/javascript" src="js/baidumap.js"></script>
<script type="text/javascript" src="js/baidumap_searchaddress.js" ></script>
<script type="text/javascript" src="js/fimorg_map_edit.js"></script>