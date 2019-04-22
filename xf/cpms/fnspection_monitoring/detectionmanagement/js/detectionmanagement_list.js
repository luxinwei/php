$("#btn_build").bind("click", function(){window.location.href="traintaskmanagement_build.php?"});

//数据操作=============================================================================================================================
 
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=patrol_task_records";
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
	  //$("#pageNav").parent().after(JSON.stringify(resultobj));	 // var resultobj=eval("("+responseText+")"); 	                                                                
	  var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align='center'>";                                                                                                                                                           
				content+="<td>"+data[j]["taskName"]+"</td>";  
			 	var beginTime=timeFormat
(data[j]["beginTime"]);
				var endTime=timeFormat
(data[j]["endTime"]);
				beginTime=beginTime.substring(0,10);
				endTime=endTime.substring(0,10);
				content+="<td>"+beginTime+"</td>";    
				content+="<td>"+endTime+"</td>";
				var a = parseInt(data[j]["pointCount"]);
				var b = parseInt(data[j]["patrolledCount"]);
				var c=b/a*100+"%";
				content+="<td>"+c+"</td>";
				content+="<td>"+fnChangeName(data[j]["state"],state_jsarray)+"</td>";
 				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn-primary\" href=\"detectionmanagement_detail.php?id="+id+"\"></a>";
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

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}
