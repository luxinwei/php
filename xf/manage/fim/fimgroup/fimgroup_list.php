<?php include '../../../manage/include/page/top.php';?>
                      
<form name="myform" id="myform" method="post" class="alert_info f12">  
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="增加"  onclick="showAdd();"/>             
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="编辑"  onclick="showEdit();"/>            
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="删除"  onclick="showDel();"/>      
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="权限配置"  onclick="showMenuQx();"/>
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="新闻权限配置"  onclick="showNewsQx();"/>         
</form>
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
		<tr>                                                                                            
			<th width="30">序号</th>                                                                   
            <th width="30"><input type="checkbox" name="selectall" onclick="checkBoxAll('key','selectall');" /></th>
			<th>编号</th>  
			<th>角色名称</th>                                                                         
			<th>描述</th>                                                                                                                                               
			<th>有效标志</th>                                                                                                                                                  
	<tbody id="tbody_content"></tbody>                                                                
</table>                                                                                            
<script type="text/javascript">
var sf_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("SF"));?>;
</script>           
<script type="text/javascript" src="js/fimgroup_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>