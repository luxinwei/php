
<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
		<tr>
			<th width="15%"><font class="cred">*</font>巡查点名称</th>
			<td width="35%"><input class="hmui-input w" id="patrolname"/></td>
			<th width="15%"><font class="cred">*</font>巡查点位置</th>
			<td width="35%"><input class="hmui-input w" id="position"/></td>
		</tr>
		<tr>
			<th> 关联的设施</th>
			<td><input class="hmui-input w hand" id="deviceId"   deviceIdvalue=""    /></td>
			<th > 关联的重点部位</th>
			<td><input class="hmui-input w hand" id="importantPartId" importantPartIdvalue=""   readonly="readonly"/></td>
		</tr>
		<tr>
			<th> 区号</th>
			<td><input class="hmui-input w" id="areaNum"/></td>
			<th > 位号</th>
			<td><input class="hmui-input w" id="bitNum"/></td>
		</tr>
		<tr>
			<th><font class="cred">*</font>关联建筑</th>
			<td><input class="hmui-input w hand" id="buildingId" buildIdValue="" readonly="readonly"/></td>  
			<th><font class="cred">*</font>所在楼层</th>
			<td><input class="hmui-input w" id="floor" /></td>
		</tr>
		<tr>
			<th>RFID标签</th>
			<td><input class="hmui-input w" id="rfidCode" /></td>
			<th>巡查标准</th>
			<td ><input class="hmui-input w" id="btn_patrolpoint"/></td>
		</tr>

</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/patrolpoint_build.js"></script>