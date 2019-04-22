<?php include '../../../authen/include/page/top.php';?>
<style>
	.layui-tab{margin:0}
</style>
<div class="hmui-shadow mt10">
	<div style="background:#FFFFFF">
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
    <li class="layui-this">周</li>
    <li>月</li>
    <li>季</li>
    <li>年</li>
  </ul>
</div>
	</div>
	<div class="fl p20" style="background:#FFFFFF">
		<div id="pie" style="width:600px;min-height:700px;"></div>
	</div>
	<div class="fr doc-shadow p20" style="width:calc(100% - 690px);background:#FFFFFF;min-height:700px">
		<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="100%">
			<tr>
				<th>时间</th>
				<th>监管级别</th>
				<th>事件</th>
				<th>负责人</th>
				<th>详情</th>
			</tr>

				<tr>
					<td>2017-10-21</td>
					<td>A级</td>
					<td>无故起火</td>
					<td>赵宏博</td>
					<td>火势蔓延</td>
				</tr>
			<tr>
				<td>2017-11-22</td>
				<td>B级</td>
				<td>无故起火</td>
				<td>李博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-12-23</td>
				<td>C级</td>
				<td>无故起火</td>
				<td>武婷婷</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-12-25</td>
				<td>B级</td>
				<td>无故起火</td>
				<td>刘涛</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-10-21</td>
				<td>A级</td>
				<td>无故起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-11-22</td>
				<td>B级</td>
				<td>无故起火</td>
				<td>李博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-12-23</td>
				<td>C级</td>
				<td>无故起火</td>
				<td>武婷婷</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-12-25</td>
				<td>B级</td>
				<td>无故起火</td>
				<td>刘涛</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-10-21</td>
				<td>A级</td>
				<td>无故起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>2017-11-22</td>
				<td>B级</td>
				<td>无故起火</td>
				<td>李博</td>
				<td>火势蔓延</td>
			</tr>
		</table>
		<div id="pageNav">
			<div class="pagerb1">
				<ul>
					<li> <a class="page-first">第一页</a></li>
					<li> <a class="page-prev">上一页</a></li>
					<li> <a href="javascript:void(0);" class="page-next">下一页</a></li>
					<li> <a href="javascript:void(0);" class="page-last">最后页</a></li>
				</ul>
				第<input type="text" class="page-num">页/共3页 <span style="padding-left:10px;">共5条记录</span></div></div>
	</div>
	<div class="cb"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/unitfirealarm_detail.js"></script>