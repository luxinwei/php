<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimCodecatalog.class.php';?>
<?php
	$keyvalue=Fun::request("key");
	$obj=FimCodecatalog::getInstance()->getOne($keyvalue);
	$opttitle="";
	if($keyvalue==""){
		$opttitle="增加类别";
	}else{
		$opttitle="编辑类别";
	}
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="key" id="key"  value="<?php echo($keyvalue);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption><?php echo $opttitle?></caption>
<tr>
	<th width="160"><font color=red>*</font>类别代码：</th>
	<td>
	<?php 
	if($keyvalue==""){
	?>
	<input style="width:300px;" name="codeno" id="codeno"  value="<?php echo($obj["CODENO"]);?>">
	<?php }else{?>
	<input type="hidden" name="codeno" id="codeno"  value="<?php echo($obj["CODENO"]);?>">
	<?php echo($obj[CODENO]);?>
	<?php }?>
	</td>
</tr>
<tr>
	<th ><font color=red>*</font>类别名称：</th>
	<td><input style="width:300px;" name="codename" id="codename"  value="<?php echo($obj["CODENAME"]);?>"></td>
</tr>
<tr>
	<th >类别描述：</th>
	<td><input style="width:300px;" name="codedescribe" id="codedescribe"  value="<?php echo($obj["CODEDESCRIBE"]);?>"></td>
</tr>
<tr>
	<th >编码长度：</th>
	<td><input name="itemnolength" id="itemnolength"  value="<?php echo($obj["ITEMNOLENGTH"]);?>"></td>
</tr>
	<tr>
		<td></td>
		<td>
		<input class="layui-btn layui-btn-normal" type="submit" name="ok" value="确 定"/>
		</td>
	</tr>
</table>
</form>
<script type="text/javascript" src="js/fimcodecatalog_edit.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>