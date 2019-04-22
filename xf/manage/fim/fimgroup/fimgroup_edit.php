<?php include '../../../manage/include/page/top.php';?>

<?php
	$key=Fun::request("key");
	$obj=FimGroup::getInstance()->getOne($key);
	$valid=trim($obj["VALID"]);
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption class="alert_info">角色维护</caption>
<tr>
	<th width="100">角色名称：</th>
	<td><input style="width:500px;" name="title" id="title"  value="<?php echo($obj["TITLE"]);?>"></td>
</tr>

<tr>
	<th >描述：</th>
	<td><textarea style="width:500px;height:100px;"  name="description" id="description"  ><?php echo($obj["DESCRIPTION"]);?></textarea></td>
</tr>

<tr>
	<th >有效标志：</th>
	<td><input name="valid" type="checkbox" value="1" <?php if(strcasecmp($valid,"1")==0) echo "checked"?>/></td>
</tr>

	<tr>
		<td></td>
		<td>
			<input class="layui-btn layui-btn-normal " type="submit" name="ok" value="确 定"/>
			 <input class="layui-btn layui-btn-primary " type="button" name="ok" value="返回" id="backhistory"/>
		</td>
	</tr>
</table>
</form>
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript">
var sf_array="<?php echo(CodeUtil::getInstance()->getCodeJsArray("SF"));?>";
</script>
<script type="text/javascript" src="js/fimgroup_edit.js"></script>
