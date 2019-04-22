<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
<style>
</style>


<div align="center" style="background-color: #FFFFFF;min-height:750px" class="hmui-shadow p20">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
<tr>
    <th width="20%;"><font class="cred">*</font>单位名称</th>
    <td width="30%;"><input class="hmui-input w disabledno"   id="depId" disabled="disabled"/></td>
    <th  width="20%;"><font class="cred">*</font>首次报警时间</th>
    <td><input class="hmui-input w disabledno"   id="firstAlarmTime" disabled="disabled" /></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>受理时间</th>
    <td><input class="hmui-input w disabledno"  id="acceptTime" disabled="disabled"/></td>
    <th><font class="cred">*</font>受理结束时间</th>
    <td><input class="hmui-input w disabledno"  id="acceptEndTime" disabled="disabled"/></td>
  </tr>
 <tr>
    <th><font class="cred">*</font>信息类型</th>
    <td colspan="3">
      <select class="hmui-select w"  id="acceptedTypeCode"  disabled="disabled">
    <option value="">请选择消息确认</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("acceptedTypeCode", "")?>
    </select>
    </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>信息描述</th>
    <td colspan="3"><input class="hmui-input w disabledno"   id="description" disabled="disabled"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>处理结果</th>
    <td><input class="hmui-input w"   id="handleResult" disabled="disabled"/></td>
    <th><font class="cred">*</font>受理员姓名</th>
    <td><input class="hmui-input w"   id="userName" disabled="disabled"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>消息确认</th>
    <td colspan="3">
      <select class="hmui-select w"  id="acceptedConfirmCode">
    <option value="">请选择消息确认</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("acceptedConfirmCode", "")?>
    </select>
    </td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
  <tr>
    <th width="20%"><font class="cred">*</font>向消防通信指挥中心报告时间</th>
    <td width="80%"><input class="hmui-input w"   id="reportTime"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>消防通信指挥中心反馈确认时间</th>
    <td><input class="hmui-input w"   id="reportFeebackTime"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>消防通信指挥中心受理员姓名</th>
    <td><input class="hmui-input w"   id="monitorUserName"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>消防通信指挥中心接管处理情况</th>
    <td><input class="hmui-input w"   id="monitorHandleInfo"/></td>
  </tr>
 
</table>
</div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?> 
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var acceptedConfirmCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedConfirmCode")?>;
</script>             
<script type="text/javascript" src="js/firealarmaccept_update.js"></script>