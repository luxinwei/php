<?php include '../../../authen/include/page/top.php';?>
	<div class="charts-list fl">
		<div id="line"  style="width:400px;height:300px;"></div>
	</div>
	<div class="charts-list fl">
		<div  id="bar" style="width:400px;height:300px;"></div>
	</div>
	<div class="charts-list fl">
		<div id="pie_part" style="width:400px;height:300px;"></div>
	</div>
	 
 
	<div class="cb"></div>
	<div class="mb100">
		<h2 class="f16 fl">巡查报表</h2>
		<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		  <ul class="layui-tab-title fr mr50">
		    <li class="layui-this">日</li>
		    <li>周</li>
		    <li>月</li>
		    <li>季</li>
		    <li>年</li>
		  </ul>
		  </div>	 
			<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="1380px">
				<tr>
					<th class="tc">序列</th>
					<th class="tc">设备名称</th>
					<th class="tc">巡查人员</th>
					<th class="tc">巡检时间</th>
					<th class="tc">巡检结果</th>
				</tr>
				<?php for ($i=0;$i<4;$i++){?>
			    <tr>
			    	<td><?php echo $i;?></td>
			    	<td></td>
			    	<td></td>
			    	<td></td>
			    	<td class="tc">
			    	</td>
			    </tr>     
			    <?php }?>                                                                         
			</table>
		</div>


<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">

</script> 
<script type="text/javascript" src="js/systemdatastatistics_content1.js"></script>
<script type="text/javascript" src="js/systemdatastatistics_content1_line.js"></script>
<script type="text/javascript" src="js/systemdatastatistics_content1_bar.js"></script>
<script type="text/javascript" src="js/systemdatastatistics_content1_pie_part.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>