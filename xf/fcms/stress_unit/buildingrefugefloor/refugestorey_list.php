<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="depName"  placeholder="请输入所属单位名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>建筑名称</th>
		<th>避难层位置</th>
		<th>避难层面积（㎡）</th>
		<th>建筑物所属单位名称 </th>
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
<script type="text/javascript" src="js/refugestorey_list.js"></script>