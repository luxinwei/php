
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
    	<th width="15%">建筑名称</th>
    	<td width="35%"><span id="buildingName"></span></td> 
    	<th  width="15%">储存物名称</th>
    	<td  width="35%"><span id="name"></span></td>   
 
	<tr>
  		<th>储存物数量</th>
   		<td><span id="number"></span><span>（个）</span></td>
  		<th>储存物性质</th>
    	<td><span id="nature"></span></td>
  	</tr>
  		<tr>
  		<th>储存物形态</th>
   		<td><span id="shape"></span></td>
  		<th>储存物容积</th>
    	<td><span id="cubage"></span><span>（m³）</span></td>
  	</tr>
  		<tr>
  		<th>主要原料</th>
   		<td><span id="mainMaterial"></span></td>
  		<th>主要产品</th>
    	<td><span id="mainProduct"></span></td>
  	</tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>"; 
</script>         
<script type="text/javascript" src="js/storage_detail.js"></script>