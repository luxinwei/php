<?php include '../../../authen/include/page/top.php';?>
<div style="background:#FFFFFF" class="hmui-shadow mt10">
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
	  <ul class="layui-tab-title">
            <li class="layui-this" id="btn_week">周</li>
            <li id="btn_month">月</li>
            <li id="btn_near">年</li>
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
		<tbody id="tbody_content"></tbody>
		</table>
	</div>
<div id="pageNav"></div>
	<div class="cb"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>; 
</script>           
<script type="text/javascript" src="js/falsepositives_detail.js"></script>
<script type="text/javascript" src="js/falsepositives_bar.js"></script>
<script type="text/javascript" src="js/falsepositives_pie_call.js"></script>
<script type="text/javascript" src="js/falsepositives_pie_part.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>