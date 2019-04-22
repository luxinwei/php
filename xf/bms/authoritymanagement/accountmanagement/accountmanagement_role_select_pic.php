<?php include '../../../authen/include/page/top.php';?>
<?php 
$appCode = Fun::request("appCode");
$id = Fun::request("id");
?>
<div class="mt10 hmui-shadow">
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');"  name="checkbox"  /></th>
		<th>名称</th>
		<th>APPCode</th>
		<th>角色</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50">
	 	<input type="button" class="hmui-btn ml20 mt10" value="授权" id="selectFun">
	</div>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php  echo $id?>";
var appCode="<?php  echo $appCode?>";
</script>           
<script type="text/javascript" src="../../../etc/js/layui/layui.js"></script>
<script type="text/javascript" src="js/accountmanagement_role_select.js"></script>