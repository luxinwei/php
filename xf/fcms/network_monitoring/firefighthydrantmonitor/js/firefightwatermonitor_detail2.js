
            $(document).ready(function(){  
            	var timeTicket;
                var chart = document.getElementById("chart");  
                var echart = echarts.init(chart);  
                var option = {
                	    tooltip : {
                	        formatter: "{a} <br/>{b} : {c}%"
                	    },
                	   
                	    series : [
                	        {
                	            name:'业务指标',
                	            type:'gauge',
                	            startAngle: 180,
                	            endAngle: 0,
                	            center : ['50%', '100%'],    // 默认全局居中
                	            radius : 100,          //仪表盘大小
                	            axisLine: {            // 坐标轴线
                	                lineStyle: {       // 属性lineStyle控制线条样式
                	                    width: 60        //指针基座大小值越大越小
                	                }
                	            },
                	            axisTick: {            // 坐标轴小标记
                	                splitNumber: 10,   // 每份split细分多少段
                	                length :12,        // 属性length控制线长
                	            },
                	            axisLabel: {           // 坐标轴文本标签，详见axis.axisLabel
                	                formatter: function(v){
                	                    switch (v+''){
                	                        case '10': return '低';
                	                        case '50': return '中';
                	                        case '90': return '高';
                	                        default: return '';
                	                    }
                	                },
                	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                    color: '#fff',
                	                    fontSize: 11,
                	                    fontWeight: 'bolder'
                	                }
                	            },
                	            pointer: {
                	                width:10,           //指针大小
                	                length: '90%',
                	                color: 'rgba(255, 255, 255, 0.8)'
                	            },
                	            title : {
                	                show : true,
                	                offsetCenter: [0, '-60%'],       // x, y，单位px
                	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                    color: '#fff',
                	                    fontSize: 12     //完成率  提示文字大小
                	                }
                	            },
                	            detail : {
                	                show : true,
                	                backgroundColor: 'rgba(0,0,0,0)',
                	                borderWidth: 0,
                	                borderColor: '#ccc',
                	                width: 50,
                	                height: 40,
                	                offsetCenter: [0, -40],       // x, y，单位px
                	                formatter:'{value}%',
                	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                    fontSize : 30    //完成率数字大小
                	                }
                	            },
                	            data:[{value: 50, name: '完成率'}]
                	        }
                	    ]
                	};
                	clearInterval(timeTicket);
                	timeTicket = setInterval(function (){
                	    option.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
                	    echart.setOption(option,true);
                	    window.onresize = echart.resize;
                	},2000);
            });  
                	$("#btn_history").bind("click", function(){window.location.href="firefightwatermonitor_list.php" });
