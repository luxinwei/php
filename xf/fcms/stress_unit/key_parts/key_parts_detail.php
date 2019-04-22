
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<div align="center" style="background:#FFFFFF;min-height:725px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
         <font>联网状态：
        <span id="onlineState"></span></font>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>

    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<style>
ul li{float: left; margin-left: 15px;}
</style>
<table width="1200" class="hmui-table2">
<tr>
    <th></th>
    <th>姓名</th>
    <th>身份证号码</th>
    <th>电话</th>
  </tr>
  <tr>
    <th width="14%">负责人</th>
    <td><span id="chargePersonName"></span></td>
    <td><span id="chargePersonId"></span></td>
    <td><span id="chargePersonTel"></span></td>
  </tr>
</table>
    <table width="1200" class="hmui-table2">
   <tr>
    <th width="14%"><font class="cred"></font>重点部位名称</th>
    <td width="36%"><span id="name"></span></td>
    <th width="15%"><font class="cred"></font>所属建筑</th>
    <td width="35%"><span id="buildingName"></span></td>
  </tr>
<tr>
    <th><font class="cred"></font>建筑面积</th>
    <td><span id="overallFloorage"></span></td>
	<th >耐火等级</th>
	<td><span id="buildingResistFireCode"></span></td>
 
</tr>
    <tr>
    <th ><font class="cred"></font>所在位置</th>
    <td  ><span id="position"></span></td>
    <th><font class="cred"></font>所在层数</th>
    <td ><span id="floor"></span></td>
  </tr>
<tr>
    <th><font class="cred"></font>使用性质</th>
    <td><span id="buildingUseKindCode"></span></td>
	<th >确立消防安全重点部位原因</th>
	<td><span id="establishReasonCode"></span></td>
 
</tr>
 
  <tr>
	<th >防火标志设立情况</th>
	<td><span id="fireproofSignCode"></span></td>
	<th >危险源情况</th>
	<td><span id="dangerSourceCode"></span></td>
 
</tr>

  <tr>
	<th>消防设施情况</th>
 <td >
 	<ul>
 		<li><img alt="图片不存在" title="消防电话" src="img/icon_0000.png"></li>
 		<li><img alt="图片不存在" title="电梯管理" src="img/icon_0001.png"></li>
 		<li><img alt="图片不存在" title="配电系统" src="img/icon_0002.png"></li>
 		<li><img alt="图片不存在" title="应急照明" src="img/icon_0003.png"></li>
 		<li><img alt="图片不存在" title="防火门帘" src="img/icon_0004.png"></li>
 		<li><img alt="图片不存在" title="防烟排烟" src="img/icon_0005.png"></li>
 		<li><img alt="图片不存在" title="消防栓灭火" src="img/icon_0006.png"></li>
 		<li><img alt="图片不存在" title="消防给水系统" src="img/icon_0007.png"></li>
 		<li><img alt="图片不存在" title="火灾自动报警" src="img/icon_0008.png"></li>
 		<li><img alt="图片不存在" title="自动喷水" src="img/icon_0009.png"></li>
 		<li><img alt="图片不存在" title="广播" src="img/icon_0010.png"></li>
 		<li><img alt="图片不存在" title="用电监测" src="img/icon_0011.png"></li>
 		<li><img alt="图片不存在" title="灭火器" src="img/icon_0012.png"></li>
  	</ul> 
 </td> 
<th>消防安全管理措施</th>
 <td>
 	<!-- <ul>
 		<li><a href="../fire_protectionfacilities/fire_protectionfacilities_list.php"><img alt="图片不存在" title="机防" src="img/240509723272531665.png"></a></li>
 		<li><a href="../../unit_businessmanage/patroltaskmanagement/patroltaskmanagement_list.php"><img alt="图片不存在" title="人防" src="img/478658509669161723.png"></a></li>
 	</ul> -->
 	 <ul>
 		<li> <img alt="图片不存在" title="机防" src="img/240509723272531665.png" id="img_jf"></li>
 		<li> <img alt="图片不存在" title="人防" src="img/478658509669161723.png" id="img_rf"></li>
 	</ul> 
 </td> 
</tr>
</table> 
</div>
 <div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingResistFireCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingResistFireCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var fireproofSignCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireproofSignCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var dangerSourceCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dangerSourceCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var establishReasonCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("establishReasonCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var id="<?php echo $id?>";
</script>        
<script type="text/javascript" src="js/key_parts_detail.js"></script>