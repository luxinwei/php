<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入法规名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>法规名称</th>
		<th>法规类别</th>
		<th>颁布机关</th>
		<th>颁布文号</th>
		<th>颁布日期</th>
		<th>实施日期</th>
		<th class="tc" width="100">操作</th>
	</tr>
  <tbody id="tbody_content"></tbody>                                             
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript"> 
var fireLawCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireLawCode")?>; 
</script>           
<script type="text/javascript" src="js/filecode_list.js"></script>