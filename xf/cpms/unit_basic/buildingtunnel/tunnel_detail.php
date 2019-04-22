
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
    <td width="35%"> <span id="buildingName"></span></td> 
     <th width="15%">隧道位置</th>
    <td width="35%"> <span id="position"></span></td>   
  </tr>
<tr>
  	<th>隧道高度</th>
    <td> <span id="height"></span><span>（m，精确至小数点后两位）</span></td>
    <th>隧道长度</th>
    <td> <span id="length"></span><span>（m，精确至小数点后两位）</span></td>
  </tr>
</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>

<script type="text/javascript">
var id="<?php echo $id?>";
</script>          
<script type="text/javascript" src="js/tunnel_detail.js"></script>