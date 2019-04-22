<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
 
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入演练名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<input type="button" value="反馈" class="hmui-btn ml10 fr" id="btn_feedback"/>


 </form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
	
 		<th>演练名称</th>
		<th>演练内容</th>
		<th>开始时间</th>
		<th>结束时间</th>
		<th>演练要求</th>
		<th>演练状态</th>
		<th>演练结果</th>
 		<th class="tc" width="100">操作</th>
	</tr>
    <tbody id="tbody_content"></tbody>                                                                
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
var result_jsarray=[['0','已完成'],['1','未完成']];
</script>           
<script type="text/javascript" src="js/practicetask_list.js"></script>