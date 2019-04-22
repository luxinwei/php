<?php include '../../../authen/include/page/top.php';?>
<?php 
$tId=Fun::request("tId");
$eId=Fun::request("eId");
$id=Fun::request("id");
 $errArray=array("1"=> "误报","2"=> "有效","9"=> "其他");
$stateArray=array("0"=> "未处理","1"=> "处理中","2"=> "已处理","3"=> "已报修");
?>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
<span class="fr">
 		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
</span> 
    <div class="cb"></div>
<table width="600" class="hmui-form">
     <tr>
    <th  width="160px;">报警时间</th>
    <td width="300px;"><input  class="hmui-input w" id="ctime" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>报警类型</th>
    <td><input  class="hmui-input w" id="type" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>所属建筑</th>
    <td><input  class="hmui-input w" id="buildName" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>所属部件</th>
    <td><input  class="hmui-input w" id="partName" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>所属设施</th>
    <td><input  class="hmui-input w" id="deviceName" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>报警内容</th>
    <td><input  class="hmui-input w" id="content" readonly="readonly"/></td>
  </tr>
   <tr>
    <th>处理时间</th>
    <td><input  class="hmui-input w" id="rtime" readonly="readonly"/></td>
  </tr>
   <tr>
    <th>是否误报</th>
    <td> 
    <select class="hmui-select w200" id="error">
     <option value="">请选择</option>
      <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$errArray);?>
    </select>
    </td>
  </tr>
  <tr>
    <th>当前状态</th>
    <td>
    <select class="hmui-select w200" id="state">
     <option value="">请选择</option>
      <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$stateArray);?>
    </select>
    </td>
  </tr>
 
  <tr>
    <th>处理结果</th>
    <td><input  class="hmui-input w" id="result" readonly="readonly"/></td>
  </tr>
</table>

</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>    
<script type="text/javascript">
var tId="<?php echo $tId?>";
var eId="<?php echo $eId?>";
var id="<?php echo $id?>";
  var state_jsarray=[['0','未处理'],['1','处理中'],['2','已处理'],['3','已报修']];
 var error_jsarray=[['1','误报'],['2','有效'],['9','其他']];
</script> 
<script type="text/javascript" src="js/automaticfirealarm_list_content1_detail.js"></script>