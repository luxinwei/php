<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form class="alert_info" id="myform">
<input  placeholder="请输入关键字"  name="name"class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<span class="fr">
<input type="button" value="新建" class="hmui-btn  ml10" id="btn_add" />
<input type="button" value="编辑" class="hmui-btn  ml10" id="btn_edit" />
 	<input type="button" value="删除" class="hmui-btn  ml10" id="btn_del" />
</span>
	</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
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
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
 </script>      
<script type="text/javascript" src="js/traintaskmanagement_list.js"></script>