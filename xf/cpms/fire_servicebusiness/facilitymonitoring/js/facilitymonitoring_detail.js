 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="facilitymonitoring_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="facilitymonitoring_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"test_managements/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#deviceId").html(resultobj["data"]["deviceId"]);
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#department").html(resultobj["data"]["department"]);
	    	 $("#period").html(resultobj["data"]["period"]);
	    	 
			 	var testTime=timeFormat
(resultobj["data"]["testTime"]);
			 	testTime=testTime.substring(0,10);
 	    	 $("#testTime").html(testTime);
	    	 $("#director").html(resultobj["data"]["director"]);
	    	 $("#result").html(resultobj["data"]["result"]);
			  
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}
function timeFormat(t) {   

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}
