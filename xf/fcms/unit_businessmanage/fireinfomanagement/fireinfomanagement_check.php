<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>




<div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
        <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th width="150px;"><font class="cred">*</font>单位名称</th>
    <td colspan="3"><span id="depId"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火部位</th>
    <td colspan="3"><span id="firePosition"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火时间</th>
    <td colspan="3"><span id="fireTime"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火原因</th>
    <td colspan="3"><span id="fireReason"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>报警方式</th>
    <td colspan="3"><span id="alarmTypeCode"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火面积</th>
    <td colspan="3"><span id="burnedArea"></span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>死亡人数</th>
    <td colspan="3"><span id="deathCount"></span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>受伤人数</th>
    <td colspan="3"><span id="woundCount"></span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>财产损失</th>
    <td colspan="3"><span id="propertyLoss"></span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>火灾扑救概况</th>
    <td colspan="3">
<!--     <textarea rows="4" cols="88" class="hmui-textarea"></textarea> -->
    <span id="fireFightingDes"></span>
    </td>
  </tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?> 
<script type="text/javascript">
var id="<?php echo $id?>";
var alarmTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("alarmTypeCode")?>;  
</script>           
<script type="text/javascript" src="js/fireinfomanagement_check.js"></script>