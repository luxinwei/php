<?php include '../../../authen/include/page/top.php';?>
 

<div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
       	<select class="hmui-input3 w300 "  id="checkResultCode">
	    <option value="">巡查结果</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("checkResultCode", "")?>
	    </select>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
 
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
 		<th>巡查日期</th>
		<th>巡查人姓名</th>
		<th>巡查内容</th>
		<th>巡查结果</th>
 		<th class="tc" width="100">操作</th>
	</tr>                                                                
	<tbody id="tbody_content"></tbody>    
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var checkResultCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("checkResultCode")?>;  

</script>           
<script type="text/javascript" src="js/firepatrolrecod_list.js"></script>