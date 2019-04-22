<?php include '../../../manage/include/page/top.php';?>            
<form name="myform" id="myform" method="post" class="alert_info f12"> 
<span style="display:none;">
<select  name="orgid" id="orgid">
	<option value="">机构</option>
	<?php // echo FimOrg::getInstance()->getMenuSelectOptionAtNews("")?>
	</select>
	<select  name="fimgroupid" id="fimgroupid">
	<option value="">岗位</option>
	
	</select>
	</span> 
<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="增加"  onclick="showAdd();"/>             
<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="编辑"  onclick="showEdit();"/>  
<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="修改密码"  onclick="showModifyPwd();"/>           
<input class="layui-btn layui-btn-normal layui-btn-small" type="button" value="删除"  onclick="showDel();"/>          
</form>
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
		<tr>                                                                                            
			<th width="30">序号</th>                                                                   
            <th width="15"><input type="checkbox" name="selectall" onclick="checkBoxAll('key','selectall');" /></th>
			<th>编号</th>
			<th>账号</th>
			<th>手机</th>
			<th>邮箱</th>
			<th>名称</th> 
			<th>注册时间</th>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
			
			<th>角色</th>                                                                                                                                                
		</tr>                                                                                                                                                                                                      
	    <tbody id="tbody_content"></tbody>                                                                
</table>  
<div id="pageNav"></div>                                                                               
<script type="text/javascript">
var group_jsArray=<?php echo(FimGroup::getInstance()->getFimGroupJsArray());?>;
var sf_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("SF"));?>;
var org_array=<?php echo(FimOrg::getInstance()->getTreeJsonData(0));?>;
</script>           
<script type="text/javascript" src="js/fimuser_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>