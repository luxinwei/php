
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
                	                  name:'水压值',
                	                  type:'gauge',
                	                  splitNumber: 10,       // 分割段数，默认为5
                	                  axisLine: {            // 坐标轴线
                	                      lineStyle: {       // 属性lineStyle控制线条样式
                	                          color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                	                          width: 10
                	                      }
                	                  },
                	                  axisTick: {            // 坐标轴小标记
                	                      splitNumber: 10,   // 每份split细分多少段
                	                      length :12,        // 属性length控制线长
                	                      lineStyle: {       // 属性lineStyle控制线条样式
                	                          color: 'auto'
                	                      }
                	                  },
                	                  axisLabel: {           // 坐标轴文本标签，详见axis.axisLabel
                	                      textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                          color: 'auto'
                	                      }
                	                  },
                	                  splitLine: {           // 分隔线
                	                      show: true,        // 默认显示，属性show控制显示与否
                	                      length :30,         // 属性length控制线长
                	                      lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                	                          color: 'auto'
                	                      }
                	                  },
                	                  pointer : {
                	                      width : 5
                	                  },
                	                  title : {
                	                      show : true,
                	                      offsetCenter: [0, '-40%'],       // x, y，单位px
                	                      textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                          fontWeight: 'bolder'
                	                      }
                	                  },
                	                  detail : {
                	                      formatter:'{value}%',
                	                      textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                	                          color: 'auto',
                	                          fontWeight: 'bolder'
                	                      }
                	                  },
                	                  data:[{value: 50, name: '水压'}]
                	              }
                	          ]
                	      
                	};
                	clearInterval();
                	function clearInterval(){
                		 var params={uri:"water_sources/geValue/"+Id};
                	     var url=rootPath+"/com/base/InterfaceGetAction.php";
                	     $.post(url,params,function(responseText){	
                	                 	//$("#detail").parent().after(responseText);  
                	                 	var resultobj = eval("(" + responseText + ")");
                	                 	var p= resultobj["data"]["pressure"];  
                               	     if(p==null){
                            	    	 p="0";
                            	     }
                	                 	option.series[0].data[0].value =p;
                                	    echart.setOption(option,true);
                                	    window.onresize = echart.resize;
                	     });
                	    
                	}
            });  
                	$("#btn_history").bind("click", function(){window.location.href="firefightwatermonitor_list.php" });
