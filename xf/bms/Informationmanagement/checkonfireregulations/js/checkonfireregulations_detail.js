$("#btn_history").bind("click", function(){window.location.href="checkonfireregulations_list.php?";});
$("#btn_update").bind("click", function(){window.location.href="checkonfireregulations_update.php?id="+id;});

initDetail();
function initDetail(){
	var params={uri:"fire_codes/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#statutename").html(resultobj["data"]["name"]);
	    	 $("#fireLawCode").html(fnChangeName(resultobj["data"]["fireLawCode"],fireLawCode_jsarry));
	    	 $("#promulgateOffice").html(resultobj["data"]["promulgateOffice"]);
	    	 $("#approveOffice").html(resultobj["data"]["approveOffice"]);
	    	 $("#promulgateNo").html(resultobj["data"]["promulgateNo"]);
	    	 $("#promulgateDate").html(timeFormat(resultobj["data"]["promulgateDate"]));
	    	 $("#implementDate").html(timeFormat(resultobj["data"]["implementDate"]));
	    	 $("#createUser").html(resultobj["data"]["createUser"]);	    
	    	 $("#content").html(resultobj["data"]["content"]);	    
	   }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
     })
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';

	return Y+M+D;
	
	} 