<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入设施名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
 <span class="fr">
		<input type="button" value="增加" class="hmui-btn  " id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
		<input type="button" value="导出" class="hmui-btn ml10" id="btn_xls"/>
 </span>
 <div class="cb"></div>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>设施名称</th>
		<th>部件类型</th>
		<th>部件名称</th>
		<th>部件型号</th>
		<th>安装位置</th>
		<th>部件状态</th>
		<th class="tc" width="100">操作</th>
	</tr>                   
	<tbody id="tbody_content"></tbody>                                                
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var result_jsarray=[['01','正常'],['10','故障'],["20","报警"],["99","其他"]];
 var partTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("partTypeCode")?>; 

</script>           
<script type="text/javascript" src="js/devicepart_list.js"></script>