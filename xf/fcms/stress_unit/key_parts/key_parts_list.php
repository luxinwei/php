<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入重点部位名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>重点部位名称</th>
		<th>所属建筑</th>
		<th>耐火等级</th>
		<th>所在位置</th>
		<th>使用性质</th>
		<th>防火标志设立情况</th>
 		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingResistFireCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingResistFireCode")?>;  
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  
var fireproofSignCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireproofSignCode")?>;  
var dangerSourceCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dangerSourceCode")?>;  
</script>           
<script type="text/javascript" src="js/key_parts_list.js"></script>