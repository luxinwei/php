
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
    <th width="15%"><font class="cred">*</font>网格名称</th>
    <td width="35%"><input class="hmui-input w" id="name">
    <th width="15%"><font class="cred">*</font>所属区域</th>
     <td width="35%"><input class="hmui-input w hand" id="areaId" areaIdValue=""/> </td> 
</tr> 
<tr>
    <th><font class="cred">*</font>部门接口人姓名</th>
    <td><input class="hmui-input w" id="liaisonOfficer"/></td>  
    <th><font class="cred">*</font>部门接口人电话</th>
    <td><input class="hmui-input w" id="liaisonOfficerPhone"/></td>  
</tr> 
   <tr>
    <th><font class="cred">*</font>管辖区域</th>
    <td class="pr">
 	    <input class="hmui-input w" id="address" min ="1" max ="20" />
	    <input  type="button"  id="btn_map" max="20"/>
	    <input type="hidden" id="scopeCoordinates" min ="1" max ="100"/>
    </td>  
    <th><font class="cred">*</font>上级单位名称</th>
    <td><input class="hmui-input w" id="parentDepName"/></td>  
</tr> 
 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/gridunit_build.js"></script>