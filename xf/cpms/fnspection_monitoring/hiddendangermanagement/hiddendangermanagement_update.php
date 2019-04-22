
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id"); 
$libsArray=array("0"=> "未处理","1"=> "处理中","2"=>"已处理");  
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
  <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
  </div>
  <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
  <tr> 
     <th width="15%">部门名称</th>
     <td width="35%"><input class="hmui-input w" id="depId" depIdValue=""/></td>
     <th width="15%">巡查点名称</th>
     <td width="35%"><input class="hmui-input w" id="patrolPointId" patrolPointIdValue=""/></td>
  </tr>
  <tr>
     <th>发现时间</th>
     <td><input class="hmui-input w" id="discoveryTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
     <th>治理完成时间</th>
     <td><input class="hmui-input w" id="finishTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
  <tr>
    <th>治理人姓名</th>
    <td><input class="hmui-input w" id="processor"/></td>
    <th>消防安全责任人</th>
    <td><input class="hmui-input w" id="custodianName"/></td>
  </tr>
    <tr>
    <th>治理情况</th>
    <td><select class="hmui-select w" id="state">
     <option value="">请选择情况</option>
      <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
    
    </select></td>
     <th>隐患内容</th>
    <td><input class="hmui-input w" id="content"/></td>
  </tr>
  
</table> 
</div>

</div>
<script type="text/javascript">
var id="<?php echo $id?>";
 
</script>             
<script type="text/javascript" src="js/hiddendangermanagement_update.js"></script>