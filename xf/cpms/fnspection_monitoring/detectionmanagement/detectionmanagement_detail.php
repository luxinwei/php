<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>
<blockquote class="hmui-nav hmui-shadow">
 

</blockquote>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">

   <tr>
    <th>下发单位</th>
    <td>
    <span id="depName"><span>（个）</span></span>
    </td>
    <th>执行单位</th>
    <td>
    <span id="executeDepName"><span>（个）</span></span>
    </td>
  </tr>
     <tr>
    <th>巡查点人员名称</th>
    <td>
    <span id="patrolUserName"><span>（个）</span></span>
    </td>
    <th>巡查任务名称</th>
    <td>
    <span id="taskName"></span>
    </td>
  </tr>


 <tr>
    <th width="15%">巡查任务开始时间</th>
    <td width="35%"><span id="beginTime"></span></td>
    <th width="15%">巡查任务结束时间</th>
    <td width="35%"><span id="endTime"></span></td>
  </tr>
   <tr>
    <th>偏差时间</th>
    <td>
    <span id="deviationTime"><span>（个）</span></span>
    </td>
  </tr>
  <tr>
    <th>巡查任务个数</th>
    <td>
    <span id="pointCount"><span>（个）</span></span>
    </td>
    <th>已巡查点个数</th>
    <td><span id="patrolledCount" ></span><span>（个）</span></td>
  </tr>
  <tr>
    <th>是否超期</th>
    <td><span id="overtimeFlag"></span></td>
    <th>入库时间</th>
    <td><span id="createTime"></span></td>
  </tr>
 
</table> 
</div>
<?php include '../../../authen/include/page/bottom.php';?> 
<script>
var id="<?php echo $id?>";  
var overtimeFlag_jsarry=[['0','未超时'],['1','超时']];
</script>
        
<script type="text/javascript" src="js/detectionmanagement_detail.js"></script>