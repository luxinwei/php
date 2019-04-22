<?php include '../../../authen/include/page/top.php';?>
<?php 
$sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];
$manageuseraccount=trim($sessionManageUserArray["USERACCOUNT"]);
?>
 <body style="background:#FFFFFF">
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>屏蔽时间</th>
		<th>所属建筑</th>
		<th>所属部位</th>
		<th>所属设施</th>
		<th>所属部件</th>
		<th class="tc" width="100">操作</th>
	</tr>
 <tbody id="tbody_content"></tbody>                                                                      
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var manageuseraccount="<?php echo $manageuseraccount?>";
</script>  
<script type="text/javascript" src="js/automaticfirealarm_list_content4.js"></script>
</body>