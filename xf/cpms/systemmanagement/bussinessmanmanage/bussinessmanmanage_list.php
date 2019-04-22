<?php include '../../../authen/include/page/top.php';?>
 <div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入关键字" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="新建" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="修改" class="hmui-btn ml10" id="btn_edit"/>
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="激活" class="hmui-btn ml10" id="btn_activation"/>
		<input type="button" value="重置密码" class="hmui-btn ml10" id="btn_reset"/>
		<input type="button" value="冻结" class="hmui-btn ml10" id="btn_frozen"/>
	</span>
 </form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>人员姓名</th>
 		<th>联系电话</th>
		<th>是否受过消防培训 </th>
		<th>培训证书编号</th>
		<th>领证时间</th>
		<th>是否为疏散引导员</th>
 		<th class="tc" width="100">操作</th>
	</tr>
 
 <tbody id="tbody_content"></tbody> 
</table>
<div id="pageNav" class="mt20"></div>
<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var yesornot_jsarry=[["1","是"],["0","否"]];

</script>           
<script type="text/javascript" src="js/bussinessmanmanage_list.js"></script>