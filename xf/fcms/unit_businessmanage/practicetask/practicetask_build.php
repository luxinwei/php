<?php include '../../../authen/include/page/top.php';?>


<?php 
$libsArray=array("0"=> "超时","1"=> "未超时");

?>
<div align="center" class="mt10 hmui-shadow p20" style="background:#FFFFFF;min-height:750px">
    <span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn"/>
		<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
     <tr>
	    <th><font class="cred">*</font>执行单位</th>
		 <td width="35%"><input  class="hmui-input hand w" id="executeDepId"  executeDepIdValue="" /></td>
      </tr>
       <tr>
			<th width="15%"><font class="cred">*</font>开始时间</th>
			<td width="35%"><input  class="hmui-input w" id="beginTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
			<th width="15%"><font class="cred">*</font>结束时间</th>
			<td width="35%"><input  class="hmui-input w" id="endTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
		</tr>
		<tr>
			<th >演练任务名称</th>
			<td ><input  class="hmui-input w" id="practicetaskname" ></span> </td>
			<th><font class="cred">*</font>演练内容</th>
			<td><input  class="hmui-input w" id="practiceContent" /></td>
		</tr>
		<tr>
			<th><font class="cred">*</font>演练状态</th>
			<td> 
				<select class="hmui-select w"  id="taskStateCode">
				    <option value="">请选择培训状态</option>
				    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("taskStateCode", "")?>
				</select>
			</td>
			<th><font class="cred">*</font>演练结果</th>
			<td><input  class="hmui-input w" id="result" />  
			</td>
		</tr>
		<tr>
			<th><font class="cred">*</font>演练要求</th>
			<td><input class="hmui-input w" id="practiceRequirements" /> </td>
  			<th ><font class="cred">*</font>是否超时</th>
			<td>
 			<select class="hmui-select w" id="overtimeFlag">
			     <option value="">请选择状态</option>
			      <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
			    
			    </select>
			</td>
  		</tr>
		<tr>
			<th><font class="cred">*</font>演练资料</th>
			<td><span id="" class="hand">上传演练资料</span></td>

		</tr>
 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/practicetask_build.js"></script>