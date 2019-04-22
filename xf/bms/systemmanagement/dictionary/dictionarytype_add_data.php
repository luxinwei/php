<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow">
 <span>字典项</span>
 <span>   
		<input type="button" value="增加" class="hmui-btn ml10" id="btn_add"/>
 		<input type="button" value="删除" class="hmui-btn ml10" id="btn_del"/>
 </span>
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
		<th>字典类型名称</th>
		<th>编码</th>
		<th>字典值</th>
		<th>排序</th>
		<th>父节点ID</th>
 	</tr>
	<tbody id="tbody_content"  ></tbody>                                                                  
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/dictionarytype_add_data.js"></script>