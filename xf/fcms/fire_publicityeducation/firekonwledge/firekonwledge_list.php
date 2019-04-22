<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入常识名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid">
	<tr>
	<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>名称</th>
		<th>输入日期</th>
		<th>输入人姓名</th>
		<th>常识内容</th>
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
<script type="text/javascript" src="js/firekonwledge_list.js"></script>