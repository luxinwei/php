<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form  id="myform" class="alert_info">
<input name="buildingName"  placeholder="请输入建筑名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
		<input type="button" value="导出" class="hmui-btn ml10" id="btn_xls"/>
		<input type="button" value="下载模板" class="hmui-btn ml10" id="btn_build"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>网格名称</th>
		<th>所属区域</th>
		<th>部门接口人姓名</th>
		<th>部门接口人电话</th>
		<th>管辖区域</th>
		<th>上级单位名称</th>
 		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                             
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/gridunit_list.js"></script>