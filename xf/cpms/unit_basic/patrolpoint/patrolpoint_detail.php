
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
  		<th width="15%">巡查点名称</th>
   		<td width="35%"><span id="patrolname"></span></td>
  		<th width="15%">巡查点位置</th>
    	<td width="35%"><span id="position"></span></td>
  	</tr>
	<tr>
  		<th  >所属建筑</th>
   		<td  ><span id="buildingId"></span></td>
  		<th >关联重点部位</th>
    	<td ><span id="importantPartId"></span></td>
  	</tr>
  		<tr>
  		<th>关联的设施</th>
   		<td><span id="deviceId"></span></td>
  		<th>RFID标签</th>
    	<td><span id="rfidCode"></span></td>
  	</tr>

  		<tr>
  		<th>区号</th>
   		<td><span id="areaNum"></span></td>
  		<th>位号</th>
    	<td><span id="bitNum"></span></td>
  	</tr>
	<tr>
			<th>所在楼层</th>
			<td><span id="floor"></span><span>（层）</span></td>
  	 	<th>巡查标准</th>
    	<td><span id="standardIds"></span></td>
    </tr>

</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/patrolpoint_detail.js"></script>