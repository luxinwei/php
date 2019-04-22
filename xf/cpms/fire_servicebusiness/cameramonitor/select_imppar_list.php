<?php include '../../../authen/include/page/top.php';?>

<div class="hmui-shadow">

<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入部位名称" class="hmui-input"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	
		<th>部位编码</th>
		<th>部位名称</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                  
</table>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/select_imppar_list.js"></script>