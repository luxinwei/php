<?php include '../../../authen/include/page/top.php';?>
<style>
    .layui-tab{margin:0}
</style>
<div class="hmui-shadow">
    <div style="background:#FFFFFF;" class="mt10">
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
          <ul class="layui-tab-title">
            <li class="layui-this">周</li>
            <li>月</li>
            <li>年</li>
          </ul>
        </div>
        </div>
    <div style="background:#FFFFFF;" class="p20" align="center">
        <div style="width:1300px;margin:0 auto">
            <div class="p20">
                <div id="bar" style="width:1260px;height:500px;"></div>
            </div>
            <div class="fl mb50 p20">
                <div id="pie_part" style="width:600px;height:400px;"></div>
            </div>
            <div class="fl mb50 ml20 p20">
                <div id="pie_call" style="width:600px;height:400px;"></div>
            </div>
            <div class="cb"></div>
        </div>
    </div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/unitalarm_detail.js"></script>
<script type="text/javascript" src="js/unitalarm_bar.js"></script>
<script type="text/javascript" src="js/unitalarm_pie_call.js"></script>
<script type="text/javascript" src="js/unitalarm_pie_part.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>