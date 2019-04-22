$("#btn_history").bind("click", function(){window.location.href="key_parts_list.php?";});

search();
function search(){
	var params={uri:"fire_fighting_devices"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//////$("#tbody_content").parent().after(responseText);
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     alert(success);
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align=\'center\'>";                                                                                                                                                        
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+data[j]["impPartId"]+"</td>"; 
				content+="<td>"+data[j]["deviceType"]+"</td>";                        
				content+="<td>"+data[j]["serviceTime"]+"</td>";  
				content+="<td>"+fnChangeName(data[j]["serviceStateCode"],serviceStateCode_jsarry)+"</td>"; //中心级别
				content+="<td>"+fnChangeName(data[j]["runStateCode"],runStateCode_jsarry)+"</td>"; //中心级别                               
				content+="<a class=\"hmui-btn hmui-btn-primary\" href=\"key_parts_picl_detail.php?id="+id+"\">详情</a>";           
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
	     $("#tbody_content").empty().append(content);  //列表注入位置
 })
}
 