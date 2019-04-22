<?php include '../../../manage/include/page/top.php';?>
<?php FimOrg::getInstance()->updateMemberNum();?>
<form name="myform" id="myform" method="post" class="alert_info f12">
<select class="hmui-select"  name="type" id="type">
    <option value="">类型</option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGTYPE", $obj["TYPE"])?>
	</select>
<select class="hmui-select"  name="orgkind" id="orgkind">
	<option value="">类别</option>
	<?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("FIM_ORGKIND", $obj["ORGKIND"])?>
</select> 
组织名称：    <input name="title" class="hmui-input">
名次：    <input name="interalorder1" class="hmui-input" style="width: 50px;">- <input name="interalorder2" class="hmui-input"  style="width: 50px;">   
积分：    <input name="interal1" class="hmui-input"   style="width: 50px;">- <input name="interal2" class="hmui-input"   style="width: 50px;">
党员数量：    <input name="num1" class="hmui-input"   style="width: 50px;">- <input name="num2" class="hmui-input"   style="width: 50px;">
<input id="btn_find" type="button" value="查询" class="layui-btn layui-btn-normal layui-btn-small"> 
<input id="btn_xls" type="button" value="导出" class="layui-btn layui-btn-normal layui-btn-small"> 
<input id="btn_mapview" type="button" value="查看组织地图" class="layui-btn layui-btn-normal layui-btn-small"> 
<input id="btn_his" type="button" value="返回" class="layui-btn layui-btn-normal layui-btn-small"> 
</form>
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
		<tr>                                                                                                                                                             

			<th>编号</th>  
			<th>名称</th> 
			<th>党员数量</th>
			<th>类型</th>  
			<th>类别</th>  
			<th>名次</th>                                                                        
	        <th>积分</th> 
	        <th>经纬度</th>
	        <th>操作</th>                                                                                                                                 
	<tbody id="tbody_content"></tbody>                                                                
</table>   
	<div id="pageNav"></div>     
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" >
var type_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("FIM_ORGTYPE"));?>;
var org_kind_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("FIM_ORGKIND"));?>;
</script>
<script type="text/javascript" src="js/fimorg_gridlist.js"></script>