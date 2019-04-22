<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form class="alert_info" id="myform">
<input  placeholder="请输入编号" class="hmui-input3 w300" name="code"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<input type="button" value="删除" class="hmui-btn fr mr10" id="btn_del"/>
<input type="button" value="编辑" class="hmui-btn fr mr10" id="btn_edit"/>
<input type="button" value="新建" class="hmui-btn fr mr10" id="btn_add"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	    <th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>整改通知编号</th>
		<th>下发单位编号</th>
		<th>整改单位</th>
		<th>检查时间</th>
		<th>整改状态</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                      
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var rectificationStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("rectificationStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
</script>           
<script type="text/javascript" src="js/rectificationnotice_list.js"></script>