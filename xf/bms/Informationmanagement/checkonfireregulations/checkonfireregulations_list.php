<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
<span class="fr">
<input type="button" value="新建" class="hmui-btn  ml10" id="btn_add"/>
<input type="button" value="修改" class="hmui-btn  ml10" id="btn_edit"/>
<input type="button" value="删除" class="hmui-btn  ml10" id="btn_del"/>
<input type="button" value="审核" class="hmui-btn  ml10" id="btn_prc"/>
<input type="button" value="发布" class="hmui-btn  ml10" id="btn_release"/>
<input type="button" value="撤回" class="hmui-btn  ml10" id="btn_withdraw"/>
</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>法规名称</th>
		<th>法规类别</th>
		<th>颁布机关</th>
		<th>颁布文号</th>
		<th>颁布日期</th>
		<th>实施日期</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var fireLawCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireLawCode")?>;
</script>           
<script type="text/javascript" src="js/checkonfireregulations_list.js"></script>