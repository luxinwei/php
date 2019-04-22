
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
    <th width="15%"><font class="cred">*</font>建筑名称</th>
    <td width="35%"><input class="hmui-input w  hand" id="buildingId" buildIdValue="" readonly="readonly"/></td>
    <th  width="15%"></th>
   	<td width="35%"></td>     
    </tr>
	<tr>
  		<th  width="160px;"><font class="cred">*</font>安全出口位置</th>
   		<td><input  class="hmui-input w" id="position"  /></td>
  		<th  width="160px;"><font class="cred">*</font>安全出口形式</th>
    	<td><input  class="hmui-input w" id="modality"  /></td>
  	</tr>
 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/buildingemergencyexit_update.js"></script>