<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimCodelibrary.class.php';?>
<?php include '../../../com/core/fim/FimCodecatalog.class.php';?>
<?php
	$codeno=Fun::request("codeno");
	$codename=FimCodecatalog::getInstance()->getCatalogTitle($codeno);
	
?>
	<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
	<caption class="alert_info f12">[<?php echo $codename;?>]</caption>
		<tr>                                                                                            
                                                                
          <th width="30" class="tc"><input type="checkbox" name="selectall" onclick="checkBoxAll('key','selectall');" /></th>                                                                                                                                               
			<th>编码</th>                                                                          
			<th>名称</th>                                                                                                                                                  
			<th>备注</th>                                                                          
	<tbody id="tbody_content"></tbody>                                                                
	</table>                                                                                            
	<form name="myform" id="myform" method="post" style="margin:2px">                          
		<table width="100%"  border="0" cellpadding="2" cellspacing="0">
		<tr>
		<td>
		
		<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="增加"  onclick="showAdd();"/>             
		<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="编辑"  onclick="showEdit();"/>            
		<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="删除"  onclick="showDel();"/>        
		<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="排序"  onclick="showOrder();"/>     
		</td>
		</tr>
		</table>
	</form>          

<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript">
var codeno="<?php echo $codeno ?>";
</script>
<script type="text/javascript" src="js/fimcodelibrary_list.js"></script>