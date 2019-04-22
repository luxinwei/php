if(partId!=""){
  		search();
}
  
 
function search(){
	
  
	var params="uri=pointType/listEvent/"+partId;
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
	//$("#pageNav").parent().after(JSON.stringify(resultobj));	   
	var success=resultobj.success; 
    var code=resultobj.code; 
    var data=resultobj.data; 
    var content="";   
    var online="";
    if(success){
 	    	if(data!=null){
 			   	 for(j=0;j<data.length;j++){ 
		   		 var id=data[j]["id"];
		   		 	content+="<tr align=\'center\'>"; 
					content+="<td>"+timeFormat(data[j]["time"])+"</td>";  
					content+="<td>"+data[j]["type"]+"</td>"; 
					content+="<td>"+data[j]["content"]+"</td>";                      
					content+="<td>"+fnChangeName(data[j]["state"],result_jsarray)+"</td>";
					content+="<td class=\"tc\">";   
					content+="<a class=\"hmui-btn-primary\" href=\"electricfiremonitor_detail9.php?id="+id+"&partId="+partId+"\"></a>";
					content+="</td>";
					content+="</tr>"; 
			 	   }
	    	
	    	}else{
	    		 $("#tishi").css('display','block');	    	
	    	}
     }else{
	  
    	 var message=resultobj.message; 
   		content+="<tr>";                                                                                           
		content+="<td colspan=5 align='center'>";  
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
