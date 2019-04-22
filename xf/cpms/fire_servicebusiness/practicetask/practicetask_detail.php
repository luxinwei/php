
<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
 
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
			<th width="15%">开始时间</th>
			<td width="35%"><span id="beginTime"></span></td>
			<th width="15%">结束时间</th>
			<td width="35%"><span id="endTime"></span></td>
		</tr>
		<tr>
			<th>下发单位</th>
			<td><span id="depId" depIdValue=""></span></td>
			<th >演练任务名称</th>
			<td ><span id="practicetaskname"></span> </td>
		</tr>
		<tr>
			<th  >演练状态</th>
			<td><span id="taskStateCode"></span></td>
			<th >演练要求</th>
			<td ><span id="practiceRequirements"></span> </td>
		</tr>
		<tr>
			 <th >是否超时</th>
			<td><span id="overtimeFlag"></span> </td>
			<th >演练结果</th>
			<td><span id="result"></span> </td>
		</tr>

		<tr>
			<th >演练资料</th>
			<td>
			<span id="btn_pic" class="hand">点击查看详情
			<input type="hidden" id="file">
			<input type="hidden" id="fileName"></span>
			</td>
 
			<th >演练任务内容</th>
			<td ><span id="practiceContent"></span></td>
		</tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
var overtimeFlag_jsarray=[['0','未超时'],['1','超时']];
var result_jsarray=[['0','已完成'],['1','未完成']];
</script>
<script
	type="text/javascript"
	src="js/practicetask_detail.js"
></script>