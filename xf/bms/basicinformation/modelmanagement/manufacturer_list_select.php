<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入名称"  class="hmui-input w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search" />
 
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
 		<th>厂商</th>
 	</tr>
<tbody id="tbody_content"></tbody>                                                                       
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>

<script type="text/javascript">
 
</script>          
<script type="text/javascript" src="js/manufacturer_list_select.js"></script>