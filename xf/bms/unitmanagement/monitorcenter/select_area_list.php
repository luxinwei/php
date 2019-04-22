<?php include '../../../authen/include/page/top.php';?>

<div class="hmui-shadow">

<form id="myform" class="alert_info" >
	<input  placeholder="名称" class="hmui-input mr100"/>

	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>编码</th>
		<th>名称</th>
		<th>sign</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                  
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/select_area_list.js"></script>