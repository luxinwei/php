<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
 	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
 		<th>执行单位</th>
		<th>任务标题</th>
 		<th>巡查类别</th>
		<th>巡查人员</th>
 		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var patrolTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("patrolTypeCode")?>; 

</script>           
<script type="text/javascript" src="js/inspectiontask_list.js"></script>