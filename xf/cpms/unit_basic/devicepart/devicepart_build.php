
<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
	<span  class="fr">
		<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
  		<tr>
    	<th><font class="cred">*</font>设施名称</th>
    	<td>
	    	<select class="hmui-select w"  id="deviceId">
		    <option value="">请选择类别</option>
		    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("deviceType", "")?>
		    </select>   
     	</td>
    	 <th><font class="cred">*</font>所在楼层</th>
    	<td><input class="hmui-input w" id="floor"/></td>
  	</tr>
  	<tr>
  		<th ><font class="cred">*</font>所属建筑名称</th>
    	<td><input class="hmui-input w " id="buildingId" buildIdValue="" readonly="readonly"/></td>
  		<th ><font class="cred">*</font>所属通讯模组名称</th>
    	<td><input  class="hmui-input w" id="moduleName"/></td>
  	</tr>
	<tr>
  		<th ><font class="cred">*</font>部件类型</th>
   		<td><select  class="hmui-input w" id="typeName"></select></td>
  		<th ><font class="cred">*</font>部件名称</th>
    	<td><input  class="hmui-input w" id="name"/></td>
  	</tr>
  		<tr>
  		<th ><font class="cred">*</font>部件型号</th>
   		<td><input  class="hmui-input w" id="model"/></td>
  		<th ><font class="cred">*</font>部件区号</th>
    	<td><input  class="hmui-input w" id="areaNum"/></td>
  	</tr>
  		<tr>
  		<th ><font class="cred">*</font>部件回路号</th>
   		<td><input  class="hmui-input w" id="circuitNum"/></td>
  		<th ><font class="cred">*</font>部件位号</th>
    	<td><input  class="hmui-input w" id="bitNum"/></td>
  	</tr>
  		<tr>
  		<th ><font class="cred">*</font>安装位置</th>
   		<td><input  class="hmui-input w" id="position"/></td>
  		<th ><font class="cred">*</font>部件状态</th>
    	<td><input  class="hmui-input w" id="state"/></td>
  	</tr>
  	<tr>
  		<th>模板Id</th>
    	<td><input  class="hmui-input w" id="templateId"/></td>
  	</tr>
  	  	<tr>
    	<th><font class="cred">*</font>状态描述</th>
    	<td colspan="3"><textarea class="hmui-textarea w h100" id="description"></textarea></td>
  	</tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/devicepart_build.js"></script>