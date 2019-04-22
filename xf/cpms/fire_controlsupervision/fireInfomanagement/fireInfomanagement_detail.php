<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>




<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="detail"></div>
<table width="1200" class="hmui-table2">
 <tr>

    <th width="15%"><font class="cred">*</font>起火部位</th>
    <td width="35%"><span id="firePosition"></span></td>
 
  </tr>
   <tr>
    <th><font class="cred">*</font>起火时间</th>
    <td ><span id="fireTime"></span></td>
    <th width="15%"><font class="cred">*</font>起火原因</th>
    <td width="35%" ><span id="fireReason"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>报警方式</th>
    <td ><span id="alarmTypeCode"></span></td>
    <th><font class="cred">*</font>过火面积</th>
    <td ><span id="burnedArea"></span><span>（㎡）</span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>死亡人数</th>
    <td ><span id="deathCount"></span><span>（个）</span></td>
    <th><font class="cred">*</font>受伤人数</th>
    <td ><span id="woundCount"></span><span>（个）</span></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>财产损失</th>
    <td ><span id="propertyLoss"></span><span>（元）</span></td>
    <th><font class="cred">*</font>火灾扑救概况</th>
    <td >
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
<script type="text/javascript" src="js/fireInfomanagement_detail.js"></script>