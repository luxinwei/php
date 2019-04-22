<?php include '../../../manage/include/page/top.php';?>

<?php
	$keyvalue=Fun::request("keyvalue");
	$obj=FimOrg::getInstance()->getOne($keyvalue);//当前对象
	if(empty($obj)){	
		return ;
	}
	$parent_obj=FimOrg::getInstance()->getOne($obj["PARENTID"]);
	$target=trim($obj["TARGET"]);
	$valid=trim($obj["VALID"]);
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption>机构调整</caption>
<tr>
	<td  width="90">上级机构：</td>
	<td><font class="cred fb"><?php echo($parent_obj["TITLE"]);?></font></td>
</tr>
<tr>
<td>调整所属机构：</td>
<td>
	<input name="parentid"       id="parentid"    type="hidden"  value="<?php echo($parent_obj["ID"]);?>">
	<select name="newparentid"    id="newparentid">
		<?php echo(FimOrg::getInstance()->getMenuSelectOption($obj["ID"],$parent_obj["ID"]));?>
	</select>
</td>
</tr>
<tr>
	<td>名称：</td>
	<td><?php echo($obj["TITLE"]);?></td>
</tr>

<td></td>
	<td>
    <input class="button_paleblue4" type="button" name="ok" value="确 定" id="saveok"/>
    </td>
</tr>
</table>
</form>
<script type="text/javascript">
var keyvalue="<?php echo($keyvalue);?>";
</script>
<script type="text/javascript" src="js/fimorg_changeitem.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>