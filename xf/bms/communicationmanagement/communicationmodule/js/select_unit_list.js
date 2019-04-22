//搜索
 $("#btn_search").bind("click", function(){
	 search();
 })
 //列表数据==================================================
search();
function search(){
	//var params={uri:"owner_departments"};
	//var params={uri:"owner_departments?params={'pageSize':'1','currentPage':'5'}"};
	var params={uri:"owner_departments"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#tbody_content").parent().after(responseText);
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align=\'center\' onclick=\"selectFun('"+id+"','"+data[j]["name"]+"')\">";                                                                                                                                                        
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+fnChangeName(data[j]["orgTypeCode"],orgTypeCode_jsarry)+"</td>";
				content+="<td>"+data[j]["areaId"]+"</td>"; 

				content+="</tr>"; 
				
		 	   }
		    if(data.length==0){
		    	content+="<tr>";                                                                                           
				content+="<td colspan=3 align='center'>";  
				content+="没有查询到数据"; 
				content+="</td>"; 
				content+="</tr>";
		    	
		    }

	    }else{
	    	var message=resultobj.message; 
	    	content+="<tr>";                                                                                           
			content+="<td colspan=3 align='center'>";  
			content+="错误码："+code+message; 
			content+="</td>"; 
			content+="</tr>";
	    }	
	     $("#tbody_content").empty().append(content);  //列表注入位置
 })
}

function selectFun(id,title){

	//$("#depId",window.parent.document).empty().append("<option value=\""+id+"\">"+title+"</option>");
	
	$("#depId",window.parent.document).attr("depIdValue",id)
	$("#depId",window.parent.document).val(title);


	window.parent.SelectDataHideDiv("depId");
	
	return false;
	
}