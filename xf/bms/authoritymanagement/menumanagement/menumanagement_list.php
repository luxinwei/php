<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow" style="background:#ffffff">
<form name="myform" class="alert_info" id="myform">
        <input  placeholder="请输入关键字" class="hmui-input3 w300" id="name" name="name"/><input type="button" value="搜索" class="hmui-btn ml5" id="btn_search"/>
       <span class="fr">
         <input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		</span>
		<div class="cb"></div>
    </form>
   
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
 
		<th>应用名称</th>
		<th>level</th>
		<th>创建日期</th>
		<th>APPCode</th>
		<th>查看</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                     
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="../../../etc/js/layui/layui.js"></script>
<script type="text/javascript" src="js/menumanagement_list.js"></script>