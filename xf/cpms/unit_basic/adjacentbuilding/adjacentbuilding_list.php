<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn  " id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
		<input type="button" value="导出" class="hmui-btn ml10" id="btn_xls"/>
	</span>
	<div class="cb"></div>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>建筑名称</th>
		<th>方向</th>
		<th>毗邻建筑物名称</th>
		<th>使用性质</th>
		<th>结构类型</th>
		<th>建筑高度（m）</th>
		<th>与本建筑物间距（m）</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingDrectionCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingDrectionCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var buildingStructureCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingStructureCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称

</script>           
<script type="text/javascript" src="js/adjacent_building_list.js"></script>