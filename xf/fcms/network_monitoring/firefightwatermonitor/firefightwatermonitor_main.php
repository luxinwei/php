<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");
$names=Fun::request("names");
 
?>

<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

             <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
              <ul class="layui-tab-title">
                <li class="layui-this">水位</li>
                <li>水压</li>
              </ul>
            <div class="layui-tab-content " style="width:100%;background:#FFFFFF;" id="c_content">
              	 <div class="layui-tab-item layui-show" ><iframe frameborder=0 style="width:100%;min-height:500px;" src="firefightwatermonitor_detail1.php?partId=<?php echo $partId;?>&name=<?php echo $names;?>"></iframe></div>
                <div class="layui-tab-item" ><iframe frameborder=0 style="width:100%;min-height:500px;" src="firefightwatermonitor_detail2.php?partId=<?php echo $partId?>&name=<?php echo $name;?>"></iframe></div>
              </div>
            </div>

<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
