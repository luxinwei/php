<?php include '../../../authen/include/page/top.php';?>

<div align="center" style="background:#FFFFFF;min-height:750px" class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
<div class="cb"></div>
<div id="tbody_content"></div>
<form id="dataform"  name="dataform">
<table width="1200" class="hmui-form">
  <tr>
  <input type="hidden" id="depId">
    <th width="15%"><font class="cred">*</font>名称</th>
    <td  width="35%"><input class="hmui-input w" id="buildname" min = "1" max ="100"/></td>
    <th  width="15%"><font class="cred">*</font>类别</th>
    <td width="35%">
       <select class="hmui-select w"  id="buildingTypeCode">
	    <option value="">请选择类别</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingTypeCode", "")?>
	    </select>   
    </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>建造日期</th>
    <td><input class="hmui-input w" id="buildTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
    <th><font class="cred">*</font>使用性质</th>
    <td>
    	 <select class="hmui-select w"  id="buildingUseKindCode">
	    <option value="">请选择使用性质</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingUseKindCode", "")?>
	    </select> 
    </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>火灾危险性</th>
    <td>      
    	 <select class="hmui-select w"  id="buildingFireDangerCode">
	    <option value="">请选择火灾危险性</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingFireDangerCode", "")?>
	    </select> 
	 </td>
    <th><font class="cred">*</font>耐火等级</th>
    <td>
        <select class="hmui-select w"  id="buildingResistFireCode">
	    <option value="">请选择耐火等级</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingResistFireCode", "")?>
	    </select>
    </td>
  </tr>
    <tr>
    <th><font class="cred">*</font>结构类型</th>
    <td>
    	<select class="hmui-select w"  id="buildingStructureCode">
	    <option value="">请选择耐火等级</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingStructureCode", "")?>
	    </select>
    </td>
    <th><font class="cred">*</font>建筑高度</th>
    <td><input class="hmui-input w"  placeholder="m，精确至小数点后两位" id="buildHeight"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>建筑面积</th>
    <td><input class="hmui-input w" id="overallFloorage" placeholder="（㎡）"/></td>
    <th>占地面积</th>
    <td><input class="hmui-input w" id="floorSpace" placeholder="（㎡）"/></td>
  </tr>
   <tr>
    <th>标准层面积</th>
    <td><input class="hmui-input w" id="standardFloorage" placeholder="（㎡）"/></td>
    <th>日常工作时间人数</th>
    <td><input class="hmui-input w" id="workerNum" min = "1" max ="9999" placeholder="（㎡）" /></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>地上层数</th>
    <td><input class="hmui-input w" id="aboveGroundFloors" placeholder="（层）" /></td>
    <th>地上层面积</th>
    <td><input class="hmui-input w" id="aboveGroundArea" placeholder="（㎡）" /></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>地下层数</th>
    <td><input class="hmui-input w" id="underGroundFloors" placeholder="（层）" /></td>
    <th>地下层面积</th>
    <td><input class="hmui-input w" id="underGroundArea" placeholder="（㎡）" /></td>
  </tr>
      <tr>
    <th>最大容纳人数</th>
    <td><input class="hmui-input w" id="maxnumCapacity" min = "1" max ="99999" placeholder="（个）" /></td>
    <th><font class="cred">*</font>消防室控制位置</th>
    <td><input class="hmui-input w" placeholder="位置" id="controlRoomPosition" min = "1" max ="100"/></td>
  </tr>
     <tr>
      <th><font class="cred">*</font>消防控制室联系人</th>
      <td><input class="hmui-input w" id="controlRoomPerson" min = "1" max ="20"/></td>
      <th><font class="cred">*</font>消防控制室电话</td>
      <td><input class="hmui-input w" id="controlRoomPhone" placeholder="电话格式:0371-56694566或手机号为11位" /></td>
    </tr>
   
</table>
</form>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/management_build.js"></script>