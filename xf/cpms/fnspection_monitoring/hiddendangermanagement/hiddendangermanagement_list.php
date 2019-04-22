<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form  id="myform" class="alert_info">
<input name="content"  placeholder="请输入隐患内容" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<span class="fr">
<input type="button" value="新建" class="hmui-btn ml10" id="btn_add"/>
<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
<input type="button" value="导出" class="hmui-btn fr ml10" />
</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>隐患内容</th>
		<th>发现时间</th>
 		<th>治理完成时间</th>
 		<th>治理情况</th>
		<th>治理人员姓名</th>
		<th class="tc" width="100">操作</th>
	</tr>                                                                       
	<tbody id="tbody_content"></tbody>    
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var governanceStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("governanceStateCode")?>;  
var result_jsarray=[['0','未处理'],['1','处理中'],["2","已处理"]];
</script>           
<script type="text/javascript" src="js/hiddendangermanagement_list.js"></script>