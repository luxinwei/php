<?php include '../../../manage/include/page/top.php';?>
<form name="myform" id="myform" method="post" class="alert_info f12">                         
参数代码：<input name="paracode">
参数内容：<input name="paracontent">
描述：<input name="description">
<input type="button" value="查询" class="layui-btn layui-btn-normal layui-btn-small" onclick="javascript:search();">         
<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="编辑"  onclick="showEdit();"/>

</form>
	<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
		<tr>                                                                                            
			<th width="30">序号</th>                                                                   
          <th width="30"><input type="checkbox" name="selectall" onclick="checkBoxAll('key','selectall');" /></th>
			<th>参数代码</th>                                                                          
			<th>参数内容</th>                                                                          
			<th>描述</th>                                                                                                                                                   
	<tbody id="tbody_content"></tbody>                                                                
	</table>                                                                                            
	<div id="pageNav"></div>           
<script type="text/javascript" src="js/fimpara_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>