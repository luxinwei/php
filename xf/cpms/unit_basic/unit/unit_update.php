  <?php include '../../../authen/include/page/top.php';?>
  
<div id="tbody_content" style="word-wrap:break-word ;"></div>
<div align="center" style="background:#FFFFFF;"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" class="hmui-btn" id="btn_save"/>
        <input type="button" value="取消" class="hmui-btn ml10" id="btn_history"/>
    </div>
<div class="cb"></div>
<table  width="1200" class="hmui-form">
<caption>负责人信息</caption>
  <tr>
    <th width="15%"></th>
    <th>姓名</th>
    <th>身份证号码</th>
    <th>电话</th>
  </tr>
  <tr>
    <th>消防安全责任人</th>
    <td><input class="hmui-input w" id="chargePersonName"/></td>
     <td><input class="hmui-input w" id="chargePersonId"/></td>
     <td><input class="hmui-input w" id="chargePersonTel"/></td>
  </tr>
  <tr>
    <th>消防安全管理人</th>
     <td><input class="hmui-input w" id="custodianName"/></td>
     <td><input class="hmui-input w" id="custodianId"/></td>
     <td><input class="hmui-input w" id="custodianTel"/></td>
  </tr>
  <tr>
    <th>专兼职消防管理人</th>
     <td><input class="hmui-input w" id="fireCustodianName"/></td>
     <td><input class="hmui-input w" id="fireCustodianId"/></td>
     <td><input class="hmui-input w" id="fireCustodianTel"/></td>
  </tr>
  <tr>
    <th>法人代表</th>
     <td><input class="hmui-input w" id="legalPersonName"/></td>
     <td><input class="hmui-input w" id="legalPersonId"/></td>
     <td><input class="hmui-input w" id="legalPersonTel"/></td>
  </tr>
</table>
<table  width="1200" class="hmui-form mt10">
<caption>单位信息</caption>
  <tr>
     <th width="15%;"><font class="cred">*</font>单位名称</th>
     <td width="35%;"><input class="hmui-input w" id="ownername" max=100/></td>
     <th width="15%;"><font class="cred">*</font>组织机构代码</th>
     <td width="35%;"><input class="hmui-input w" id="organizationCode" min="6"  max="20"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>单位类别</th>        
    <td>
    <select class="hmui-select w"  id="orgTypeCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("orgTypeCode", "")?>
    </select>
    </td>
    <th><font class="cred">*</font>成立时间</th>
    <td><input class="hmui-input w" id="foundingTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
   <tr>
     <th><font class="cred">*</font>详细位置</th>
     <td class="pr">
     	<input class="hmui-input w" id="address" min ="1" max ="20" disabled="disabled"/>
	    <input  type="button" id="btn_map" max="20" class="hand" />
	    <input type="hidden" id="position" min ="1" max ="100"/>
    </td>
	<th class="tr">所属区域</th>
	<td><input class="hmui-input w hand" id="areaId" areaIdValue=""/> </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>邮政编码</th>
    <td><input class="hmui-input w" id="postalCode" max="100"/></td>
    <th><font class="cred">*</font>职工人数</th>
    <td><input class="hmui-input w" id="employeeAmount" placeholder="（个）"/></td>
  </tr>
 
  <tr>
    <th><font class="cred">*</font>经济所有制</th>        
    <td>
	    <select class="hmui-select w"  id="economicSystemCode">
	    <option value="">请选择</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("economicSystemCode", "")?>
	    </select>
    </td>
    <th><font class="cred">*</font>固定资产</th>
    <td><input class="hmui-input w" id="fixedAssets" placeholder="（万元）"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>单位占地面积</th>
    <td><input class="hmui-input w" id="floorSpace" placeholder="（㎡）" /></td>
    <th><font class="cred">*</font>总建筑面积</th>
    <td><input class="hmui-input w" id="overallFloorage" placeholder="（㎡）" /></td>
  </tr>

  <tr> 
   	<th><font class="cred">*</font>单位介绍</th>
    <td><input class="hmui-input w" id="description" max="100"/></td>
    <th class="tr">监管等级</th>
    <td>
       <select class="hmui-select w"  id="supervisionLevelCode">
	    <option value="">请选择</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("supervisionLevelCode", "")?>
	    </select>   
    </td>
  </tr>
   <tr>
    <th><font class="cred">*</font>消防单位</th>
    <td><input class="hmui-input w hand" id="parentDep" parentDepValue=""/> </td>

    <th><font class="cred">*</font>所属监控中心</th>
   	<td><input class="hmui-input w hand" id="affiliatedCenter" affiliatedCenterValue="" /></td>
  </tr>
</table>
<table  width="1200" class="hmui-mp mt10">
<caption>平面图</caption>
    <tr>
	    <td width="150px;">单位总平面图</td>
	    <td>
		    <span id="btn_pic" class="hand">点击查看详情</span>
		    <input type="hidden" id="file">
		    <input type="hidden" id="file_base64">
			<input type="hidden" id="fileName">
			<input type="hidden" id="unitid">
	    </td>
    </tr>    
  </table>
</div>
<?php include '../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var orgTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("orgTypeCode")?>;
  var supervisionLevelCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("supervisionLevelCode")?>;
  var economicSystemCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("economicSystemCode")?>;
</script>           
<script type="text/javascript" src="js/unit_update.js"></script>