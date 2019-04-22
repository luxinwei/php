 
search1();
function search1(){
    var params={uri:"off_line/all_systems"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
  //$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var data = resultobj["data"];
        var datax="";
        var datay="";	
        
        for(var key in data){ 
      
           if(datax!="")datax+=",";
           if(datay!="")datay+=",";
           datax+=key;
           datay+=data[key];
           
        }  
        datax=datax.split(",");
        datay=datay.split(",");
    
        var chart = document.getElementById("bar");  
        var echart = echarts.init(chart);  
        var  option = {
       		    title : {
       		        text: '所有系统离线统计',
   					textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',},
       		    },
       		    tooltip : {
       		        trigger: 'axis'
       		    },
       		    calculable : true,
       		    xAxis : [
       		        {
       		            type : 'category',
       		            data :datax
       		        }
       		    ],
       		    yAxis : [
       		        {
       		            type : 'value'
       		        }
       		    ],
       		    series : [
       		        {
       		            name:'数量',
       		            type:'bar',
       		            data:datay,
       		            markPoint : {
       		                data : [
       		                    {type : 'max', name: '最大值'},
       		                    {type : 'min', name: '最小值'}
       		                ]
       		            },   
       		        }
       		    
       		    ]
       		}; 
        echart.setOption(option);           
    }) 
}

search2();
function search2(type){
 	
    var params={uri:"off_line/brand_systems"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    
    
    $.post(url,params,function(responseText){
   //$("#tbody_content").parent().after(responseText);
    
    var resultobj=eval("("+responseText+")");
     var data = resultobj["data"];
     var datax="";
     for(var key in data){ 
   
        if(datax!="")datax+=",";
         datax+=key; 
     }  
     datax=datax.split(",");
     var arrays = new Array();
      i=0;
     for(var key in data){ 
         arrays[i] = {
             value:1,
             name:key
         }
         i++;
     }
     var chart = document.getElementById("pie_part");  
     var echart = echarts.init(chart);  
     var option = {
    title : {
        text: '不同品牌系统离线统计',
        textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',},
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:datax
    },

           

    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:arrays
                
        }
    ]
};
                      
       
     echart.setOption(option);      
         
    }) 
}
 

search3();
function search3(){
    var params={uri:"off_line/classify_systems"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
    //$("#tbody_content").parent().after(responseText);
    
       	var resultobj=eval("("+responseText+")");
        var data = resultobj["data"];
        var arrays = new Array();
        var datax="";
        for(var key in data){ 
      
           if(datax!="")datax+=",";
            datax+=key; 
        }  
        datax=datax.split(",");
        i=0;
        for(var key in data){ 
            arrays[i] = {
                value:1,
                name:key
            }
            i++;
        }
        var chart = document.getElementById("pie_call");                      
        var echart = echarts.init(chart);  
        var option = {
		       title : {
		           text: '分类系统系统离线统计',
		           textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',},
		           x:'center'
		       },
		       tooltip : {
		           trigger: 'item',
		           formatter: "{a} <br/>{b} : {c} ({d}%)"
		       },
		       legend: {
		           orient : 'vertical',
		           x : 'left',
		           data:datax
		       },
		
		              
		
		       calculable : true,
		       series : [
		           {
		               name:'访问来源',
		               type:'pie',
		               radius : '55%',
		               center: ['50%', '60%'],
		               data:arrays
		                   
		           }
		           ]
        };
                         
          
       echart.setOption(option);       
    }) 
}
 
 