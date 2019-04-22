
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>

<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
<input type="button" value="编辑" id=btn_edit class="hmui-btn  ml10"/>
<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
</span>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
      <tr>
    <th width="15%">网格名称</th>
    <td width="35%"><span id="name"></span></td>  
    <th width="15%">所属区域</th>
    <td width="35%"><span id="areaName"></span></td>  
</tr> 
   <tr>
    <th>部门接口人姓名</th>
    <td><span id="liaisonOfficer"></span></td> 
    <th>部门接口人电话</th>
    <td><span id="liaisonOfficerPhone"></span></td> 
</tr> 
   <tr>
     <th>管辖区域</th>
    <td><span id="scopeCoordinates"></span></td>
    <th>上级单位名称</th>
    <td><span id="parentDepName"></span></td>    
</tr> 
  
</table>
</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/gridunit_detail.js"></script>