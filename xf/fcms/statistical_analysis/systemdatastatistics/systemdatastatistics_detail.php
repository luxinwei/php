<?php include '../../../authen/include/page/top.php';?>
<style>
.checkes{margin:10px;padding:20px;float:left;}
.checkes ul li{margin:10px 0}
.charts{width:calc(100% - 250px)}
.charts-list{padding:20px;margin:0 10px 20px}
</style>
<div class="hmui-shadow">
	<div class="checkes" style="height:1300px">
		<ul>
			<li><input name="fire" type="checkbox" class="hmui-checkbox" value="1"><span>火灾自动报警系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="1"><span>消防水源</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="1"><span>消火栓灭火系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="1"><span>自动喷淋灭火系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="1"><span>防排烟系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="1"><span>防火门帘系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>消防应急广播系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>消防电话系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>应急照明及疏散指示系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>消防设备电源监控系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>智慧用电系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>消防电梯</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>灭火器</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>视频监控</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>泡沫灭火系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>干粉灭火系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>气体自动灭火系统</span></li>
			<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>消防设备电源监控系统</span></li>
		</ul>
	</div>
	<div id="tbody_content" class="charts fr" style="background:#FFFFFF"></div>
	<div class="cb"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">

</script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>
<script type="text/javascript" src="js/systemdatastatistics_detail.js"></script>