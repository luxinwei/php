<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>



<div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="800">
 <tr>
    <th width="150px;"><font class="cred">*</font>单位名称</th>
    <td colspan="3"><input class="hmui-input w" id="depId"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火部位</th>
    <td colspan="3"><input class="hmui-input w" id="firePosition"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火时间</th>
    <td colspan="3"><input class="hmui-input w" id="fireTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火原因</th>
    <td colspan="3"><input class="hmui-input w" id="fireReason"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>报警方式</th>
    <td colspan="3">
     <select class="hmui-input w"  id="alarmTypeCode">
    <option value="">请选择报警方式</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("alarmTypeCode", "")?>
    </select>   
    </td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火面积</th>
    <td colspan="3"><input class="hmui-input w" id="burnedArea"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>死亡人数</th>
    <td colspan="3"><input class="hmui-input w" id="deathCount"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>受伤人数</th>
    <td colspan="3"><input class="hmui-input w" id="woundCount"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>财产损失</th>
    <td colspan="3"><input class="hmui-input w" id="propertyLoss"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>火灾扑救概况</th>
    <td colspan="3">
<!--     <textarea rows="4" cols="88" class="hmui-textarea"></textarea> -->
    <input class="hmui-input w" id="fireFightingDes"/>
    </td>
  </tr>


</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>    
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>      
<script type="text/javascript" src="js/fireinfomanagement_build.js"></script>