<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form id="myform" class="alert_info" >
	<input  placeholder="中心名称" class="hmui-input3 mr100 w300" id="keyname"/>
	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
   	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>所属设施</th>
		<th>项目名称</th>
		<th>检测单位</th>
		<th>检测时间</th>
		<th>检测负责人</th>
		<th>检测结果</th>
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
<script type="text/javascript" src="js/facilitymonitoring_list.js"></script>