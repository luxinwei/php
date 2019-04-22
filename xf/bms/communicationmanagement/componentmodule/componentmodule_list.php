<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "正常","0"=> "暂停"); //状态信息创建
?>
<div class="mt10"></div>
<div class="hmui-shadow">

<form id="myform" class="alert_info" >
	<input  placeholder="中心名称" class="hmui-input3 w300" id="keyname" />
	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	<span class="fr">
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
		<input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>		
		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
		<input type="button" value="导入" class="hmui-btn ml10" id="btn_import"/>
	</span>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>名称</th>
		<th>型号</th>
		<th>类型</th>
		<th>所属公司 </th>
		<th class="tc" width=80>操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>   <!--   数据定位        -->
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var comMouldCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("comMouldCode")?>; 
var state_jsarray=[['0','暂停'],['1','正常']];//状态信息设置
</script>
<script type="text/javascript" src="js/componentmodule_list.js"></script>