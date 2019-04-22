<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>



<div align="center" class="mt10 p20 hmui-shadow" style="background:#FFFFFF;min-height:750px">
    <span  class="fr">
    		 <input type="button" value="编辑" id="btn_edit" class="hmui-btn ml10"/>
    
 		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th width="20%;"><font class="cred"></font>单位名称</th>
    <td width="30%;"><span id="depName"></span></td>
    <th  width="20%;"><font class="cred"></font>首次报警时间</th>
    <td><span id="firstAlarmTime"></span></td>
  </tr>
   <tr>
    <th><font class="cred"></font>受理时间</th>
    <td><span id="acceptTime"></span></td>
    <th><font class="cred"></font>受理结束时间</th>
    <td><span id="acceptEndTime"></span></td>
  </tr>
 <tr>
    <th><font class="cred"></font>信息类型</th>
    <td colspan="3"><span id="acceptedTypeCode"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>信息描述</th>
    <td colspan="3"><span id="description"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>处理结果</th>
    <td><span id="handleResult"></span></td>
    <th><font class="cred"></font>受理员姓名</th>
    <td><span id="acceptUser"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>消息确认</th>
    <td colspan="3"><span id="acceptedConfirmCode"></span></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200" style="margin-top:-18px">
  <tr>
    <th width="20%"><font class="cred"></font>向消防通信指挥中心报告时间</th>
    <td width="80%"><span id="reportTime"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>消防通信指挥中心反馈确认时间</th>
    <td><span id="reportFeebackTime"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>消防通信指挥中心受理员姓名</th>
    <td><span id="monitorUserName"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>消防通信指挥中心接管处理情况</th>
    <td><span id="monitorHandleInfo"></span></td>
  </tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var acceptedConfirmCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedConfirmCode")?>;
</script>     
<script type="text/javascript" src="js/firealarmaccept_detail.js"></script>