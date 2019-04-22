
search();
function search(){
	var params={uri:"dpi/monitor_centers"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
 	     var resultobj=eval('('+responseText+')'); 	  
	     var success=resultobj.success; 
	     
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	for(j=0;j<data.length;j++){ 
	    		 var key=data[j]["id"];
	    		content+="<tr>";                                                                                           
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" name=\"key\" value=\""+key+"\" />";           
				content+="</td>";                                                                
				content+="<td>"+data[j]["address"]+"</td>";  
				content+="<td>"+data[j]["areaId"]+"</td>";    
				content+="<td>"+data[j]["chargePersion"]+"</td>";
				content+="<td>"+data[j]["chargePhone"]+"</td>";   
				content+="<td>"+data[j]["description"]+"</td>";             
				content+="<td>"+data[j]["id"]+"</td>";             
				content+="<td>"+data[j]["level"]+"</td>";   
				content+="<td>"+data[j]["name"]+"</td>";   
				content+="<td>"+data[j]["position"]+"</td>";             
				content+="<td>"+data[j]["telephone"]+"</td>";             
				content+="</tr>"; 
				 $("#tbody_content").empty().append(content);  
		 	}
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }	     
 })
}
$("#btn_add").bind("click", function(){
	var tourl="jiankong_add.php";
	window.location.href=tourl;
});
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="jiankong_edit.php?key="+key
	window.location.href=tourl;
});
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row!=1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"dpi/monitor_centers/"+id};
		var url=rootPath+"/com/base/InterfaceGetAction.php";
		$.post(url,params,function(responseText){
		alert(responseText);
		     var resultobj=eval("("+responseText+")"); 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		   
		     if(success){
		    alert("成功！");
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }	     
	 })
    
});