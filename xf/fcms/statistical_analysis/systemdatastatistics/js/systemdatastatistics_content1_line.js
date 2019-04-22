$(document).ready(function(){  
                var chart = document.getElementById("line");  
                var echart = echarts.init(chart);  
                var option = {  
                    title: {  
                        text: '系统CV指数',
                        textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',}
                    },  
                    tooltip : {  
                        trigger: 'axis'  
                    },  
                    legend: {  
                        data:[ ]  
                    },
                    grid: {  
                 
                          
//                         left: '50%',  
//                         right: '50%',  
//                         bottom: '50%',  
//                         containLabel: true  
                    },  
                    xAxis : [  
                        {  
                            type : 'category',  
                            boundaryGap : false,  
                            data : ['12-10' ,'12-11' ,'12-12' ,'12-13' ,'12-14' ,'12-15' ,'12-16'],
                          
                          }  
                    ],  
                    yAxis : [  
                        {  
                            type : 'value'  
                        }  
                    ],  
                    series : [  
                        {  
                            name:'10号',  
                            type:'line',  
                            stack: '销量',  
                            itemStyle: {normal: {areaStyle: {type: 'default'}}}, 
                            data:['20','20','20','20','20','20']  
                        }
                       
                    ]  
                };  
                  
                echart.setOption(option);    
  
            });  