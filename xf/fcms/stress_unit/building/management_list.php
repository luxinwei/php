<?php include '../../../authen/include/page/top.php';?>
<div class="hmui-shadow mt10" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入建筑名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	
		<th>建筑名称</th>
		<th>类别</th>
		<th>使用性质</th>
		<th>火灾危险性 </th>
		<th>耐火等级</th>
		<th>建筑高度（m）</th>
		<th>日常工作时间人数</th>
		<th>消防控制室</th>
		<th>建筑物所属单位名称</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingTypeCode")?>;  
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  
var buildingFireDangerCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingFireDangerCode")?>;  
var buildingResistFireCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingResistFireCode")?>;  
</script>           
<script type="text/javascript" src="js/management_list.js"></script>