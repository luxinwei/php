<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background-color: #FFFFFF;min-height:250px" class="mt10 p20 hmui-shadow">
 <span>字典项</span>
	<span  class="fr">
		<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="900">
	      <tr>
     	<th>字典名城</th>
     	<td><input class="hmui-input w300"  id="name"/></td>
     	<th>编码</th>
     	<td><input class="hmui-input w300" id="code"/></td>
     </tr> 
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/dictionarytype_add_type.js"></script>