<?php include '../../../authen/include/page/top.php';?>
<?php 
$tId=Fun::request("tId");
$eId=Fun::request("eId");
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
     <tr>
    <th  width="160px;">报警时间</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>报警类型</th>
    <td><span id="type"></span></td>
  </tr>
  <tr>
    <th>所属建筑</th>
    <td><span id="buildName"></span></td>
  </tr>
  <tr>
    <th>所属部位</th>
    <td><span id="depName"></span></td>
  </tr>
  <tr>
    <th>所属设施</th>
    <td><span id="deviceName"></span></td>
  </tr>
  <tr>
    <th>报警内容</th>
    <td><span id="content"></span></td>
  </tr>
   <tr>
    <th>是否误报</th>
    <td><span id="error"></span></td>
  </tr>
  <tr>
    <th>当前状态</th>
    <td><span id="state"></span></td>
  </tr>
  <tr>
    <th>处理时间</th>
    <td><span id=""></span></td>
  </tr>
  <tr>
    <th>处理结果</th>
    <td><span id="result"></span></td>
  </tr>
</table>

</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>    
<script type="text/javascript">
var tId="<?php echo $tId?>";
var eId="<?php echo $eId?>";
</script> 
<script type="text/javascript" src="js/automaticfirealarm_list_content1_detail.js"></script>