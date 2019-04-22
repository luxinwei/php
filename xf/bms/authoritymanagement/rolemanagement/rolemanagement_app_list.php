<?php include '../../../authen/include/page/top.php';?>

<div class="hmui-shadow">

<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入应用名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
 		<th>编码</th>
		<th>应用</th>
		<th>应用名称</th>
 	</tr>
	<tbody id="tbody_content"></tbody>                                                                  
</table>
</div>
<div id="pageNav"></div>
<div id="s"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 </script>           
<script type="text/javascript" src="js/rolemanagement_app_list.js"></script>