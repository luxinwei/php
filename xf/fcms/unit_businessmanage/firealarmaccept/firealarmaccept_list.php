<?php include '../../../authen/include/page/top.php';?>
<div class="hmui-shadow mt10" style="background:#FFFFFF">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>单位名称</th>
		<th>首次报警时间</th>
		<th>受理时间</th>
		<th>受理结束时间</th>
		<th>信息类型</th>
		<th>信息描述</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                       
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var acceptedConfirmCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedConfirmCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称

</script>           
<script type="text/javascript" src="js/firealarmaccept_list.js"></script>