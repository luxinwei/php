<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
 
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>单位名称</th>
		<th>起火部位</th>
		<th>起火时间</th>
		<th>起火原因</th>
		<th>报警方式</th>
		<th>过火面积（㎡）</th>
		<th>死亡人数（个）</th>
		<th>受伤人数（个）</th>
		<th>财产损失（元）</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                       
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var alarmTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("alarmTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
 
</script>           
<script type="text/javascript" src="js/fireinfomanagement_list.js"></script>