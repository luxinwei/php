<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form  id="myform" class="alert_info">
<input name="depName"  placeholder="请输入单位名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>单位名称</th>
		<th>巡查点</th>
		<th>巡查日期</th>
		<th>巡查人姓名</th>
		<th>巡查内容</th>
		<th>巡查结果</th>
		<th class="tc" width="100">操作</th>
	</tr>
      <tbody id="tbody_content"></tbody>                                                                        
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var checkResultCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("checkResultCode")?>;  

</script>           
<script type="text/javascript" src="js/firepatrolrecod_list.js"></script>