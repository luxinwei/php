<?php include '../../../authen/include/page/top.php';?>

<?php 
$id=Fun::request("id");

$libsArray=array("1"=> "联网","0"=> "断开"); //状态信息创建
CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);
?>
<div align="center" style="background:#FFFFFF;min-height:725px"  class="p20 mt10 hmui-shadow">
<div class="fr">
		<font>联网状态：<span id="onlineState"></font>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
 	</span>
</div>
	<div class="cb"></div>

<div id="tbody_content"></div>
<table width="1200" class="hmui-table">
	<caption>负责人信息</caption>   
		<tr>
		    <th width="150"></th>
		    <th><div class="tl">姓名</div></th>
		    <th><div class="tl">身份证号码</div></th>
		    <th><div class="tl">电话</div></th>
		  </tr>
		  <tr>
		    <th>消防安全责任人</th>
		    <td><span id="chargePersonName"></span></td>
		    <td><span id="chargePersonId"></span></td>
		    <td><span id="chargePersonTel"></span></td>
		  </tr>
		  <tr>
		    <th>消防安全管理人</th>
		    <td><span id="custodianName"></span></td>
		    <td><span id="custodianId"></span></td>
		    <td><span id="custodianTel"></span></td>
		  </tr>
		  <tr>
		    <th>专兼职消防管理人</th>
		    <td><span id="fireCustodianName"></span></td>
		    <td><span id="fireCustodianId"></span></td>
		    <td><span id="fireCustodianTel"></span></td>
		  </tr>
		  <tr>
		    <th>法人代表</th>
		    <td><span id="legalPersonName"></span></td>
		    <td><span id="legalPersonId"></span></td>
		    <td><span id="legalPersonTel"></span></td>
		  </tr>
	</table>
	<table width="1200" class="hmui-table2">
		<caption>单位信息</caption>
		<tr>
		    <th class="tr" width="15px;">单位名称</th>
		    <td width="200px"><span id="ownername" ></span></td>
		    <th class="tr"  width="15px;">组织机构代码</th>
		    <td  width="200px"><span id="organizationCode"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">单位类别</th>
		    <td><span id="orgTypeCode"></span></td>
		    <th class="tr">成立时间</th>
		    <td><span id="foundingTime"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">单位所在地图位置</th>
		    <td><span id="address"></span></td>
		    <th class="tr">所属区域</th>
		    <td><span id="areaId"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">邮政编码</th>
		    <td><span id="postalCode"></span></td>
		    <th class="tr">职工人数</th>
		    <td><span id="employeeAmount"></span><span>（个）</span></td>
		  </tr>
		  <tr>
		    <th class="tr">经济所有制</th>
		    <td><span id="economicSystemCode"></span></td>
		    <th class="tr">固定资产</th>
		    <td><span id="fixedAssets"></span><span>（万元）</span></td>
		  </tr>
		  <tr>
		    <th class="tr">单位占地面积</th>
		    <td><span id="floorSpace"></span><span>（㎡）</span></td>
		    <th class="tr">总建筑面积</th>
		    <td><span id="overallFloorage"></span><span>(㎡)</span></td>
		  </tr>
		  <tr>
			<th class="tr">单位介绍</th>
		    <td><span id="description"></span></td>
		    <th class="tr">监管等级</th>
		    <td><span id="supervisionLevelCode"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">消防单位</th>
		    <td><span id="parentDep"></span></td>
		    <th class="tr">所属监控中心</th>
		    <td><span id="affiliatedCenter"></span></td>
		  </tr>
	</table>

	<table  width="1200" class="hmui-mp">
		<caption>平面图</caption>
		<tr>
			<td width="150px;">单位总平面图</td>
			
			<td>
			<span id="btn_pic" class="hand">点击查看详情
			<input type="hidden" id="file">
			<input type="hidden" id="fileName"></span>
			</td>
		</tr>
	</table>


</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var orgTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("orgTypeCode")?>;
var supervisionLevelCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("supervisionLevelCode")?>;
var onlineState_jsarray=[['0','联网'],['1','断开']];//状态信息设置
var economicSystemCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("economicSystemCode")?>;

</script>           
<script type="text/javascript" src="js/unit_detail.js"></script>