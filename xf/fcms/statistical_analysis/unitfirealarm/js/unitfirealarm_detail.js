 $(document).ready(function(){  
     var chart = document.getElementById("pie");  
     var echart = echarts.init(chart);  
     var option = {
		 title : {
			 text: '火警统计趋势分析',
			 textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',}
			 },
    		    tooltip : {
    		        trigger: 'item',
    		        formatter: "{a} <br/>{b} : {c} ({d}%)"
    		    },

    		    calculable : true,
    		    series : [
    		        {
    		            name:'访问来源',
    		            type:'pie',
    		            radius : ['50%', '70%'],
    		            itemStyle : {
    		                normal : {
    		                    label : {
    		                        show : false
    		                    },
    		                    labelLine : {
    		                        show : false
    		                    }
    		                },
    		                emphasis : {
    		                    label : {
    		                        show : true,
    		                        position : 'center',
    		                        textStyle : {
    		                            fontSize : '30',
    		                            fontWeight : 'bold'
    		                        }
    		                    }
    		                }
    		            },
    		            data:[
    		                {value:335, name:'上周'},
    		                {value:310, name:'本周'},
    		                {value:234, name:'上周'},
    		                {value:135, name:'上周'},
    		                {value:1548, name:'上周'}
    		            ]
    		        }
    		    ]
    		};
    		                         
     echart.setOption(option);    

 });  

