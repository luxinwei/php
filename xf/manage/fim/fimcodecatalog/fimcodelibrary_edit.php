<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimCodecatalog.class.php';?>
<?php include '../../../com/core/fim/FimCodelibrary.class.php';?>
<?php
	$keyvalue=Fun::request("key");
	$codeno=Fun::request("codeno");
	$obj=FimCodelibrary::getInstance()->getOne($keyvalue);
	if($codeno==""&&count($obj)>0){
		$codeno=trim($obj["CODENO"]);
	}
	$codename=FimCodecatalog::getInstance()->getCatalogTitle($codeno);
	
	$opttitle="";
	if($keyvalue==""){
		$opttitle="增加";
	}else{
		$opttitle="编辑";
	}
?>

<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="key" id="key"  value="<?php echo($keyvalue);?>">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<input type="hidden" name="codeno" id="codeno"  value="<?php echo($codeno);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption class="alert_info f12">[<?php echo $codename?>]<?php echo $opttitle?></caption>
<tr>
	<th><font color="red">*</font>编码：</th>
	<td><input style="width:500px;" name="itemno" id="itemno"  value="<?php echo($obj["ITEMNO"]);?>"></td>
</tr>
<tr>
	<th >名称：</th>
	<td><input style="width:500px;" name="itemname" id="itemname"  value="<?php echo($obj["ITEMNAME"]);?>"></td>
</tr>
<tr>
	<th >备注：</th>
	<td><textarea style="width:500px;height:100px;"  name="remark" id="remark"  ><?php echo($obj["REMARK"]);?></textarea></td>
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
<script type="text/javascript">
var codeno="<?php echo $codeno;?>";
</script>
<script type="text/javascript" src="js/fimcodelibrary_edit.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>