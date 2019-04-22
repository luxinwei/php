$("#btn_build").bind("click", function(){window.location.href="patroltaskmanagement_build.php?"});

//数据操作=============================================================================================================================
search();
function search(){                          //查询
	var params={uri:"patrol_tasks"};
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
	    		content+="<tr align='center'>";                                                                                           
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
				content+="</td>";                                                                
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+data[j]["areaId"]+"</td>";  
				content+="<td>"+data[j]["telephone"]+"</td>";
				content+="<td>"+data[j]["chargePerson"]+"</td>";   
				content+="<td>"+data[j]["chargePhone"]+"</td>";             
				//select信息列表显示
				content+="<td>"+fnChangeName(data[j]["monitorCenterRankCode"],monitorCenterRankCode_jsarry)+"</td>"; //中心级别
				content+="<td>"+fnChangeName(data[j]["pauseFlag"],state_jsarray)+"</td>";
	
				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn-primary\" href=\"monitorcenter_detail.php?id="+id+"\"></a>";
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
	     $("#tbody_content").empty().append(content);               //
})
}
//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){ 
	var tourl="monitorcenter_add.php";  
	window.location.href=tourl;
});
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="monitorcenter_update.php?id="+key;	 	 
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row!=1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"monitor_centers/"+id};
		var url=rootPath+"/com/base/InterfaceDeleteAction.php";
		$.post(url,params,function(responseText){
		     var resultobj=eval("("+responseText+")"); 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		   
		     if(success){
		           alert("成功！");
		           search();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }	     
	    })    	    
});
//导出数据=========================================
$("#btn_xls").bind("click", function(){
		var params=decodeURI($("#myform").serialize());
		var tourl="monitorcenter_xls.php?"+params;
		window.open(tourl);
});
//搜索功能=============================================================
$("#btn_search").bind("click", function(){
	var  keyname=$("#keyname").val();
	var  state=$("#state").val();
	alert(keyname);
	alert(state);
	var params={uri:"monitor_centers",name:keyname,state:state};
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
	    		content+="<tr align='center'>";                                                                                           
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
				content+="</td>";                                                                
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+data[j]["address"]+"</td>";    
				content+="<td>"+data[j]["telephone"]+"</td>";
				content+="<td>"+data[j]["chargePerson"]+"</td>";   
				content+="<td>"+data[j]["chargePhone"]+"</td>";             
				content+="<td>"+data[j]["monitorCenterRankCode"]+"</td>";             
				content+="<td></td>";   
				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn hmui-btn-primary\" href=\"monitorcenter_detail.php?id="+id+"\">详情</a>";
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
	     $("#tbody_content").empty().append(content);               //
})
})
//=====================================================================
