<?php include '../../../manage/include/page/top.php';?>

<?php
	$keyvalue=Fun::request("keyvalue");
	$parentid=Fun::request("parentid");
	$parent_obj=array();//父亲对象
	$obj=FimOrg::getInstance()->getOne($keyvalue);//当前对象
	if(!empty($obj)){	
		$parent_obj=FimOrg::getInstance()->getOne($obj["PARENTID"]);
	}else{
		$parent_obj=FimOrg::getInstance()->getOne($parentid);
	}
	if(empty($parent_obj)){
		$parent_obj=FimOrg::getInstance()->getRoot();
	}	
	$target=trim($obj["TARGET"]);
	
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<input name="parentid" id="parentid" type="hidden"  value="<?php echo($parent_obj["ID"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<tr>
	<td>父机构：</td>
	<td><font class="cred fb"><?php echo($parent_obj["TITLE"]);?></font></td>
</tr>
<tr>
	<td>名称：</td>
	<td><input name="title" id="title"  value="<?php echo($obj["TITLE"]);?>"></td>
</tr>
<tr>
	<td>类型：</td>
	<td>
	<select name="type" id="type">
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGTYPE", $obj["TYPE"])?>
	</select>
	</td>
</tr>
<tr>
	<td>组织类别：</td>
	<td>
	<select name="orgkind" id="orgkind">
	<option value=""></option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGKIND", $obj["ORGKIND"])?>
	</select>
	</td>
</tr>
<tr>
	<td></td>
	<td><input class="button_paleblue4" type="submit" name="ok" value="确 定"/></td>
</tr>
</table>
</form>
<script type="text/javascript" src="js/fimorg_edit.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>