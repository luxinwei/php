<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<blockquote class="hmui-nav hmui-shadow">重点单位信息->微型消防站管理 </blockquote>
<div class="mt10 hmui-shadow" style="background:#ffffff">
<form action="" id="myform"></form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
 		<th>姓名</th>
		<th>电话</th>
	</tr>
      <tbody id="tbody_content"></tbody>                                                                 
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>         
<script type="text/javascript" src="js/mini_firestation_search_user.js"></script>
