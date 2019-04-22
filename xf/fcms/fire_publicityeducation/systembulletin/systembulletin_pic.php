<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav hmui-shadow">
审核
</blockquote>



<div align="center" style="background-color: #FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
  <tr>
    <th width="160px;">公告范围</th>
    <td><select class="hmui-select w" ></select></td>
    <th  width="150px;">输入人姓名</th>
    <td><input  class="hmui-input w"/></td>
  </tr>
  <tr>
    <th>颁布日期</th>
    <td><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th></th>
    <td colspan="3"><textarea rows="4" cols="92" class="hmui-textarea">文章内容</textarea></td>
  </tr>
</table>
	<input type="button" value="不通过" id="btn_go" class="hmui-btn"/>
	<input type="button" value="通过" id="btn_back" class="hmui-btn"/>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_detail.js"></script>