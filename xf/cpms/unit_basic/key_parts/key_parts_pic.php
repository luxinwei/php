<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav hmui-shadow">重点单位信息->重点部位管理 </blockquote>
<div class="mt10 hmui-shadow">
<form class="alert_info">
<input  placeholder="请输入关键字" class="hmui-input"/><input type="button" value="搜索" class="hmui-btn"/>
<input type="button" value="新建" class="hmui-btn fr ml10" id="btn_build"/>
<input type="button" value="关闭" class="hmui-btn fr ml10" id="btn_close"/>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
	<tr>
	<th width="30"><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
		<th>设施名称</th>
		<th>设置部位</th>
		<th>设施系统形式</th>
		<th>投入使用时间</th>
		<th>设施服务状态</th>
		<th>设施状态</th>
		<th class="tc" width="100">操作</th>
	</tr>
	<?php for ($i=0;$i<10;$i++){?>
    <tr>
    <td><input type="checkbox" class="hmui-checkbox" name="be_checked"></td>
    	<td><?php echo $i;?></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td class="tc"><a class="hmui-btn hmui-btn-primary" href="key_parts_detail.php?m=<?php echo $m?>">详情</a>
		<a class="hmui-btn hmui-btn-primary" href="#?m=<?php echo $m?>"  name="btn_delete">删除</a></td>
    </tr>     
    <?php }?>                                                                         
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/key_parts_list.js"></script>