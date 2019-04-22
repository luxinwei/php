<?php include '../../../authen/include/page/top.php';?>
<style>
    body{background:transparent}
</style>
	<span  class="fr">
<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
<div class="cb"></div>
<div align="center" >
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
<tr>
    <th width="160px;"><font class="cred"></font>报警时间</th>
    <td><input class="hmui-input w"/></td>
    <th  width="150px;"><font class="cred"></font>报警类型</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th width="160px;"><font class="cred"></font>所属建筑</th>
    <td><input class="hmui-input w"/></td>
    <th  width="150px;"><font class="cred"></font>所属部位</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th width="160px;"><font class="cred"></font>所属设施</th>
    <td><input class="hmui-input w"/></td>
    <th  width="150px;"><font class="cred"></font>是否误报</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th><font class="cred"></font>所属设施</th>
    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
  </tr>
   <tr>
    <th width="160px;"><font class="cred"></font>当前状态</th>
    <td><input class="hmui-input w"/></td>
    <th  width="150px;"><font class="cred"></font>处理时间</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th><font class="cred"></font>处理结果</th>
    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
  </tr>

</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/electricmonitor_detail_detai1l.js"></script>