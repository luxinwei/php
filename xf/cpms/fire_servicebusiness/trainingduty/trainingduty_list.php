<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="trainingTitle"  placeholder="请输入建筑名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<input type="button" value="反馈" class="hmui-btn ml10 fr" id="btn_check"/>

 </form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>

		<th>培训标题</th>
		<th>培训内容</th>
		<th>开始时间</th>
		<th>结束时间</th>
		<th>培训状态</th>
		<th>参加率</th>
		<th>合格率</th>
		<th class="tc" width="100">操作</th>
	</tr>
    <tbody id="tbody_content"></tbody>                                                                  
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
</script>           
<script type="text/javascript" src="js/trainingduty_list.js"></script>