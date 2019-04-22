<?php include '../../../manage/include/page/top.php';?>

<?php
	$key=Fun::request("key");
	$orgid=Fun::request("orgid");
	$obj=FimGroup::getInstance()->getOne($key);
	if(count($obj)>0){
		$orgid=$obj["ORGID"];
	}
	$valid=trim($obj["VALID"]);
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="orgid" id="orgid"  value="<?php echo($orgid);?>">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption class="alert_info">岗位维护</caption>
<tr>
	<th width="100">名称：</th>
	<td><input  name="title" id="title"  value="<?php echo($obj["TITLE"]);?>"></td>
</tr>

<tr>
	<th >描述：</th>
	<td><textarea style="width:300px;height:100px;"  name="description" id="description"  ><?php echo($obj["DESCRIPTION"]);?></textarea></td>
</tr>

<tr>
	<th >管理级别：</th>
	<td>
	<select name="grouplevel" id="grouplevel">
	<option value="">级别</option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIMGROUPLEVEL", $obj["GROUPLEVEL"]);?>
	</select>
	
	</td>
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
var orgid="<?php echo $orgid;?>";
var sf_array="<?php echo(CodeUtil::getInstance()->getCodeJsArray("SF"));?>";
</script>
<script type="text/javascript" src="js/fimgroup_edit.js"></script>
