<?php include '../../../authen/include/page/top.php';?>
 <div class="mt10 hmui-shadow" style="background:#FFFFFF">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
<span class="fr">
<input type="button" value="新建" class="hmui-btn   ml10" id="btn_build"/>
<input type="button" value="审核" class="hmui-btn   ml10" id="btn_build"/>
<input type="button" value="发布" class="hmui-btn   ml10" id="btn_build"/>
<input type="button" value="撤回" class="hmui-btn   ml10" id="btn_build"/>
<input type="button" value="删除" class="hmui-btn   ml10" id="btn_build"/>
 </span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>公告内容</th>
		<th>公告范围</th>
		<th>输入人姓名</th>
		<th>输入日期</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                      
</table>
	 <div id="pageNav" class="mt20"></div>
	 <div class="h50"></div>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var bulletinAreaCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("bulletinAreaCode")?>;  

</script>           
<script type="text/javascript" src="js/systembulletin_list.js"></script>