<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav">
	<span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn hmui-btn-primary ml10"/>
	</span>
</blockquote>



<div align="center" style="background-color: #f2f2f2;">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
 <tr>
    <th><font class="cred">*</font>发起单位</th>
    <td colspan="3"><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th width="160px;"><font class="cred">*</font>执行单位</th>
    <td><input class="hmui-input"/></td>
    <th  width="150px;"><font class="cred">*</font>培训标题</th>
    <td><input  class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>开始时间</th>
    <td><input class="hmui-input"/></td>
    <th><font class="cred">*</font>结束时间</th>
    <td><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>培训状态</th>
    <td colspan="3"><select class="hmui-select w200"></select></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>培训内容</th>
    <td colspan="3"><textarea rows="4" cols="60" class="hmui-textarea"></textarea></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>合格率</th>
    <td><select class="hmui-select w200"></select></td>
     <th><font class="cred">*</font>参加率</th>
    <td><select class="hmui-select w200"></select></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>培训照片</th>
    <td colspan="3"></td>
  </tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/traintaskmanagement_detail.js"></script>