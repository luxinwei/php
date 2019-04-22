<?php include '../../../authen/include/page/top.php';?>

<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="depName"  placeholder="请输入所属单位名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>建筑名称</th>
		<th>储存物名称</th>
		<th>储存物数量（个）</th>
		<th>储存物性质 </th>
		<th>储存物形态</th>
		<th>储存容积（m³）</th>
		<th>主要原料</th>
		<th>主要产品</th>
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
</script>           
<script type="text/javascript" src="js/storage_list.js"></script>