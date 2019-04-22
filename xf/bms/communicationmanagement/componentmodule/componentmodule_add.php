<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "生产中","0"=> "====");
?>


<div align="center" style="background-color: #FFFFFF;min-height:750px" class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="重置" id="btn_relode" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
  <tr>
    <th  width="15%"><font class="cred">*</font>模板名称</th>
    <td width="35%"><input class="hmui-input w" id="sid" /></td>
    <th width="15%"><font class="cred">*</font>类型</th>
    <td width="35%">
         <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
    </tr>
    
    <tr>
    <th><font class="cred">*</font>单位</th>
    <td>
         <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
    <th><font class="cred">*</font>厂商</th>
    <td>
         <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择/option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>型号</th>
    <td>
         <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
    <th><font class="cred">*</font>测电组</th>
    <td>
     <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid">
	<tr>
 		<th>组编号</th>
		<th>测点名称</th>
		<th>测点类型</th>
		<th>系数 </th>
		<th>点大类 </th>
		<th>测点单位</th>
		<th>顺序</th>
		<th class="tc" width=80>操作</th>
	</tr>
	<tbody id="tbody_content"></tbody>   <!--   数据定位        -->
</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/componentmodule_add.js"></script>