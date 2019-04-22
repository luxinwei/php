<?php include '../../../authen/include/page/top.php';?>



<div align="center" style="background-color: #FFFFFF;min-height:750px" id="detail" class="p20 hmui-shadow">
  <span  class="fr">
		<font>联网状态：联网</font>
<input type="button" value="保存" id="btn_save" class="hmui-btn ml10 "/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
  <tr>
    <th  width="150px"><font class="cred">*</font>中心名称</th>
    <td><input class="hmui-input w500" id="centername" /></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>所属区域</th>
    <td><input class="hmui-input w500" id="address"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心详地址</th>
    <td><input class="hmui-input w500" id="position"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>联系点话</th>
    <td><input class="hmui-input w500" id="telephone"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心负责人姓名</th>
    <td><input class="hmui-input w500" id="chargePerson"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心负责人联系方式</th>
    <td><input class="hmui-input w500" id="chargePhone" /></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心级别</th>
    <td><input class="hmui-input w500" id="monitorCenterRankCode"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>上级中心名称</th>
    <td><input class="hmui-input w500" /></td>
  </tr>
     <tr>
    <th><font class="cred">*</font>areaId</th>
    <td><input class="hmui-input w500" id="areaId"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>冗余备份中心名称</th>
    <td><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>状态</th>
    <td><select class="hmui-select w200"></select></td>
  </tr>

</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/regulatorycenter_add.js"></script>