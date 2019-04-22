
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
  	<tr>
    	<th width="15%"><font class="cred">*</font>监控点名称</th>
    	<td width="35%"><input class="hmui-input w"  id="cameraname"/></td>    
  		<th width="15%"><font class="cred">*</font>所属建筑</th>
        <td width="35%"><input class="hmui-input w " id="buildingId" buildIdValue="" value=""/></td>  
  	</tr>
	<tr>
  		<th ><font class="cred">*</font>主要部位</th>
   		<td><input class="hmui-input w" id="impPartId" impPartIdValue="" value=""/></td> 
  		<th ><font class="cred">*</font>所属设施</th>
    	<td><input class="hmui-input w" id="deviceId" deviceIdValue="" value=""/></td> 
  	</tr>
  	<tr>
  		<th ><font class="cred">*</font>所属楼层</th>
    	<td><input  class="hmui-input w" id="floor"/></td>
    	<th></th>
   		<td></td> 
  	</tr>
  	<tr>
  		<th ><font class="cred">*</font>摄像头序列号</th>
   		<td><input  class="hmui-input w" id="code"/></td>
  		<th ><font class="cred">*</font>摄像头验证码</th>
    	<td><input  class="hmui-input w"  id="authCode"/></td>
  	</tr>
  		<tr>
  		<th ><font class="cred">*</font>摄像头IP</th>
   		<td><input  class="hmui-input w" id="ip"/></td>
  		<th ><font class="cred">*</font>摄像头端口</th>
    	<td><input  class="hmui-input w"  id="port" /></td>
  	</tr>
  		<tr>
  		<th ><font class="cred">*</font>摄像头地址</th>
   		<td><input  class="hmui-input w" id="position" /></td>
  	</tr>
   		<tr>
  		<th ><font class="cred">*</font>楼层平面图</th>
		 <td>
			  	<input type="hidden" name="file_base64" id="file_base64">
			 	 <style>#myCanvas{width:454px;height:621px;border: 1px solid #c3c3c3;}</style>
				<script type="text/javascript" src="js/Canvas2Image.js"></script>
			  	 <img id="file_base64img" width="100" height="100"/>
			     <input type="file" name="file" onchange="imgPreview(this)" id="file"  />
			   </td>
			  </tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>              
<script type="text/javascript" src="js/cameramonitor_update.js"></script>