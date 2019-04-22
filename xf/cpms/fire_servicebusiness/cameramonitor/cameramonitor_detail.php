
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
  	<tr>
    	<th width="15%">监控点名称</th>
    	<td width="35%"><span id="cameraname"></span></td>  
    	<th  width="15%">主要部位</th>
   		<td width="35%"><span id="impPartId"></span></td>  
  	</tr>
	<tr>
	<th >所属建筑</th>
   		<td ><span id="buildingId"></span></td> 
  		<th >所属设施</th>
    	<td><span id="deviceId"></span></td>
  	</tr>
  	<tr>
  		<th > 所属楼层</th>
    	<td> <span id="floor"></span></td>
  	</tr>
  	<tr>
  		<th >摄像头序列号</th>
   		<td><span id="code"></span></td>
  		<th >摄像头验证码</th>
    	<td><span id="authCode"></span></td>
  	</tr>
  	<tr>
  		<th >摄像头IP</th>
   		<td><span id="ip"></span></td>
  		<th >摄像头端口</th>
    	<td><span id="port"></span></td>
  	</tr>
  	<tr>
  		<th>摄像头地址</th>
   		<td><span id="position"></span></td>
  	</tr>
  		<tr>
  		<th >楼层平面图</th>
   			<td>
			<span id="btn_pic" class="hand">点击查看详情
			<input type="hidden" id="file" >
			<input type="hidden" id="fileName" value="测试"></span>
			</td>
			<th>查岗</th>
			<td>图标</td>
  	</tr>

</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";

</script>        
<script type="text/javascript" src="js/cameramonitor_detail.js"></script>