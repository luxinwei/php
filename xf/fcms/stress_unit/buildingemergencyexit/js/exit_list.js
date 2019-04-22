 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=building_emergency_exits";
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
	// $("#pageNav").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	  var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align=\'center\'>";                                                                                                                                                        
				content+="<td>"+data[j]["buildingName"]+"</td>";  
				content+="<td>"+data[j]["position"]+"</td>"; 
				content+="<td>"+data[j]["modality"]+"</td>";                        
				content+="<td>"+data[j]["depName"]+"</td>";
				 content+="<td>"+"</td>";
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
