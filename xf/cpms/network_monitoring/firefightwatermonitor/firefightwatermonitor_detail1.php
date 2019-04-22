<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");
$name=Fun::request("name");
?>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
 <div>
  	     <style>
            .chart {
                width: 25%;
                height: 300px;
                float: left;
            }
            body{background:transparent}
        </style>
            <div class="chart"></div>
 </div>
 <div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>  
 <script type="text/javascript">
 
var Id="<?php  echo $partId?>"
var name="<?php  echo $name?>"
 
</script>        
<script type="text/javascript" src="js/firefightwatermonitor_detail1.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

  