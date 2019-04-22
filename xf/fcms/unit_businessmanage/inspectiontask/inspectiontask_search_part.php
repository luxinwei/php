<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<blockquote class="hmui-nav hmui-shadow">重点单位信息->微型消防站管理 </blockquote>
<div class="mt10 hmui-shadow">
<form action="" id="myform"></form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
 		<th>编号</th>
		<th>巡查点名称</th>
	</tr>
      <tbody id="tbody_content"></tbody>                                                                 
</table>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>         
<script type="text/javascript" src="js/inspectiontask_search_part.js"></script>
