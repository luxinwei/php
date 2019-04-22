
<?php include '../../../authen/include/page/top.php';?>

<?php 
$id=Fun::request("id");   
?>
<style>
.huise{background-color: #f2f2f2}
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
  		<tr>
			<th><font class="cred">*</font>开始时间</th>
			<td><input  class="hmui-input w huise" id="beginTime" eadonly="readonly" /></td>
			<th><font class="cred">*</font>结束时间</th>
			<td><input  class="hmui-input w huise" id="endTime" eadonly="readonly" /></td>
		</tr>
		<tr>
			<th>下发单位</th>
			<td><input  class="hmui-input w huise" id="depId" depIdValue="" disabled="disabled"></span></td>
			<th >演练任务名称</th>
			<td ><input  class="hmui-input w huise" id="practicetaskname" disabled="disabled"></span> </td>
		</tr>
		<tr>
			<th><font class="cred">*</font>演练状态</th>
			<td>  <select class="hmui-select w"  id="taskStateCode">
				    <option value="">请选择培训状态</option>
				    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("taskStateCode", "")?>
				    </select> </td>
			<th><font class="cred">*</font>演练结果</th>
			<td><input  class="hmui-input w huise" id="result" disabled="disabled"/> 
			</td>
		</tr>
		<tr>
			<th><font class="cred">*</font>演练要求</th>
			<td><input  class="hmui-input w huise" id="practiceRequirements" disabled="disabled"/> </td>
 			 <th><font class="cred">*</font>演练内容</th>
			<td><input  class="hmui-input w huise" id="practiceContent" disabled="disabled"/></td>
  		</tr>
		<tr>
			
			<th><font class="cred">*</font>演练资料</th>
			<td><span id="" class="hand">上传演练资料</span></td>

		</tr>
 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var taskStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("taskStateCode")?>;
var overtimeFlag_jsarray=[['0','超时'],['1','未超时']];
</script>           
<script type="text/javascript" src="js/practicetask_update.js"></script>