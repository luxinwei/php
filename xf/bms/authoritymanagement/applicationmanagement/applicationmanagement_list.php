<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">

<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
 
		<th>应用名称</th>
		<th>level</th>
		<th>创建日期</th>
		<th>APPCode</th>
		<th> </th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="../../../etc/js/layui/layui.js"></script>
<script type="text/javascript" src="js/applicationmanagement_list.js"></script>