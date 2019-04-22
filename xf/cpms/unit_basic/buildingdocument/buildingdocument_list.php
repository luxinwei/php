<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入建筑名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>建筑名称</th>
		<th>结构类型</th>
		<th>火灾危险性 </th>
		<th>地上层数</th>
		<th>地下层数</th>
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
 var buildingFireDangerCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingFireDangerCode")?>;  
</script>           
<script type="text/javascript" src="js/buildingdocument_list.js"></script>