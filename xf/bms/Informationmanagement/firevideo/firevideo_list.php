<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input w300"/>
<input type="button" value="搜索" class="hmui-btn"/>
	<span class="fr">
		<input type="button" value="新建" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="审核" class="hmui-btn ml10" />
		<input type="button" value="发布" class="hmui-btn ml10" />
		<input type="button" value="撤回" class="hmui-btn ml10" />
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
	</span>

</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>	
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>视频名称</th>
		<th>视频简介</th>
		<th>上传人</th>
		<th>上传时间</th>
		<th class="tc" width="100">操作</th>
	</tr>                   
	<tbody id="tbody_content"></tbody>                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/firevideo_list.js"></script>