<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "联网","0"=> "断开"); //状态信息创建
?>
<div class="mt10 hmui-shadow">
<form class="alert_info">
<input  placeholder="单位名称" class="hmui-input3 w300"/><select class="hmui-input3 w100 ml50"><option>状态</option></select>
<input type="button" value="搜索" class="hmui-btn"/>
<span class="fr">
<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
<input type="button" value="导出" class="hmui-btn ml10" id="btn_export"/>
<input type="button" value="下载模板" class="hmui-btn ml10" id=""/>
 </span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>

		<th>中心名称</th>
		<th>所属区域</th>
 		<th>消防安全负责人姓名 </th>
		<th>消防安全负责人联系方式</th>
		<th>监管等级</th>
		<th>单位所属中心名称</th>
		<th>状态</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                      
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var orgTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("orgTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var supervisionLevelCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("supervisionLevelCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var onlineState_jsarray=[['0','联网'],['1','断开']];//状态信息设置
</script>           
<script type="text/javascript" src="js/commandcentre_list.js"></script>