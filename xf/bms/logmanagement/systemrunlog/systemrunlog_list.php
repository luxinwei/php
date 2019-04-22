
<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input3 w300" />
时间段：<input class="hmui-input3 Wdate " onclick="WdatePicker({dateFmt:'YYYY-MM-dd'});"/>
——<input class="hmui-input3 Wdate " onclick="WdatePicker({dateFmt:'YYYY-MM-dd'});"/>
状态
<select class="hmui-input3 w100 ml50"><option>不限</option></select>
<input type="button" value="搜索" class="hmui-btn"/>
 


</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>

		<th>系统名称</th>
		<th>状态</th>
		<th>发生时间</th>
		<th>操作 </th>
	</tr>
	<?php for ($i=0;$i<10;$i++){?>
    <tr>
    <td><input type="checkbox" class="hmui-checkbox" name="be_checked"></td>
    	<td><?php echo $i;?></td>
    	<td></td>
    	<td></td>
    	<td class="tc">
    	<a class="hmui-btn">导出</a>
    	</td>
    </tr>     
    <?php }?>                                                                         
</table>
	<div id="pageNav" class="mt10"></div>
	<div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/systemrunlog_list.js"></script>