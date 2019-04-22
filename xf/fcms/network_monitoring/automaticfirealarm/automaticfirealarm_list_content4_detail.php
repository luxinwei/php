<?php include '../../../authen/include/page/top.php';?>
<?php 
$tId=Fun::request("tId");
$eId=Fun::request("eId");
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
     <tr>
    <th   width="160px;">屏蔽时间</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>所属建筑</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>所属部位</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>所属设施</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>所属部件</th>
    <td><span id=""></span></td>
  </tr>

</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var tId="<?php echo $tId?>";
var eId="<?php echo $eId?>";
</script>           
<script type="text/javascript" src="js/automaticfirealarm_list_content4_detail.js"></script>