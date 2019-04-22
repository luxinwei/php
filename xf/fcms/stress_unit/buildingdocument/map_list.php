<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow">
<form class="alert_info">
	<input  placeholder="请输入关键字" class="hmui-input w300"/>
	<input type="button" value="搜索" class="hmui-btn"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
		<th>所属单位</th>
		<th>建筑名称</th>
		<th>图档名称</th>
		<th>图档类型 </th>
		<th>上传时间</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<?php for ($i=0;$i<10;$i++){?>
    <tr>
    	<td><?php echo $i;?></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td class="tc"><a class="hmui-btn-primary" href="?m=<?php echo $m?>"></a></td>
    </tr>     
    <?php }?>                                                                         
</table>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/map_list.js"></script>