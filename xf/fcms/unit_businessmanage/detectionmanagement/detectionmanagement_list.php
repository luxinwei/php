<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="buildingName"  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>巡查任务</th>
		<th>巡查开始时间</th>
		<th>巡查结束时间</th>
 		<th>是否超时</th>
 		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var overtimeFlag_jsarray=[['0','未超时'],['1','超时']];
</script>           
<script type="text/javascript" src="js/detectionmanagement_list.js"></script>