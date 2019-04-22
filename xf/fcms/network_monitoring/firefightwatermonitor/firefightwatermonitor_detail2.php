<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");
$name=Fun::request("name");
 
?>
       <script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
        <script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
  <style>
        
            
        </style>
 <div>
 
            <div class="chart" id="chart" style="width: 500px;height:400px;"></div>
        
 </div>
<div id="detail"></div>
<?php include '../../../authen/include/page/bottom.php';?>    
 <script type="text/javascript">
 
var Id="<?php  echo $partId?>"
 
</script>       
<script type="text/javascript" src="js/firefightwatermonitor_detail2.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

  