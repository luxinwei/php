 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=important_parts";
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
     var online="";
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
    		content+="<tr align=\'center\'>";                                                                                                                                                        
			content+="<td>"+data[j]["name"]+"</td>"; 
			content+="<td>"+data[j]["buildingName"]+"</td>";                        
			content+="<td>"+fnChangeName(data[j]["buildingResistFireCode"],buildingResistFireCode_jsarry)+"</td>"; //中心级别
			content+="<td>"+data[j]["position"]+"</td>";                        
			content+="<td>"+fnChangeName(data[j]["buildingUseKindCode"],buildingUseKindCode_jsarry)+"</td>"; //中心级别
			content+="<td>"+fnChangeName(data[j]["fireproofSignCode"],fireproofSignCode_jsarry)+"</td>"; //中心级别
			content+="<td class=\"tc\">";
			content+="<a class=\"hmui-btn-primary\" href=\"key_parts_detail.php?id="+id+"\"></a>";
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

 