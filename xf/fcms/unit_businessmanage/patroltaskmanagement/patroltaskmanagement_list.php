<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
<input type="button" value="新建" class="hmui-btn fr ml10" id="btn_build"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>执行单位</th>
		<th>任务标题</th>
		<th>巡查部位</th>
		<th>巡查设施</th>
		<th>巡查策略</th>
		<th>巡查人员</th>
		<th>巡查要求</th>
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
<script type="text/javascript" src="js/patroltaskmanagement_list.js"></script>