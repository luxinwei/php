<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="code"  placeholder="请输入编号" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<input type="button" value="反馈" class="hmui-btn ml10 fr" id="btn_feedback"/>

 </form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
			<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
	
		<th>编号</th>
		<th>颁布单位</th>		
		<th>检查时间</th>
		<th>整改期限(天)</th>
		<th>整改状态</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                         
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var rectificationStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("rectificationStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称

</script>           
<script type="text/javascript" src="js/rectificationnotice_list.js"></script>