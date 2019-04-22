
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   

?>

<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
    <div class="cb"></div>
	<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
	 
	 
	  <!-- <input type="hidden" id="depId"> --> 
	  <tr>
	    <th width="15%"><font class="cred">*</font>执行单位</th>
	    <td width="35%"><input  class="hmui-input hand w" id="executeDepId"  executeDepIdValue="" /></td>
	    <th  width="15%"><font class="cred">*</font>培训标题</th>
	    <td width="35%"><input  class="hmui-input w" id="trainingTitle"/></td>
	  </tr>
	  <tr>
	    <th><font class="cred">*</font>开始时间</th>
	    <td><input class="hmui-input w" id="beginTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
	    <th><font class="cred">*</font>结束时间</th>
	    <td><input class="hmui-input w" id="endTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
	  </tr>
	  <tr>
	  <tr>
	    <th><font class="cred">*</font>培训内容</th>
	    <td colspan="3">
	<!--     <textarea rows="4" cols="60" class="hmui-textarea"></textarea> -->
	    <input class="hmui-input w" id="trainingContent" />
	    <input type="hidden" id="drillStateCode" value="1"/>
	    </td>
	  </tr>
	</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
</script>         
<script type="text/javascript" src="js/traintaskmanagement_update.js"></script>