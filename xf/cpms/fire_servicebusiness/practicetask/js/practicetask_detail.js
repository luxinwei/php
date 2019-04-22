 $("#btn_pic").bind("click", function(){
	var tourl="practicetask_pic.php";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="practicetask_list.php";});

$("#btn_edit").bind("click", function(){window.location.href="practicetask_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"practice_tasks/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //////$("#tbody_content").parent().after(responseText);
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
 	    	 $("#beginTime").html(beginTime);
	    	 $("#endTime").html(endTime);
	    	 $("#taskStateCode").html(fnChangeName(resultobj["data"]["taskStateCode"],taskStateCode_jsarry));
	    	 $("#practiceRequirements").html(resultobj["data"]["practiceRequirements"]);
	    	 $("#overtimeFlag").html(fnChangeName(resultobj["data"]["overtimeFlag"],overtimeFlag_jsarray));
	    
	    	 $("#result").html(resultobj["data"]["result"]);
	    	 $("#pic").attr("src",resultobj["data"]["file"]);
	    	 $("#practiceContent").html(resultobj["data"]["practiceContent"]);
	    	 $("#depId").html(resultobj["data"]["depName"]);
	    	 $("#practicetaskname").html(resultobj["data"]["name"]);
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
