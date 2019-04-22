<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav">
	重点单位信息->演练任务管理
	<span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
</blockquote>



<div align="center" style="background-color: #f2f2f2;">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
 <tr>
    <th><font class="cred">*</font>执行单位</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th width="160px;"><font class="cred">*</font>开始时间</th>
    <td><input class="hmui-input"/></td>
    <th  width="150px;"><font class="cred">*</font>结束时间</td>
    <td><input  class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>演练状态</th>
    <td><input class="hmui-input"/></td>
    <th><font class="cred">*</font>演练结果</td>
    <td><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>演练要求</th>
    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>演练内容</th>
    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
  </tr>


</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/practicetask_detail.js"></script>