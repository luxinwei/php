<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "联网","0"=> "断开"); //状态信息创建
?>


<div class="hmui-shadow">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input"/><input type="button" value="搜索" class="hmui-btn"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>单位名称</th>
		<th>单位类别</th>
		<th>所属区域</th>

	</tr>
	<tbody id="tbody_content"></tbody>                                                                      
</table>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var orgTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("orgTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var supervisionLevelCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("supervisionLevelCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var onlineState_jsarray=[['0','联网'],['1','断开']];//状态信息设置
</script>           
<script type="text/javascript" src="js/select_unit_list.js"></script>