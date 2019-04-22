<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "联网","0"=> "断开"); //状态信息创建
?>
<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入单位名称" class="hmui-input3 w300"/>
<input type="button" value="搜索" class="hmui-btn " id="btn_search"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>单位名称</th>
		<th>单位类别</th>
		<th>所属区域</th>
		<th>总建筑面积（㎡）</th>
		<th>监管等级</th>
		<th>联网状态</th>
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
<script type="text/javascript" src="js/unit_list.js"></script>
