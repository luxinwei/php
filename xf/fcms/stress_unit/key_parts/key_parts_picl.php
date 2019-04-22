<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav">
	 
	<span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
</blockquote>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>设施名称</th>
		<th>设施部位</th>
		<th>设施系统形式</th>
		<th>投入使用时间</th>
		<th>设施服务状态</th>
		<th>设施状态</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<tbody id=""></tbody>                                                                      
</table>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var serviceStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("serviceStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var runStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("runStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
</script>           
<script type="text/javascript" src="js/key_parts_picl.js"></script>