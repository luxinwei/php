<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form  id="myform" class="alert_info"  >
<input  placeholder="请输入姓名查询" class="hmui-input3 w300" id="name" name="name"/>
<select class="hmui-input3 w200 ml50"  id="owner" name="owner_departments"></select>
<select class="hmui-input3 w100 ml50" id="state" name="state"><option value="2">状态</option><option value="1">正常</option><option value="0">冻结</option></select>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
<span class="fr">
 	<input type="button" class="hmui-btn" value="新增" id="btn_add">
 	<input type="button" class="hmui-btn" value="编辑" id="btn_edit">
 	<input type="button" class="hmui-btn" value="授权" id="btn_authorize">
	<input type="button" class="hmui-btn" value="重置密码" id="btn_resetpwd" >
	<input type="button" class="hmui-btn" value="激活" id="btn_init_user">
	<input type="button" class="hmui-btn" value="冻结/解冻" id="btn_statechange">
</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>所属单位</th>
		<th>姓名</th>
		<th>账号</th>
 		<th>状态</th>
		<th>入网日期 </th>
    	<th>性别</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                      
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var a=[['0','冻结'],['1','正常']];
var sex_jsarry=[['0','女'],['1','男']];

</script>           
<script type="text/javascript" src="../../../etc/js/layui/layui.js"></script>
<script type="text/javascript" src="js/accountmanagement_list.js"></script>