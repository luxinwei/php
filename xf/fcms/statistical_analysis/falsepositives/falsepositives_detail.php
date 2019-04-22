<?php include '../../../authen/include/page/top.php';?>
<div style="background:#FFFFFF" class="hmui-shadow mt10">
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
	  <ul class="layui-tab-title">
		<li class="layui-this">周</li>
		<li>月</li>
		<li>年</li>
	  </ul>
	</div>
	<div class="p20" align="center" style="width:1300px;margin:0 auto">
		<div class="p20">
			<div id="bar" style="width:1260px;height:500px;"></div>
		</div>
		<div class="fl mb50 p20">
			<div id="pie_call"  style="width:600px;height:400px;"></div>
		</div>
		<div class="fl ml20 p20">
			<div id="pie_part"  style="width:600px;height:400px;"></div>
		</div>
	</div>
	<div class="cb"></div>
	<div class="ml20" align="center">
		<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="1260px">
			<caption>误报详情列表</caption>
			<tr>
				<th class="tc">单位类型</th>
				<th class="tc">报警类型</th>
				<th class="tc">时间</th>
				<th class="tc">事件</th>
				<th class="tc">负责人</th>
				<th class="tc">详情</th>
			</tr>

			<tr>
				<td>特级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>一级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>二级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>三级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>四级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>一级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>二级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>三级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>四级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>一级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>二级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>三级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
			<tr>
				<td>四级单位</td>
				<td>自动</td>
				<td>2017-12-03</td>
				<td>起火</td>
				<td>赵宏博</td>
				<td>火势蔓延</td>
			</tr>
		</table>

	</div>
	<div id="pageNav" style="width:1300px;margin:0 auto;">
		<div class="pagerb1" style="padding:10px 0">
			<ul>
				<li> <a class="page-first">第一页</a></li>
				<li> <a class="page-prev">上一页</a></li>
				<li> <a href="javascript:void(0);" class="page-next">下一页</a></li>
				<li> <a href="javascript:void(0);" class="page-last">最后页</a></li>
			</ul>
			第<input type="text" class="page-num">页/共3页 <span style="padding-left:10px;">共5条记录</span><div></div>
		</div>
	</div>
	<div class="cb"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/falsepositives_detail.js"></script>
<script type="text/javascript" src="js/falsepositives_bar.js"></script>
<script type="text/javascript" src="js/falsepositives_pie_call.js"></script>
<script type="text/javascript" src="js/falsepositives_pie_part.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>