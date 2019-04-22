<?php include '../../../manage/include/page/top.php';?>

<?php
	$parentid=Fun::request("parentid");
	$parent_obj=array();//父亲对象
	if(strcmp($parentid,"")==0){
		$parent_obj=FimOrg::getInstance()->getRoot();
	}else{
		$parent_obj=FimOrg::getInstance()->getOne($parentid);
	}
	
	$list=FimOrg::getInstance()->getNextList($parent_obj[ID]);
?>


<form name="myform">
	<table border="0" cellpadding="5" cellspacing="0" class="box_keep">
	<tr>
	<th colspan=2>[<?php echo$parent_obj[TITLE] ?>]子目录排序</th>
	</tr>
		<tr>

		<td>
		<select  multiple name="left" id="left" size="23" style="min-width:100px;min-height:160px;max-height:500px;">
	 <?php
	foreach ($list as $menu){
			$title = trim($menu[TITLE]);
			$id=trim($menu[ID]);
			echo "<option value=\"".$id."\">".$title."</option>";
	}
	 ?>
  </select>
		</td>
			<td width=50>
			<input type="button" value="置顶" onClick="moveTop(document.getElementById('left'))">
			<br><br><input type="button" value="向上" onClick="moveUp(document.getElementById('left'))">
			<br><br><input type="button" value="向下" onClick="moveDown(document.getElementById('left'))">
			<br><br><input type="button" value="置底" onClick="moveBottom(document.getElementById('left'))">
			</td>
		</tr>
		<tr>
		<td colspan=2><input class="button_paleblue2" type="button" name="ok" value="确 定" onclick="checkform()" /></td>
		</tr>
	</table>
</form>


<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/fimorg_order.js"></script>