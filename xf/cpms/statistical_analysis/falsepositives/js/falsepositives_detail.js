 
$("#btn_week").bind("click",function(){
	var type="week";
	search1(type);
	search2(type);
	search3(type);
})
$("#btn_month").bind("click",function(){
	var type="month";
	search1(type);
	search2(type);
	search3(type);
})
$("#btn_near").bind("click",function(){
	var type="week";
	search1(type);
	search2(type);
	search3(type);
})

search1("week");
function search1(type){
    var params={uri:"misinformation/all_systems",type:type};
    var url=rootPath+"/com/base/InterfaceGettypeAction.php";
    $.post(url,params,function(responseText){
   // $("#detail").parent().after(responseText);
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
       		        text: '所有系统误报统计',
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

search2("week");
function search2(type){
 	
    var params={uri:"misinformation/brand_systems",type:type};
    var url=rootPath+"/com/base/InterfaceGettypeAction.php";
    
    
    $.post(url,params,function(responseText){
  //  $("#detail").parent().after(responseText);
    
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
        text: '不同品牌系统误报统计',
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
 

search3("week");
function search3(type){
    var params={uri:"misinformation/classify_systems",type:type};
    var url=rootPath+"/com/base/InterfaceGettypeAction.php";
    $.post(url,params,function(responseText){
   // $("#detail").parent().after(responseText);
    
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
		           text: '分类系统系统误报统计',
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
 

search4("week");
function search4(type){                      //查询
	var params={uri:"misinformation",type:type};
	var url=rootPath+"/com/base/InterfaceGettypeAction.php";
	$.post(url,params,function(responseText){	
	 	////$("#tbody_content").parent().after(responseText); 
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align='center'>";                                                                                           
                                                                
				content+="<td>"+ClearTrim(data[j]["depName"])+"</td>";  
				content+="<td>"+fnChangeName(data[j]["acceptedTypeCode"],acceptedTypeCode_jsarry)+"</td>"; //中心级别
				content+="<td>"+timeFormat(data[j]["acceptTime"])+"</td>";  
				content+="<td>"+data[j]["description"]+"</td>";
				content+="<td>"+data[j]["acceptUser"]+"</td>";   
 				//select信息列表显示
 	
				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn-primary\" href=\"falsepositiveslist_detail.php?id="+id+"\"></a>";
				content+="</td>"; 
				content+="</tr>"; 
				
		 	   }
		    if(data.length==0){
		    	content+="<tr>";                                                                                           
				content+="<td colspan=6 align='center'>";  
				content+="没有查询到数据"; 
				content+="</td>"; 
				content+="</tr>";
		    	
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="<tr>";                                                                                           
			content+="<td colspan=6 align='center'>";  
			content+="错误码："+code+message; 
			content+="</td>"; 
			content+="</tr>";
	    }	
	     $("#tbody_content").empty().append(content);               //
 })
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
	h = date.getHours() + ':';
	m = date.getMinutes() + ':';
	s = date.getSeconds(); 
	return Y+M+D+h+m+s;
	
	}  