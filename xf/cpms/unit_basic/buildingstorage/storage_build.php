
<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
		<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
  	<tr>
    	<th width="15%"><font class="cred">*</font>建筑名称</th>
        <td width="35%"><input class="hmui-input w " id="buildingId" buildIdValue="" readonly="readonly"/></td> 
       <th width="15%"><font class="cred">*</font>储储存物管理存物名称</th>
    	<td width="35%"><input class="hmui-input w  " id="name"/></td>    
  	</tr>
	<tr>
  		<th  ><font class="cred">*</font>储存物数量</th>
   		<td><input  class="hmui-input w" id="number" placeholder="（个）"/></td>
  		<th  ><font class="cred">*</font>储存物性质</th>
    	<td><input  class="hmui-input w" id="nature"/></td>
  	</tr>
  		<tr>
  		<th  ><font class="cred">*</font>储存物形态</th>
   		<td><input  class="hmui-input w" id="shape"/></td>
  		<th  ><font class="cred">*</font>储存物容积</th>
    	<td><input  class="hmui-input w" placeholder="m³" id="cubage"/></td>
  	</tr>
  		<tr>
  		<th>主要原料</th>
   		<td><input  class="hmui-input w" id="mainMaterial"/></td>
  		<th>主要产品</th>
    	<td><input  class="hmui-input w" id="mainProduct"/></td>
  	</tr>
  
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/storage_build.js"></script>