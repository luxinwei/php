<?php include '../../../authen/include/page/top.php';?>
<div align="center" class="mt10 p20 hmui-shadow" style="min-height:750px;background:#FFFFFF">
    <span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
 <tr>
    <th><font class="cred"></font>任务标题</th>
    <td colspan="3"><input class="hmui-input w"/></td>
  </tr>
  <tr>
    <th width="160px;"><font class="cred"></font>发起单位</th>
    <td><input class="hmui-input w"/></td>
    <th  width="150px;"><font class="cred"></font>执行单位</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th><font class="cred"></font>巡查部位</th>
    <td><select class="hmui-select w"></select></td>
    <th><font class="cred"></font>巡查设施</th>
    <td><select class="hmui-select w"></select></td>
  </tr>
   <tr>
    <th><font class="cred"></font>巡查策略</th>
    <td><input class="hmui-input w"/></td> 
  </tr>
  <tr>
    <th><font class="cred"></font>偏差时间时间</th>
    <td><input class="hmui-input w"/></td> 
  </tr>
  <tr>
    <th><font class="cred"></font>巡查人员</th>
    <td><select class="hmui-select w"></select></td>
    <th><font class="cred"></font>巡查点</th>
    <td><input class="hmui-input w"/></td>
  </tr>
  <tr>
    <th><font class="cred"></font>巡查要求</th>
    <td colspan="3"><select class="hmui-select w"></select></td>
  </tr>
 </table>


</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/patroltaskmanagement_build.js"></script>