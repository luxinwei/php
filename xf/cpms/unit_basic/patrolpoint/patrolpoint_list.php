<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#ffffff">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入巡查点名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
   	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>巡查点名称</th>
		<th>位置</th>
		<th>区号</th>
		<th>位号</th>
		<th>RFID</th>
		<th class="tc" width="100">操作</th>
	</tr>
  <tbody id="tbody_content"></tbody>
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/patrolpoint_list.js"></script>