
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>

<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
  <div class="fr">
     <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
  </div>
  <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
  <tr>
    <th><font class="cred"></font>查岗发起人名称</th>
    <td><span id="user"></span></td>
    <th><font class="cred"></font>查岗结果</th>
    <td colspan="3"><span id="result"></span></td>
  </tr>
  <tr>
    <th  width="15%"><font class="cred"></font>查岗单位</th>
    <td  width="35%"><span id="depId"></span></td>
    <th  width="15%"><font class="cred"></font>被查单位</th>
    <td  width="35%"><span id="checkedDepId"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>发起时间</th>
    <td><span id="startTime"></span></td>
    <th><font class="cred"></font>结束时间</th>
    <td><span id="endTime"></span></td>
  </tr>
 
  <tr>
    <th><font class="cred"></font>视频截图</th>
    <td colspan="3"><div style="padding-top: 10px;padding-bottom: 10px"><img src="" id="file"></div></td>
  </tr>
  	
</table>
</div>

<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>

<script type="text/javascript">
var id="<?php echo $id?>";
var result_jsarry=[['0','不和格'],['1','合格']];
 </script>    
<script type="text/javascript" src="js/checkjobrecord_detail.js"></script>