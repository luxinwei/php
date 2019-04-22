$(document).ready(function(){  
     var chart = document.getElementById("pie_part");  
     var echart = echarts.init(chart);  
     var idx =1;
      
     var  option = {
    		    timeline : {
    		        data : [
    		            '2017-01-01',
    		            { name:'2017-06-01', symbol:'emptyStar6', symbolSize:8 },
    		            
    		            { name:'2017-12-01', symbol:'star6', symbolSize:8 }
    		        ],
    		        label : {
    		            formatter : function(s) {
    		                return s.slice(0, 7);
    		            }
    		        }
    		    },
    		    options : [
    		        {
    		            title : {
    		                text: '单位类型',
							textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',}
    		            },
    		            tooltip : {
    		                trigger: 'item',
    		                formatter: "{a} <br/>{b} : {c} ({d}%)"
    		            },

    		            series : [
    		                {
    		                    name:'浏览器（数据纯属虚构）',
    		                    type:'pie',
    		                    center: ['50%', '45%'],
    		                    radius: '50%',
    		                    data:[
    		                        {value: idx * 128 + 80,  name:'特级单位'},
    		                        {value: idx * 64  + 160,  name:'一级单位'},
    		                        {value: idx * 32  + 320,  name:'二级单位'},
    		                        {value: idx * 16  + 640,  name:'三级单位'},
    		                        {value: idx++ * 8  + 1280, name:'四级单位'}
    		                    ]
    		                }
    		            ]
    		        },
    		        {
    		            series : [
    		                {
    		                    name:'浏览器（数据纯属虚构）',
    		                    type:'pie',
    		                    data:[
    		                        {value: idx * 128 + 80,  name:'特级单位'},
    		                        {value: idx * 64  + 160,  name:'一级单位'},
    		                        {value: idx * 32  + 320,  name:'二级单位'},
    		                        {value: idx * 16  + 640,  name:'三级单位'},
    		                        {value: idx++ * 8  + 1280, name:'四级单位'}
    		                    ]
    		                }
    		            ]
    		        },

    		        {
    		            series : [
    		                {
    		                    name:'浏览器（数据纯属虚构）',
    		                    type:'pie',
    		                    data:[
    		                        {value: idx * 128 + 80,  name:'特级单位'},
    		                        {value: idx * 64  + 160,  name:'一级单位'},
    		                        {value: idx * 32  + 320,  name:'二级单位'},
    		                        {value: idx * 16  + 640,  name:'三级单位'},
    		                        {value: idx++ * 8  + 1280, name:'四级单位'}
    		                    ]
    		                }
    		            ]
    		        }
    		    ]
    		};
                      
       
     echart.setOption(option);    

 });  

