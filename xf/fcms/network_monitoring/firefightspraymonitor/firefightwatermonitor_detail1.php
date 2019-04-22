
 
<?php include '../../../authen/include/page/top.php';?>
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
        <script>
            var bgColor = '#E3F7FF';
            var containers = document.getElementsByClassName('chart');
            var options = [
               {
                series: [{
                	name: '水源名字',
                    type: 'liquidFill',
                    data: [0.6, 0.5, 0.4, 0.3],
                    radius: '70%',
                    outline: {
                        show: false
                    }
                }]
            }];
            var charts = [];
            for (var i = 0; i < options.length; ++i) {
                var chart = echarts.init(containers[i]);

                if (i > 0) {
                    options[i].series[0].silent = true;
                }
                chart.setOption(options[i]);
                chart.setOption({
                    baseOption: options[i],
                    media: [{
                        query: {
                            maxWidth: 300
                        },
                        option: {
                            series: [{
                                label: {
                                    normal: {
                                        textStyle: {
                                            fontSize: 26
                                        }
                                    }
                                }
                            }]
                        }
                    }]
                });
            }
        </script>
 </div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/electricfiremonitor_detail1.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

  