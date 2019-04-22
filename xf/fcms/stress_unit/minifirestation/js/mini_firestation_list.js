 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=mini_fire_stations";
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
	
	 // var resultobj=eval("("+responseText+")");
	 var success=resultobj.success; 
     var code=resultobj.code; 
     var content="";   
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
    		content+="<tr align='center'>";                                                                                                                                                      
			content+="<td>"+data[j]["name"]+"</td>";  
			content+="<td>"+data[j]["depName"]+"</td>";
			content+="<td>"+data[j]["code"]+"</td>";   
			content+="<td>"+data[j]["address"]+"</td>";             
			content+="<td>"+data[j]["chargePerson"]+"</td>";             
			content+="<td>"+data[j]["phone"]+"</td>";             
			content+="<td>"+data[j]["dutyPhone"]+"</td>";             

			content+="<td class=\"tc\">";   
			content+="<a class=\"hmui-btn-primary\" href=\"mini_firestation_detail.php?id="+id+"\"></a>";
			content+="</td>"; 
			content+="</tr>"; 
			
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
	return content;  
	
}

//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=mini_fire_stations";
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
	
	 // var resultobj=eval("("+responseText+")");
	  var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align='center'>";                                                                                                                                                      
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+data[j]["depName"]+"</td>";
				content+="<td>"+data[j]["code"]+"</td>";   
				content+="<td>"+data[j]["address"]+"</td>";             
				content+="<td>"+data[j]["chargePerson"]+"</td>";             
				content+="<td>"+data[j]["phone"]+"</td>";             
				content+="<td>"+data[j]["dutyPhone"]+"</td>";             
	
				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn-primary\" href=\"mini_firestation_detail.php?id="+id+"\"></a>";
				content+="</td>"; 
				content+="</tr>"; 
				
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
	return content;  
	
}