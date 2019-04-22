<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "正常","0"=> "暂停");
$id=Fun::request("id");
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" id="detail" class="hmui-shadow p20">
  <span  class="fr">
		<font>联网状态：联网</font>
		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>    	
</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
  <tr>
    <th  width="15%"><font class="cred">*</font>中心名称</th>
    <td width="35%"><input class="hmui-input w" id="centername" /></td>
    <th width="15%"><font class="cred">*</font>所属区域</th>
    <td width="35%"><input class="hmui-input w hand" id="areaId" areaIdValue="" value="" /></td>
  </tr>
  <tr>
     <th><font class="cred">*</font>中心地址/th>
     <td class="pr"><input class="hmui-input w" id="address"/><input type="button" id="btn_map"/><input type="hidden"  id="position" /></td>
    <th><font class="cred">*</font>状态</th>
    <td>
    	<select class="hmui-select w" id="">
    	<option value="">请选择</option>
      <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
    </select>
    </td>
  </tr>
   <tr>
	    <th><font class="cred">*</font>联系电话</th>
	    <td><input class="hmui-input w" id="telephone"  placeholder="(固定电话格式：例如：0371-56694566或 手机号为11位)" /></td>
	    <th><font class="cred">*</font>中心负责人姓名</th>
	    <td><input class="hmui-input w" id="chargePerson"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心负责人联系方式</th>
    <td><input class="hmui-input w" id="chargePhone" /></td>
     <th><font class="cred">*</font>中心级别</th>
    <td>
     <select class="hmui-select w"  id="monitorCenterRankCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("monitorCenterRankCode", "")?>
    </select>
    </td>
  </tr>
    <tr>
   	<th><font class="cred">*</font>上级中心名称</th>
    <td><input class="hmui-input w" /></td>
    <th><font class="cred">*</font>冗余备份中心名称</th>
    <td><input class="hmui-input w"/></td>
  </tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/monitorcenter_add.js"></script>