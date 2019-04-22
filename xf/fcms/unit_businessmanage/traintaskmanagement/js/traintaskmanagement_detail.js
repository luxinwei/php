
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="traintaskmanagement_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="traintaskmanagement_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"training_duties/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		  //$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#trainingTitle").html(resultobj["data"]["trainingTitle"]);
			 	var beginTime=timestampToTime(resultobj["data"]["beginTime"]);
				var endTime=timestampToTime(resultobj["data"]["endTime"]);
				beginTime=beginTime.substring(0,10);
				endTime=endTime.substring(0,10);
 	    	 $("#beginTime").html(beginTime);
	    	 $("#endTime").html(endTime);
	    	 $("#trainingContent").html(resultobj["data"]["trainingContent"]);
	    	 $("#taskStateCode").html(fnChangeName(resultobj["data"]["taskStateCode"],taskStateCode_jsarry));
	    	 $("#overtimeFlag").html(fnChangeName(resultobj["data"]["overtimeFlag"],overtimeFlag_jsarray));
	    	 $("#percentRate").html(resultobj["data"]["percentRate"]);
	    	 $("#joiningRate").html(resultobj["data"]["joiningRate"]);
	    	 $("#files").html(resultobj["data"]["files"]);
	    	 $("#executeDepName;").html(resultobj["data"]["executeDepName;"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}
function timestampToTime(timestamp) {
    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + '';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    return Y+M+D+h+m+s;
}