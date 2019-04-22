<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "正常","0"=> "暂停"); //状态信息创建
?>
<div class="mt10"></div>
<div class="hmui-shadow">

<form id="myform" class="alert_info" >
	<input  placeholder="中心名称" class="hmui-input3 w300" id="name" name="name"/>
	<select class="hmui-input3 w200 ml50" id="state" name="state">
	<option value="">请选择</option>
		<?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
	</select>
	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
		
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
		<input type="button" value="导出" class="hmui-btn ml10" id="btn_xls"/>
		<input type="button" value="下载模板" class="hmui-btn ml10" id="btn_build"/>
	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>中心名称</th>
		<th>所属区域</th>
		<th>联系电话</th>
		<th>负责人姓名 </th>
		<th>负责人联系方式</th>
		<th>中心级别</th>
		<th>状态</th>
		<th class="tc" width=80>操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>   <!--   数据定位        -->
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var monitorCenterRankCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("monitorCenterRankCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称

var state_jsarray=[['0','暂停'],['1','正常']];//状态信息设置
</script>
<script type="text/javascript" src="js/monitorcenter_list.js"></script>