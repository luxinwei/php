<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
         <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table">
  <tr>
    <th width="15%">设施名称</th>
    <td width="35%"><span id="fightingname"></span></td>
    <th  width="15%">所属建筑物</th>
    <td width="35%;"><span id="buildingId"></span></td>
  </tr>
  <tr>
    <th>所属重点部位</th>
    <td><span id="impPartId"></span></td>
    <th>设置位置</th>
    <td ><span id="position"></span></td>    
  </tr>
    <tr>
    <th>设施系统形式</th>
    <td ><span id="systemForm"></span></td>
     <th>设施型号</th>
    <td><span id="model"></span></td>
  </tr>
  <tr>
    <th>区号</th>
    <td><span id="areaNum"></span></td>
    <th>位号</th>
    <td><span id="bitNum"></span></td>
  </tr>
    <tr>
    <th>楼层号</th>
    <td><span id="floor"></span></td>
    <th>投入使用时间</th>
    <td ><span id="serviceTime"></span></td>
  </tr>
  <tr id="lieb">
  	<th>设施系统类型</th>
  	<td><span id="deviceType"></span></td>
  </tr>
  
 </table>
 
<!-- ============================================ -->
<table width="1200" class="hmui-form" id="systemForm_display">
 <tbody width="1200">
	<tr>
	<th width="18%"><span id="imgName"></span><span>平面图</span></th>
    <td colspan="3" width="82%">
 	    <div style="width: 34%;height:150px;border: 1px solid #8a8e98;padding:20px ">
 	     	<img src="img/1b.jpg" id="btn_addImg" style="width: 100%;height: 100%;">
 	     	<input type="hidden" id="file">
 	     	<input type="hidden" id="filebase64">
 	     	<input type="hidden" id="iconPosition">
 	     	<input type="hidden" id="fileName">
 	    </div>
    </td>
	</tr>	
</tbody>
<!-- ============================================ -->
 
 <table width="1200" class="hmui-table2">   
 <tr>
    <th >设施服务状态</th>
    <td ><span id="serviceStateCode"></span></td>
    <th>状态描述</th>
    <td ><span id=stateDescription></span></td>
</tr>
<tr>
    <th width="15%">生产单位</th>
    <td width="35%"><span id="productName"></span></td>
    <th width="15%">生产单位电话</th>
    <td width="35%"><span id="productTel"></span></td>
 </tr>
 <tr>
    <th>维修保养单位</th>
    <td><span id="maintenanceName"></span></td>
    <th>维修保养电话</th>
    <td><span id="maintenanceTel"></span></td>
 </tr>
 <tr>
    <th>设施状态</th>
    <td><span id=runStateCode></span></td>
    <th>状态变化时间</th>
    <td><span id=stateChangeTime></span></td>
 </tr>
  <tr>
    <th>绑定摄像头编号</th>
    <td><span id="cameraNum"></span></td>
    <th>摄像头拍摄位置</th>
    <td><span id="shootingAngle"></span> </td>
 </tr>  
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>"; 
var runStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("runStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var deviceTypeCode_jsarray=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("deviceType")?>;
var systemForm_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("systemForm")?>;
var serviceStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("serviceStateCode")?>;
 

</script>         
<script type="text/javascript" src="js/fire_protectionfacilities_detail.js"></script>
<script type="text/javascript" src="js/detail.js"></script>