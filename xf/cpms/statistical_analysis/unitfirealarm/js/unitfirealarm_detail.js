 $(document).ready(function(){  
	 $("#btn_week").bind("click",function(){
		 	var type="week";
		 	search4(type)
		 	search3(type);
		 })
		 $("#btn_month").bind("click",function(){
		 	var type="month";
		 	search4(type)
		 	search3(type);
		 })
		 $("#btn_near").bind("click",function(){
		 	var type="week";
		 	search4(type)
		 	search3(type);
		 })

	 search3("week");
	 function search3(type){
	     var params={uri:"unit_fire_alarm/fire_alarm_trend",type:type};
	     var url=rootPath+"/com/base/InterfaceGettypeAction.php";
	     $.post(url,params,function(responseText){
	    // $("#tbody_content").parent().after(responseText);
	     
	        	var resultobj=eval("("+responseText+")");
	         var data = resultobj["data"];
	         var arrays = new Array();
	         i=0;
	         for(var key in data){ 
	             arrays[i] = {
	                 value:data[key],
	                 name:key
	             }
	             i++;
	         }
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
		    		            data:arrays
		    		        }
		    		    ]
		    		};
		    		                         
		     echart.setOption(option);    

	     });  
	 }
});  
 search4("week");
 function search4(type){                      //查询
 	var params={uri:"unit_fire_alarm/list_fire_alarm",type:type};
 	var url=rootPath+"/com/base/InterfaceGettypeAction.php";
 	$.post(url,params,function(responseText){	
 		 $("#tbody_content").parent().after(responseText); 
 	     var resultobj=eval("("+responseText+")");
 	     var success=resultobj.success; 
 	     var code=resultobj.code; 
 	     var content="";   
 	     if(success){
 	    	 var data=resultobj.data;
 	    	 for(j=0;j<data.length;j++){ 
 	    		 var id=data[j]["id"];
 	    		/*content+="<tr align='center'>";                                                                                           
 				content+="<td align='center'>";                                                  
 				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
 				content+="</td>";                                                                
 				content+="<td>"+data[j]["name"]+"</td>";  
 				content+="<td>"+data[j]["areaId"]+"</td>";  
 				content+="<td>"+data[j]["telephone"]+"</td>";
 				content+="<td>"+data[j]["chargePerson"]+"</td>";   
 				content+="<td>"+data[j]["chargePhone"]+"</td>";             
 				//select信息列表显示
 				content+="<td>"+fnChangeName(data[j]["monitorCenterRankCode"],monitorCenterRankCode_jsarry)+"</td>"; //中心级别
 				content+="<td>"+fnChangeName(data[j]["pauseFlag"],state_jsarray)+"</td>";
 	
 				content+="<td class=\"tc\">";   
 				content+="<a class=\"hmui-btn-primary\" href=\"monitorcenter_detail.php?id="+id+"\"></a>";
 				content+="</td>"; 
 				content+="</tr>"; */
 				
 		 	   }
 		    if(data.length==0){
 		    	content+="<tr>";                                                                                           
 				content+="<td colspan=9 align='center'>";  
 				content+="没有查询到数据"; 
 				content+="</td>"; 
 				content+="</tr>";
 		    	
 		    }
 	    }else{
 	    	var message=resultobj.message; 
 	    	content+="<tr>";                                                                                           
 			content+="<td colspan=9 align='center'>";  
 			content+="错误码："+code+message; 
 			content+="</td>"; 
 			content+="</tr>";
 	    }	
 	     $("#tbody_content").empty().append(content);               //
  })
 }
  

 
 