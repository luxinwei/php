


 
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params="";
	if(params!="")params+="&";
	params+="uri=system_menus";
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
 ////$("#pageNav").parent().after(JSON.stringify(resultobj));
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
    		content+="<td align='center'>";                                                  
    		content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
    		content+="</td>"; 
			content+="<td>"+data[j]["name"]+"</td>";  
			content+="<td>"+data[j]["level"]+"</td>";  
			content+="<td>"+data[j]["createTime"]+"</td>";  
			content+="<td>"+data[j]["appCode"]+"</td>";                                        
			content+="<td class=\"tc\">";   
			content+="";
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
 
 