 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params="";
	var acceptedTypeCode = $("#acceptedTypeCode").val();
 
	 
	if(acceptedTypeCode!=""){
		params=params+"&acceptedTypeCode="+acceptedTypeCode;
	}
	 
 
	if(params!="")params+="&";
	params+="uri=fire_alarm_accepts";
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	gridpage({url:url
				,param:params			                                                
				,bodyid:"tbody_content"                                                        
				,pagenavid:"pageNav"                                                            
				,single:false  
				,showType:1
				,length:10
				,store:processData                                                                                 
	});         
}
function processData(resultobj){
	   $("#pageNav").parent().after(JSON.stringify(resultobj));	
	 // var resultobj=eval("("+responseText+")");
	 var success=resultobj.success; 
     var code=resultobj.code; 
     var content="";   
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
    		content+="<tr align='center'>";                                                                                                                                                          
 			var firstAlarmTime=timeFormat(data[j]["firstAlarmTime"]);
 			content+="<td>"+firstAlarmTime+"</td>";
 			
 			var acceptTime=""
 			var acceptTime=data[j]["acceptTime"];
  			if(acceptTime!=undefined){
 				acceptTime=timeFormat(acceptTime);
 			}else{
 				acceptTime="";
 			}
 			content+="<td>"+acceptTime+"</td>";
			
 			var acceptEndTime=""
 	 			var acceptEndTime=data[j]["acceptEndTime"];
  	 			if(acceptEndTime!=undefined){
 	 				acceptEndTime=timeFormat(acceptEndTime);
 	 			}else{
 	 				acceptEndTime="";
 	 			}
  			content+="<td>"+acceptEndTime+"</td>"; 
 			
 			
			content+="<td>"+fnChangeName(data[j]["acceptedTypeCode"],acceptedTypeCode_jsarry)+"</td>";
			content+="<td>"+data[j]["description"]+"</td>";
			content+="<td class=\"tc\">";   
			content+="<a class=\"hmui-btn-primary\" href=\"firealarmaccept_detail.php?id="+id+"\"></a>";
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
	return content;  
	
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