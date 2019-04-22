
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
 
?>
<style>
ul li{float: left; margin-left: 15px;}
</style>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table">
<caption>负责人信息</caption>  
<tr>
    <th width="14%"></th>
    <th ><div class="tc">姓名</div></th>
    <th ><div class="tc">身份证号码</div></th>
    <th ><div class="tc">电话</div></th>
  </tr>
  <tr>
    <th>负责人</th>
    <td><span id="chargePersonName"></span></td>
    <td><span id="chargePersonId"></span></td>
    <td><span id="chargePersonTel"></span></td>
  </tr>
  </table>
<table class="hmui-table2" width="1200">
<caption>重点部位信息</caption>
  <tr>
    <th width="14%">重点部位名称</th>
    <td width="36%"><span id="name"></span></td>
    
  </tr>
 <tr>
 	<th width="14%">所属建筑</th>
    <td width="36%"><span id="buildingName"></span></td>
	<th width="15%">建筑面积</th>
	<td width="35%"><span id="overallFloorage"></span><span>（㎡）</span></td>
</tr>
<tr>
	<th >耐火等级</th>
	<td><span id="buildingResistFireCode"></span></td>
	  <th >所在位置</th>
    <td><span id="position"></span></td>
</tr>
   <tr>
    <th>所在层数</th>
    <td ><span id="floor"></span><span>（层）</span></td>
    <th>使用性质</th>
    <td><span id="buildingUseKindCode"></span></td>
  </tr>
<tr>
	<th>确立消防安全重点部位原因</th>
	<td><span id="establishReasonCode"></span></td>
	<th>防火标志设立情况</th>
	<td><span id="fireproofSignCode"></span></td>
</tr>
<tr>
	<th>危险源情况</th>
	<td><span id="dangerSourceCode"></span></td>
	<th>管理责任</th>
	<td><span id="dutyCode"></span></td>
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
 	<ul>
 	 		<li> <img alt="图片不存在" title="机防" src="img/240509723272531665.png" id="img_jf" class="hand"></li>
 		<li> <img alt="图片不存在" title="人防" src="img/478658509669161723.png" id="img_rf" class="hand"></li>
  	</ul>
 </td> 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingResistFireCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingResistFireCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var fireproofSignCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireproofSignCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var dangerSourceCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dangerSourceCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var establishReasonCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("establishReasonCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var dutyCode_jsarry=[["1","本单位管理"],["2","本单位使用"]];
var id="<?php echo $id?>";
</script>        
<script type="text/javascript" src="js/key_parts_detail.js"></script>