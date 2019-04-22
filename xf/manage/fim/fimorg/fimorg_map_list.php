<?php include '../../../manage/include/page/top.php';?>
<?php 
$root=FimOrg::getInstance()->getRoot();
$rmapx=trim($root["MAPX"]);
$rmapy=trim($root["MAPY"]);
$title=$_GET["title"];
$type=$_GET["type"];
$orgkind=$_GET["orgkind"];
?>
<style type="text/css">
	#container {height: 600px;;width:100%;}
</style>
<form name="myform" id="myform" method="post" class="alert_info f12">
<select class="hmui-select"  name="type" id="type">
    <option value="">类型</option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGTYPE", $type)?>
	</select>
<select class="hmui-select"  name="orgkind" id="orgkind">
	<option value="">类别</option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGKIND", $orgkind)?>
</select> 

组织名称：    <input name="title" id="title" value="<?php echo $title;?>" class="hmui-input">

<input id="btn_find" type="button" value="查询" class="layui-btn layui-btn-normal layui-btn-small"> 

<input id="btn_his" type="button" value="返回" class="layui-btn layui-btn-normal layui-btn-small"> 
</form>
<div id="container"></div>
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript">

    var rmapx="<?php echo $rmapx;?>";
	var rmapy="<?php echo $rmapy;?>";
	
</script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo ParaUtil::getInstance()->getContent("BAIDU_AK");?>"></script>
<script type="text/javascript" src="js/fimorg_map_list.js"></script>