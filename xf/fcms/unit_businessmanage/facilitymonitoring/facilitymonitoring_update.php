<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<blockquote class="hmui-nav hmui-shadow">
    单位监管->设施监测
    
	<span  class="fr">
		        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
</blockquote>



<div align="center" style="background:#FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="800">
 <tr>
    <th width="150px;"><font class="cred">*</font>所属设施</th>
    <td><span id="depId"></span></td>
    <th width="150px;"><font class="cred">*</font>项目名称</th>
    <td><span id="firePosition"></span></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>检测单位</th>
    <td><span id="depId"></span></td>
    <th width="150px;"><font class="cred">*</font>检测周期</th>
    <td><span id="firePosition"></span></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>检测时间</th>
    <td><span id="depId"></span></td>
    <th width="150px;"><font class="cred">*</font>检测负责人</th>
    <td><span id="firePosition"></span></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>检测结果</th>
    <td colspan="3">
    <textarea rows="4" cols="88" class="hmui-textarea"  id="fireFightingDes"></textarea> -->
    </td>
  </tr>
     <tr>
    <th width="150px;"><font class="cred">*</font>检测报告</th>
    <td><span id="depId"></span></td>
    <td colspan="2"> <input type="button" value="上传" id="btn_up" class="hmui-btn"/></td>
    
  </tr>
    <tr>
    <td></td>
    <td><input type="button" value="保存" id="btn_save" class="hmui-btn ml10 w200"/></td>
  </tr>

</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>    
<script type="text/javascript">
var id="<?php echo $id?>";
var alarmTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("alarmTypeCode")?>;  
</script>      
<script type="text/javascript" src="js/facilitymonitoring_update.js"></script>