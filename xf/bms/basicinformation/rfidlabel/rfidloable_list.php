  <?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
 <form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入建筑名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search" />
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
		<input type="button" value="导出" class="hmui-btn ml10" id="btn_xls"/>
	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>卡印刷号</th>
		<th>入库日期</th>
		<th>绑定状态</th>
		<th>绑定巡查点</th>
 	</tr>
<tbody id="tbody_content"></tbody>                                                                       
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>

<script type="text/javascript">
 
</script>          
<script type="text/javascript" src="js/camera_list.js"></script>