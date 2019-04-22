
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   

?>
<style>
.huise{background-color:#f2f2f2}
</style>
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
	<div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
   <input type="hidden" id="depId">
	<tr>
  		<th  width="15%"><font class="cred">*</font>培训课题</th>
    	<td width="35%"><input  class="hmui-input w huise" id="trainingTitle" disabled="disabled" /></td>
			<th width="15%" ><font class="cred">*</font>培训状态</th>
			<td width="35%"> 
				   <select class="hmui-select w"  id="taskStateCode">
				    <option value="">请选择培训状态</option>
				    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("taskStateCode", "")?>
				    </select> 
			</td>
  	</tr>
  		<tr>
  		<th><font class="cred">*</font>开始时间</th>
   		<td><input  class="hmui-input w huise" id="beginTime" disabled="disabled" beginTimeValue=""/></td>
  		<th><font class="cred">*</font>结束时间</th>
    	<td><input  class="hmui-input w huise"  id="endTime" disabled="disabled" endTimeValue=""/></td>
  	</tr>
  	<tr>
  		<th><font class="cred">*</font>培训内容</th>
   			<td colspan="3"><textarea rows="4"  class="hmui-textarea w huise pl10" id="trainingContent" disabled="disabled"></textarea></td>
  	</tr>
		<tr>
			<th ><font class="cred">*</font>合格率</th>
			<td><input  class="hmui-input w"  id="percentRate"/> </td>
			<th ><font class="cred">*</font>参加率</th>
			<td><input  class="hmui-input w"  id="joiningRate"/> </td>
		</tr>
		<tr>
			<th ><font class="cred">*</font>培训照片</th>
			<td>
			  	<input type="hidden" name="file_base64" id="file_base64">
			 	 <style>#myCanvas{width:454px;height:621px;border: 1px solid #c3c3c3;}</style>
				<script type="text/javascript" src="js/Canvas2Image.js"></script>
			  	 <img id="file_base64img" width="100" height="100"/>
			     <input type="file" name="file" onchange="imgPreview(this)" />
			   </td>
  			
 		 </tr>
 
</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
</script>         
<script type="text/javascript" src="js/trainingduty_update.js"></script>