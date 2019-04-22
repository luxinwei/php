 
<?php include '../../../authen/include/page/top.php';?>
<?php 
$stateArray=array("0"=> "未处理","1"=> "处理中");
$sexArray=array("0"=> "女","1"=> "男");
$id=Fun::request("id");
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
 <tr>
    <th width="15%"><font class="cred">*</font>姓名</th>
    <td width="35%"><input class="hmui-input w hand" id="name"  /></td>
    <th  width="15%"><font class="cred">*</font>性别</td>
    <td width="35%">
    	<select class="hmui-select w" id="sex">
     		<option value="">请选择 </option>
     		<?php echo CodeUtil::getInstance()->getLibsSelectOption("",$sexArray);?>
   		 </select>
   </td>     
  </tr>
  <tr>
    <th><font class="cred">*</font>邮箱</th>
    <td><input class="hmui-input w hand" id="email"  /></td>
    <th><font class="cred">*</font>用户手机号</td>
    <td><input  class="hmui-input w " id="phone"/></td>     
  </tr>
<tr>
  	<th><font class="cred">*</font>登录密码</td>
    <td><input  class="hmui-input w"  id="password"  max="6"/></td>
    <th><font class="cred">*</font>应用类型</td>
    <td><input class="hmui-input w hand" id="appCode"  readonly="readonly"/></td>
</tr>
  <tr>
    <th><font class="cred">*</font>单位类型</td>
    <td width="35%"><input class="hmui-input w hand" id="depId" depIdValue="" readonly="readonly"/></td>
      	<th ><font class="cred">*</font>状态</td>
    <td> 
		 <select class="hmui-select w" id="state">
     		<option value="">请选择 </option>
     		<?php echo CodeUtil::getInstance()->getLibsSelectOption("",$stateArray);?>
   		 </select>
   	</td>
 </tr>
   <tr>
    <th><font class="cred">*</font>地址</th> 
    <td><input class="hmui-input w hand" id="address"  /></td>
         <th><font class="cred">*</font>入网日期</th> 
    <td><input class="hmui-input w hand" id="birthday" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" /></td>
  </tr>
 
 
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/accountmanagement_update.js"></script>