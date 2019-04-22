<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimMenuitem.class.php';?>
<?php
	$parentid=Fun::request("parentid");
	$parent_obj=array();//父亲对象
	if(strcmp($parentid,"")==0){
		$parent_obj=FimMenuitem::getInstance()->getRoot();
	}else{
		$parent_obj=FimMenuitem::getInstance()->getOne($parentid);
	}
	
	$list=FimMenuitem::getInstance()->getNextList($parent_obj[ID]);
?>


<form name="myform">
	<table border="0" cellpadding="5" cellspacing="0" class="box_keep">
		<tr>
		<td width=100>
		[<?php echo$parent_obj[TITLE] ?>]子目录排序
		</td>
		<td  width=300>
		<select  multiple name="left" id="left" size="23" style="width:300px;height:160px;">
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
			<td>
			 <input class="button_paleblue2" type="button" name="ok" value="确 定" onclick="checkform()" />
			</td>
		</tr>
	</table>
</form>


<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/fimmenuitem_order.js"></script>