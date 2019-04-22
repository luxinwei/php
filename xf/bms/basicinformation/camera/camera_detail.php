
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
    <th width="15%">品牌</th>
    <td width="35%"><span id="" >乔安</span></td>
    <th  width="15%">类型</th>
   	<td width="35%"><span id=""  >互联网摄像头</span></td>
    </tr>
	<tr>
  		<th>型号</th>
   		<td><span id="position"  >CS-C3W</span></td>
   		<th>验证码</th>
   		<td><span id="position"  >ERUVVO</span></td>
  	</tr>
  		<tr>
  		<th>序列号</th>
    	<td><span id="modality"  >100485879</span></td>
  	</tr>
</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/camera_detail.js"></script>