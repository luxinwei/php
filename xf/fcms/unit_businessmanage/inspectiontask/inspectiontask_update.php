
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
$patrolPoints=Fun::request("patrolPoints");
?>
 <div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
  <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>

	</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
  <tr>
    <th width="15%">选择公司</th>
    <td width="35%">
    <input  class="hmui-input w hand" id="executeDepId"  executeDepIdValue="" />
    <input  class=" " id="depId"  type="hidden" />
    </td>
	 <th width="15%" ><font class="cred">*</font>巡查类别</th>
	 <td width="35%"> 
	 	<select class="hmui-select w"  id="patrolTypeCode">
		 <option value="">请选择巡查类别</option>
		 <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("patrolTypeCode", "")?>
	    </select> 
	</td>
  </tr>
  <tr>
    <th>巡查任务名称</th>
    <td>
	 <input  class="hmui-input w" id="insname"/>
    </td>
    <th>巡查人员</th>
    <td><input  class="hmui-input w hand" id="patrolUser" patrolUserValue=""/></td>
  </tr>
  <tr>

    <th>偏差时间</th>
    <td>
    <select class="hmui-select w" id="deviationTime">
     <option value="">选择偏差时间</option>
		    	<?php for ($i=1;$i<3;$i++){?>
			  		<option value="<?php echo $i?>"><?php echo $i?>小时</option>
   				 <?php }?>   
    </select>
    <th>巡查点</th>
      <td ><input class="hmui-input w hand" id="btn_chose" /><input type="hidden" id="patrolPoints"   value="<?php echo $patrolPoints;?>"/></td>
  </tr>
<tr>
    <th>巡查时间点</th>
    <td colspan="3">
  			<?php for ($i=1;$i<25;$i++){?>
  					<span style="display: inline-block;width: 60px;line-height: 30px">
 			  		<input class=" " type="checkbox" name="strategy" value="<?php echo $i?>"/><?php echo $i?>点 
 			  		</span>
   				 <?php }?>          
 
    </tr>
    
</table> 
</div>
 
<?php include '../../../authen/include/page/bottom.php';?> 
<script>
    		
var id="<?php echo $id?>"; 
$("#deviationTime").change(function(){

	var	dtime = $(this).val();
	$("#firstchose").change(function(){
		var content=""
		var	firsttime = $(this).val();
		// $("#checkbox_content").empty().append(content);    
		
		 
			  
		});
})

</script>              
<script type="text/javascript" src="js/inspectiontask_update.js"></script>