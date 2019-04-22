<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入关键字"  class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>查岗发起人名称</th>
		<th>发起时间</th>
		<th>结束时间</th>
		<th>查岗结果</th>
 		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                              
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var result_jsarray=[['0','不和格'],['1','合格']];
</script>   
<script type="text/javascript" src="js/checkjobrecord_list.js"></script>