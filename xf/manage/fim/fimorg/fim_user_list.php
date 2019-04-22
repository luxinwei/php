<?php include '../../../manage/include/page/top.php';?>
<?php 
$orgid=Fun::request("orgid");
$orgObj=FimGroup::getInstance()->getOne($orgid);
?>
                      
<form name="myform" id="myform" method="post" class="alert_info f12">  
<?php echo $orgObj["TITLE"]?>
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="增加"  onclick="showAdd();"/>             
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="编辑"  onclick="showEdit();"/>            
	<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="删除"  onclick="showDel();"/>        
</form>
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
		<tr>                                                                                                                                                             
            <th width="30"><input type="checkbox" name="selectall" onclick="checkBoxAll('key','selectall');" /></th>
			<th>编号</th>  
			<th>账号</th> 
			<th>姓名</th>                                                                         
	                                                                                                                                          
	<tbody id="tbody_content"></tbody>                                                                
</table>                                                                                            
<script type="text/javascript">
var orgid="<?php echo $orgid;?>";
var sf_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("SF"));?>;

</script>           
<script type="text/javascript" src="js/fimuser_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>