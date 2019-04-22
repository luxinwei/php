
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
<div id="detail"></div>
<table width="1200" class="hmui-form">
<tr>
   		<th width="15%"><font class="cred">*</font>方向</th>
    	<td width="35%">
    	   <select class="hmui-select w"  id="buildingDrectionCode">
   			 <option value="">请选择方向</option>
   			 <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingDrectionCode", "")?>
   		 </select>  
    	</td>
    	<th width="15%"><font class="cred">*</font>毗邻建筑物名称</th>
   		<td width="35%"><input  class="hmui-input w" id="bname" name="name" min = "1" max ="100"/></td>    
  	</tr>
  	<tr>
   		<th><font class="cred">*</font>所属建筑物名称</th>
   		<td><input class="hmui-input w hand" id="buildingId" buildIdValue="" readonly="readonly"/></td> 
   		<th><font class="cred">*</font>使用性质</th>
   		<td>
   		   <select class="hmui-select w"  id="buildingUseKindCode">
		    <option value="">请选择使用性质</option>
		    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingUseKindCode", "")?>
		    </select>  
   		</td>
  	</tr>
	<tr>
  	 
  		<th><font class="cred">*</font>结构类型</th>
    	<td>
    	   <select class="hmui-select w"  id="buildingStructureCode">
		    <option value="">请选择结构类型</option>
		    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingStructureCode", "")?>
		    </select>  
    	</td>
    	<th><font class="cred">*</font>建筑高度</th>
   		<td><input  class="hmui-input w"  id="height" name="height" placeholder="（m，精确至小数点后两位）"/></td>
  	</tr>
  	<tr>
  		<th><font class="cred">*</font>与本建筑物间距</th>
    	<td><input  class="hmui-input w" id="standoffDistance" name="standoffDistance" placeholder="（m，精确至小数点后两位）" /></td>
    	<th> </th>
   		<td></td>
  	</tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
var buildingDrectionCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingDrectionCode")?>;  
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  
var buildingStructureCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingStructureCode")?>;  
</script>         
<script type="text/javascript" src="js/adjacent_building_update.js"></script>