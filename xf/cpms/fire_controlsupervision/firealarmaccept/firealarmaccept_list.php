<?php include '../../../authen/include/page/top.php';?>
<div class="hmui-shadow mt10" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
    	 <select class="hmui-input3 w300"  id="acceptedTypeCode">
	    <option value="">请选择信息类型</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("acceptedTypeCode", "")?>
	    </select> 
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
 		<th>首次报警时间</th>
		<th>受理时间</th>
		<th>受理结束时间</th>
		<th>信息类型</th>
		<th>信息描述</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                       
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var acceptedConfirmCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedConfirmCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称

</script>           
<script type="text/javascript" src="js/firealarmaccept_list.js"></script>