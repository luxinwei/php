<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimCodecatalog.class.php';?>
<?php include '../../../com/core/fim/FimCodelibrary.class.php';?>

<?php
	$codeno=Fun::request("codeno");
	$codename=FimCodecatalog::getInstance()->getCatalogTitle($codeno);
	$list=FimCodelibrary::getInstance()->getList($codeno);
?>
<form name="myform">

	<table border="0" cellpadding="5" cellspacing="0" class="box_keep" width="100%">
	<caption>[<?php echo $codename?>]排序</caption>
		<tr>
		<td>
		<ul>
		<li style="float: left;">
			<select  multiple name="left" id="left" size="23" style="width:300px;height:300px;">
			 <?php
				foreach ($list as $library){
						$title = trim($library["ITEMNAME"]);
						$id=trim($library["ID"]);
						echo "<option value=\"".$id."\">".$title."</option>";
				}
			 ?>
		    </select>
		</li>
		<li style="float: left;padding-top:60px;padding-left:10px;">
			        <input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="置顶" onClick="moveTop(document.getElementById('left'))">
			<br><br><input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="向上" onClick="moveUp(document.getElementById('left'))">
			<br><br><input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="向下" onClick="moveDown(document.getElementById('left'))">
			<br><br><input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="置底" onClick="moveBottom(document.getElementById('left'))">
		
		</li>
		</ul>
		
	
		
		</td>

		</tr>
		<tr>
		<td>
		   <input class="layui-btn layui-btn-normal" type="button" name="ok" value="确 定" onclick="checkform()" />
		   <input class="layui-btn layui-btn-primary" type="button" name="ok" value="返回" id="backhistory"/>
		</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
var codeno="<?php echo $codeno;?>";
</script>

<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/fimcodelibrary_order.js"></script>