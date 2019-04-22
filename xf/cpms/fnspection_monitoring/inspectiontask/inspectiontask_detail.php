<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		 <input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
		
	</span>
	    <div class="cb"></div>
<div id="tbody_content" class="w800"></div>
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
    <tr>
    <th width="15%">下发单位</th>
    <td width="35%"><span id="depId"></span></td>
    <th width="15%">执行单位</th>
    <td width="35%"><span id="executeDepId"></span></td>
  </tr>
  <tr>
    <th>巡查任务名称</th>
    <td>
		<span id="insname"></span>
    </td>
    <th>巡查策略</th>
    <td><span id="strategy"></span></td>
  </tr>
  <tr>
    <th>巡查人员</th>
    <td><span id="patrolUser"></span></td>
    <th>偏差时间</th>
    <td><span id="deviationTime"></span><span>小时</span></td>
  </tr>
<tr>
    <th>巡查点</th>
    <td>
     <input type="button" value="查看巡查点" id="btn_look" class="hmui-btn" /> 
    </td>
    
        <th>巡查类别</th>
    <td><span id="patrolTypeCode"></span></td>
    </tr>
</table> 
</div>
 
 
<?php include '../../../authen/include/page/bottom.php';?> 
<script>
var id="<?php echo $id?>";  
var patrolTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("patrolTypeCode")?>;

</script>
        
<script type="text/javascript" src="js/inspectiontask_detail.js"></script>