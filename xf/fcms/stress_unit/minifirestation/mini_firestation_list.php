<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入微型消防站名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>名称</th>
		<th>所属单位</th>
		<th>编码</th>
		<th>位置 </th>
		<th>负责人</th>
		<th>联系电话</th>
		<th>值班电话</th>
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
<script type="text/javascript" src="js/mini_firestation_list.js"></script>