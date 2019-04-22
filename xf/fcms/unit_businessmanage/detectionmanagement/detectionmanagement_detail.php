<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
 		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
		
	</span>
	    <div class="cb"></div>
<div id="tbody_content" class="w800"></div>
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
    <tr>
    <th width="15%">发起单位</th>
    <td width="35%"><span id="depId"></span></td>
    <th width="15%">执行单位</th>
    <td width="35%"><span id="executeDepId"></span></td>
  </tr>
  <tr>
    <th>巡查任务</th>
    <td>
    <span id="patrolledCount"></span>
    </td>
    <th>巡查类别</th>
    <td><span id="patrolTypeCode"></span></td>
  </tr>
  <tr>
    <th>巡查点</th>
    <td><span id="pointCount"></span></td>
    <th>巡查部位</th>
    <td><span id="director"></span></td>
  </tr>
<tr>
    <th>巡查设施</th>
    <td ><span id="result"></span></td>
    <th>巡查人员</th>
    <td ><span id="patrolUserName"></span></td>
  </tr>
  <tr>
    <th>巡查开始时间</th>
    <td ><span id="beginTime"></span></td>
    <th>巡查结束时间</th>
    <td ><span id="endTime"></span></td>
  </tr>
  <tr>
    <th>巡查进度</th>
    <td ><span id="result"></span></td>
    <th>是否超时</th>
    <td ><span id="deviationTime"></span></td>
  </tr>
  <tr>
    <th>巡查要求</th>
    <td ><span id="result"></span></td>
  </tr>
</table> 
</div>
 
 
<?php include '../../../authen/include/page/bottom.php';?> 
<script>
var id="<?php echo $id?>";  
var result_jsarray=[['0','超时'],['1','未超时']];
</script>
        
<script type="text/javascript" src="js/detectionmanagement_detail.js"></script>