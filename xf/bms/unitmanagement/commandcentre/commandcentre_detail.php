  <?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的

$libsArray=array("1"=> "联网","0"=> "断开"); //状态信息创建
CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);
?>
<div align="center" style="background:#FFFFFF;"  class="p20 mt10 hmui-shadow">
<div id="detail"></div>
<input type="hidden" id="unitid" name="unitid" />
	<div class="fr">
		<div class="mr10 f16" style="display:inline-block;color:#535b6c"><span id="onlineState"></span></div>
		<input type="button" value="编辑" class="hmui-btn" id="btn_edit"/>
          <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
	
	<table width="1200" class="hmui-table">
		<caption>负责人信息</caption>   
		<tr>
		    <th width="15%"></th>
		    <th>姓名</th>
		    <th>身份证号码</th>
		    <th>电话</th>
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
		    <th   width="15%">单位名称</th>
		    <td   width="35%"><span id="ownername" ></span></td>
		    <th   width="15%">组织机构代码</th>
		    <td   width="35%" ><span id="organizationCode"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">单位类别</th>
		    <td><span id="orgTypeCode"></span></td>
		    <th class="tr">成立时间</th>
		    <td><span id="foundingTime"></span></td>
		  </tr>
		  <tr>
		    <th class="tr">详细位置</th>
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
			<input type="text" id="file">
			<input type="text" id="fileName"></span>
			</td>
		</tr>
	</table>
<div id="tbody_content"></div>
</div>
<?php include '../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的

var orgTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("orgTypeCode")?>;
var supervisionLevelCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("supervisionLevelCode")?>;
var economicSystemCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("economicSystemCode")?>;
var onlineState_jsarray=[['0','联网'],['1','断开']];//状态信息设置
</script>
<script type="text/javascript" src="js/commandcentre_detail.js"
></script>