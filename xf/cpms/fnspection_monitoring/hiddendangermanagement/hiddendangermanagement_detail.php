<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
  <div class="fr">
    <input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
    <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
  </div>
  <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
  <tr>
     <th width="15%">部门名称</th>
     <td width="35%"><span id="depName"></span></td>
     <th width="15%">巡查点名称</th>
     <td width="35%"><span id="patrolPointName"></span></td>
  </tr>
    <tr>
    <th>发现时间</th>
    <td><span id="discoveryTime"></span></td>
     <th>治理完成时间</th>
    <td><span id="finishTime"></span></td>
  </tr>
    <tr>
    <th>治理人姓名</th>
    <td><span id="processor"></span></td>
     <th>消防安全责任人</th>
    <td><span id="custodianName"></span></td>
  </tr>
    <tr>
    <th>治理情况</th>
    <td><span id="state"></span></td>
     <th>隐患内容</th>
    <td><span id="content"></span></td>
  </tr>
  
</table>

</div>
<script type="text/javascript">
var id="<?php echo $id?>";
 var result_jsarray=[['0','未处理'],['1','处理中'],["2","已处理"]];

</script>   
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/hiddendangermanagement_detail.js"></script>