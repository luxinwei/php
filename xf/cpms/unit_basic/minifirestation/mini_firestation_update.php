
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");  
 ?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
<tr>
    <input type="hidden" id="depId"/>
    <th width="15%"><font class="cred">*</font>名称</th>
    <td width="35%"> <input class="hmui-input w" id="mininame" min ="1" max ="100"/></td>
    <th  width="15%"><font class="cred">*</font>编码</th>
    <td width="35%"><input  class="hmui-input w" id="code" min ="1" max ="100"/></td>
  </tr>
 
    <tr>
     <th><font class="cred">*</font>详细地址</th>
     <td class="pr">
     <input class="hmui-input w" id="address" min ="1" max ="20" disabled="disabled" />
    <input class="hand" type="button" id="btn_map" max="20"/>
    <input type="hidden" id="position" min ="1" max ="100"/>
    </td>
     <th><font class="cred">*</font>值班电话</th>
    <td ><input class="hmui-input w" id="dutyPhone" min ="3" max ="15"/><span> </span></td>
  </tr>
 
  <tr>
    <th><font class="cred">*</font>负责人</th>
    <td><input class="hmui-input w" id="chargePerson" min ="1" max ="20"/></td>
    <th><font class="cred">*</font>联系电话</th>
    <td><input class="hmui-input w" id="phone" min ="3" max ="15"/><span> </span></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>微型消防站关联人员</th>
 	 <td ><input class="hmui-input w hand" id="btn_chose"  /><input type="hidden" id="userIds"   value=""/></td>
  </tr>
 
</table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>         
<script type="text/javascript" src="js/mini_firestation_update.js"></script>