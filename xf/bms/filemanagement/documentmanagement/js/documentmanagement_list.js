//数据操作=============================================================================================================================

search();
function search(){                          //查询
	var params={uri:"files",type:"1"};
	var url=rootPath+"/com/base/InterfacedocumentGetAction.php";
	$.post(url,params,function(responseText){	
		// $("#tbody_content").parent().after(responseText);
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 
	    		 var id=data[j]["id"];
	    		content+="<tr align='center'>";                                                                                           
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
				content+="</td>"; 
			
				content+="<td>"+data[j]["description"]+"</td>";  
				content+="<td>"+data[j]["filePath"]+"</td>";    
				content+="<td>"+data[j]["name"]+"</td>"; 
				//content+="<td>"+data[j]["type"]+"</td>"; 
				content+="</tr>"; 
		 	   }
		    if(data.length==0){
		    	content+="<tr>";                                                                                           
				content+="<td colspan=4 align='center'>";  
				content+="没有查询到数据"; 
				content+="</td>"; 
				content+="</tr>";
		    	
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="<tr>";                                                                                           
			content+="<td colspan=4 align='center'>";  
			content+="错误码："+code+message; 
			content+="</td>"; 
			content+="</tr>";
	    }	
	     $("#tbody_content").empty().append(content);               //
 })
}