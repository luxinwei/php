
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
		<tr>
			<th width="15%">建筑名称</th>
			<td colspan="3"><span id="buildingName"></span></td>
		</tr>
		<tr>
			<th width="15%">消防电梯位置</th>
			<td width="35%" ><span id="position" name="position"></span></td>
			<th width="15%" >消防电梯容纳重量</th>
			<td width="35%"><span id="holdWeight" name="holdWeight"></span><span>（kg）</span></td>
		</tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>  
<script type="text/javascript" src="js/buildingfireelevator_detail.js"></script>