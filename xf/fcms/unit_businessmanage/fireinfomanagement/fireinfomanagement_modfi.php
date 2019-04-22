<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav hmui-shadow">
    单位监管->火灾信息管理
	<span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn" />
		<input type="button" value="返回" id="btn_history" class="hmui-btn" />
	</span>
</blockquote>



<div align="center" style="min-height: 700px;background:#FFFFFF" class="mt10 p20 hmui-shadow">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="800">
 <tr>
    <th><font class="cred">*</font>单位名称</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火部位</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火时间</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火原因</th>
    <td colspan="3"><select class="hmui-select w220"></select></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>报警方式</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>起火面积</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>死亡人数</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>受伤人数</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>财产损失</th>
    <td colspan="3"><textarea rows="4" cols="88" class="hmui-textarea"></textarea></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>火灾扑救概况</th>
    <td colspan="3"><textarea rows="4" cols="88" class="hmui-textarea"></textarea></td>
  </tr>

</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/fireinfomanagement_detail.js"></script>