
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

<table class="hmui-table2" width="1200">
  <tr>
    <th width="15%">建筑名称</th>
    <td width="35%"><span id="buildingName"></span></td>
 
</tr> 
<tr>
  	<th  width="160px;">避难层位置</th>
    <td><span id="position"></span></td>
    <th  width="160px;">避难层面积</th>
    <td><span id="acreage"></span><span>（㎡）</span></td>
</tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/refugestorey_detail.js"></script>