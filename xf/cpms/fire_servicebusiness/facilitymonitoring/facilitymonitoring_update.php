<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>



<div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
 <tr>
    <th width="150px;"><font class="cred">*</font>所属设施</th>
    <td><span id="deviceId"></span></td>
    <th width="150px;"><font class="cred">*</font>项目名称</th>
    <td><span id="name"></span></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>检测单位</th>
    <td><span id="department"></span></td>
    <th width="150px;"><font class="cred">*</font>检测周期</th>
    <td><span id="period"></span></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>检测时间</th>
    <td><span id="testTime"></span></td>
    <th width="150px;"><font class="cred">*</font>检测负责人</th>
    <td><span id="director"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>检测结果</th>
    <td colspan="3">
   <!-- <textarea rows="4" cols="88" class="hmui-textarea"  id="result"></textarea> -->
    </td>
  </tr>


</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>    
<script type="text/javascript">
var id="<?php echo $id?>";
var alarmTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("alarmTypeCode")?>;  
</script>      
<script type="text/javascript" src="js/facilitymonitoring_update.js"></script>