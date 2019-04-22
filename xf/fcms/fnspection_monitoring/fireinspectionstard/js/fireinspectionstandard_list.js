$("#btn_build").bind("click", function(){window.location.href="traintaskmanagement_build.php?"});

//数据操作=============================================================================================================================
search();
function search(){                          //查询
	var params={uri:"patrol_standards"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#tbody_content").parent().after(responseText); 
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
//	    		content+="<tr align='center'>";                                                                                           
//				content+="<td align='center'>";                                                  
//				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
//				content+="</td>";                                                                
//				content+="<td>"+data[j]["name"]+"</td>";  
//				//content+="<td>"+fnChangeName(data[j]["areaId"],area_jsarry)+"</td>"; 
//				content+="<td>"+data[j]["telephone"]+"</td>";
//				content+="<td>"+data[j]["chargePerson"]+"</td>";   
//				content+="<td>"+data[j]["chargePhone"]+"</td>";             
//				//select信息列表显示
//				content+="<td>"+fnChangeName(data[j]["monitorCenterRankCode"],monitorCenterRankCode_jsarry)+"</td>"; //中心级别
//				content+="<td>"+fnChangeName(data[j]["pauseFlag"],state_jsarray)+"</td>";
//	
//				content+="<td class=\"tc\">";   
//				content+="<a class=\"hmui-btn hmui-btn-primary\" href=\"monitorcenter_detail.php?id="+id+"\">详情</a>";
//				content+="</td>"; 
//				content+="</tr>"; 
				
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
	     $("#tbody_content").empty().append(content);               //
 })
}
 