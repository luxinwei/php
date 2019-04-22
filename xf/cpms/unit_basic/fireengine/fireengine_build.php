
<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
 $libsArray=array("1"=> "是","0"=> "否");
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		<input type="button" value="重置" id="btn_reset " class="hmui-btn ml10"/>
		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
        <tr>
        <th width="160px;"><font class="cred">*</font>主机名称</th>
        <td><input class="hmui-input w" id="name"/></td>
        <th  width="150px;"><font class="cred">*</font>主机sid</td>
        <td><input  class="hmui-input w" id="sid"/></td>
      </tr>
      <tr>
        <th><font class="cred">*</font>通讯模组</th>
        <td><input class="hmui-input w" id="moduleId" /></td>
        <th><font class="cred">*</font>生产厂商</td>
        <td><input class="hmui-input w" id="manufacturer" /></td>
      </tr>
      <tr>
        <th><font class="cred">*</font>型号</th>
        <td><input class="hmui-input w" id="model"/></td>
        <th><font class="cred">*</font>编号</th>
        <td ><input class="hmui-input w" id="number"/></td>
      </tr>
            <tr>
        <th><font class="cred">*</font>描述</th>
        <td><input class="hmui-input w" id="description"/></td>
        <th><font class="cred">*</font>删除状态</th>
        <td >
   			 <?php echo CodeUtil::getInstance()->getLibsRadioBox("delFlag","",$libsArray);?>
       </tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/fireengine_build.js"></script>