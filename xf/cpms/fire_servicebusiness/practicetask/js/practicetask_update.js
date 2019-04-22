 

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="practicetask_detail.php?id="+id;});

 //获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"practice_tasks/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//   //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 
				var beginTime=timeFormat
(resultobj["data"]["beginTime"]);
				var endTime=timeFormat
(resultobj["data"]["endTime"]);
				beginTime=beginTime.substring(0,10);
				endTime=endTime.substring(0,10);
			    $("#beginTime").val(beginTime);
			    $("#endTime").val(endTime);
			    $("#beginTime").attr("beginTimeValue",resultobj["data"]["beginTime"]);
			    $("#endTime").attr("endTimeValue",resultobj["data"]["endTime"]);
			    
		    	 $("#practiceRequirements").val(resultobj["data"]["practiceRequirements"]);
		    	 $("#practiceContent").val(resultobj["data"]["practiceContent"]);
		    	 $("#depId").val(resultobj["data"]["depName"]);
		    	 $("#depId").attr("depIdValue",resultobj["data"]["depName"]);
		    	 $("#practicetaskname").val(resultobj["data"]["name"]);
		    	 $("#taskStateCode").find("option[value='"+resultobj["data"]["taskStateCode"]+"']").attr("selected",true);
		    	 $("#result").val(fnChangeName(resultobj["dat"]["result"],result_jsarry));
		    	 $("#overtimeFlag").val(fnChangeName(resultobj["data"]["overtimeFlag"],overtimeFlag_jsarray));
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
})
}



//修改信息==========================================
$("#btn_save").bind("click", function(){
	var beginTime                  =  $("#beginTime").val();
	var endTime                    = $("#endTime").val();
	var practiceRequirements                 = $("#practiceRequirements").val();
	var practiceContent                 = $("#practiceContent").val();
	var taskStateCode                 = $("#taskStateCode").val();
	var result                     = $("#result").val();
	var practicetaskname                     = $("#practicetaskname").val();
	var depId                     =  $("#depId").attr("depIdValue");
	 
 
	if(!Mibile_Validation.notEmpty(taskStateCode,"演练状态不能为空"))return; 
 
  var obj=new Object();
	obj.id                       = id;
	obj.beginTime                = beginTime
	obj.endTime                  = endTime
	obj.practiceRequirements     = practiceRequirements;
	obj.practiceContent          = practiceContent;
	obj.taskStateCode            = taskStateCode;
	obj.result                   = result;
	obj.depId                   = depId;
	obj.name                   = practicetaskname;
	var str = JSON.stringify(obj);
 
	var params={uri:"practice_tasks",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
window.onbeforeunload = null;
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		     
		    	window.location.href="practicetask_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
})
})
 
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

