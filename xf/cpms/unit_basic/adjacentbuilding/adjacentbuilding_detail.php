
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
    	<th width="15%">毗邻建筑物名称</th>
    	<td width="35%"><span id="bname"></span></td>
    	<th width="15%">所属建筑物名称</th>
   		<td width="35%"><span id="buildingName"></span></td>    
  	</tr>
  	 <tr>
    	<th>方向</th>
    	<td><span id="buildingDrectionCode"></span></td>
 		<th>使用性质</th>
   		<td><span id="buildingUseKindCode"></span></td>
  	</tr>
	<tr>
  		
  		<th>结构类型</th>
    	<td><span id="buildingStructureCode"></span></td>
    	<th>建筑高度</th>
   		<td><span id="height"></span><span>（m）</span></td>
  	</tr>
  	<tr>
  		
  		<th>与本建筑物间距</th>
    	<td><span id="standoffDistance"></span><span>（m）</span></td>
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
<script type="text/javascript" src="js/adjacent_building_detail.js"></script>