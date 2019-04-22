
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
	<span  class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
  	<tr>
    	<th>设施名称</th>
    	<td><span id="deviceName"></span></td>  
    	<th>所在楼层</th>
   		<td><span id="floor"></span></td>   
  	</tr>
  	<tr>
    	<th>所属建筑名称</th>
    	<td><span id="buildingName"></span></td> 
    	<th>所属通讯模组名称</th>
   		<td><span id="moduleName"></span></td>   
  	</tr>
	<tr>
  		<th width="15%">部件类型</th> 
   		<td width="35%"><span id="typeName"></span></td>
  		<th width="15%">部件名称</th>
    	<td width="35%"><span id="name"></span></td>
  	</tr>
  	<tr>
  		<th>部件型号</th>
   		<td><span id="model"></span></td>
  		<th>部件区号</th>
    	<td><span id="areaNum"></span></td>
  	</tr>
  	<tr>
  		<th>部件回路号</th>
   		<td><span id="circuitNum"></span></td>
  		<th>部件位号</th>
    	<td><span id="bitNum"></span></td>
  	</tr>
  		<tr>
  		<th>安装位置</th>
   		<td><span id="position"></span></td>
  		<th>部件状态</th>
    	<td><span id="state"></span></td>
  	</tr>
  	<tr>
  		<th>模板Id</th>
   		<td><span id="templateId"></span></td>
   		<th >状态描述</th>
    	<td><span id="description"></span></td>   
  	</tr>
 	   
</table>
</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>"
	var result_jsarray=[['01','正常'],['10','故障'],["20","报警"],["99","其他"]];

</script>           
<script type="text/javascript" src="js/devicepart_detail.js"></script>