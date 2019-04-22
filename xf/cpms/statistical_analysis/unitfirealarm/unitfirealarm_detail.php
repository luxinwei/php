<?php include '../../../authen/include/page/top.php';?>
<style>
	.layui-tab{margin:0}
</style>
<div class="hmui-shadow mt10">
	<div style="background:#FFFFFF">
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
            <li class="layui-this" id="btn_week">周</li>
            <li id="btn_month">月</li>
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
		<tbody id="tbody_content"></tbody>
 		</table>
	</div>
	<div id="pageNav">
	</div>
	<div class="cb"></div>
</div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/unitfirealarm_detail.js"></script>