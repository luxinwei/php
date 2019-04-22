<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav">
	<span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn hmui-btn-primary ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn hmui-btn-primary ml10"/>
	</span>
</blockquote>



<div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
	<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
	 <tr>
	    <th><font class="cred">*</font>发起单位</th>
	    <td colspan="3"><input class="hmui-input"/></td>
	  </tr>
	  <tr>
	    <th width="15%"><font class="cred">*</font>执行单位</th>
	    <td width="35%"><input class="hmui-input w"/></td>
	    <th width="15%"><font class="cred">*</font>培训标题</th>
	    <td width="35%"><input class="hmui-input"/></td>
	  </tr>
	  <tr>
	    <th><font class="cred">*</font>开始时间</th>
	    <td><input class="hmui-input"/></td>
	    <th><font class="cred">*</font>结束时间</th>
	    <td><input class="hmui-input"/></td>
	  </tr>
	  <tr>
	    <th><font class="cred">*</font>培训内容</th>
	    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
	  </tr>
	</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/traintaskmanagement_build.js"></script>