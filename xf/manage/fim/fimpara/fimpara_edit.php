<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimPara.class.php';?>
<?php
	$keyvalue=Fun::request("key");
	$obj=FimPara::getInstance()->getOne($keyvalue);
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input name="paracode" id="paracode" type="hidden" value="<?php echo($obj[PARACODE]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption>参数维护</caption>
<tr>
	<th width="200"><font color=red>*</font>参数代码：</th>
	<td><?php echo($obj[PARACODE]);?></td>
</tr>
<tr>
	<th >参数内容：</th>
	<td><input style="width: 500px;" name="paracontent" id="paracontent"  value="<?php echo($obj[PARACONTENT]);?>"></td>
</tr>
<tr>
	<th >描述：</th>
	<td><input style="width: 500px;" name="description" id="description"  value="<?php echo($obj[DESCRIPTION]);?>"></td>
</tr>
	<tr>
		<td></td>
		<td>
		<input class="layui-btn layui-btn-normal" type="submit" name="ok" value="确 定"/>
		<input class="layui-btn layui-btn-primary" type="button" name="ok" value="返回" id="backhistory"/>
		</td>
	</tr>
</table>
</form>
<script type="text/javascript" src="js/fimpara_edit.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>