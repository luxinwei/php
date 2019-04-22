
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="反馈" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">

		<tr>
			<th width="15%"><font class="cred">*</font>培训课题</th>
			<td width="35%"><span id="trainingTitle"></span></td>
			<th width="15%"><font class="cred">*</font>培训内容</th>
			<td width="35%"><sapn id="trainingContent"></sapn></td>
		</tr>
		<tr>
			<th ><font class="cred">*</font>开始时间</th>
			<td><span id="beginTime"></span></td>
			<th ><font class="cred">*</font>结束时间</th>
			<td><span id="endTime"></span></td>
		</tr>

		<tr>
			<th ><font class="cred">*</font>合格率</th>
			<td><span id="percentRate"></span></td>
			<th ><font class="cred">*</font>参加率</th>
			<td><span id="joiningRate"></span></td>
		</tr>
		<tr>
			<th ><font class="cred">*</font>培训状态</th>
			<td><span id="taskStateCode"></span></td>
			<th ><font class="cred">*</font>培训是否超时</th>
			<td><span id="overtimeFlag"></span></td>
		</tr>
		<tr>
		<th><font class="cred">*</font>培训照片</th>
			<td colspan="3"><img alt="" src=""></td>
		</tr>
		
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
var overtimeFlag_jsarray=[['0','未超时'],['1','超时']];
</script>
<script
	type="text/javascript"
	src="js/trainingduty_detail.js"
></script>