 
$("#btn_history").bind("click", function(){window.location.href="fireinfomanagement_list.php?"});

 
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_info_managements/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#depId").html(resultobj["data"]["depId"]);
	    	 $("#firePosition").html(resultobj["data"]["firePosition"]);
	 		 	var fireTime=timestampToTime(resultobj["data"]["fireTime"]);
 	 		 	fireTime=fireTime.substring(0,10);
 	    	 $("#fireTime").html(fireTime);
	    	 $("#burnedArea").html(resultobj["data"]["burnedArea"]);
	    	 $("#fireReason").html(resultobj["data"]["fireReason"]);
	    	 $("#deathCount").html(resultobj["data"]["deathCount"]);
	    	 $("#woundCount").html(resultobj["data"]["woundCount"]);
	    	 $("#propertyLoss").html(resultobj["data"]["propertyLoss"]);
	    	 $("#fireFightingDes").html(resultobj["data"]["fireFightingDes"]);
	    	 $("#alarmTypeCode").html(fnChangeName(resultobj["data"]["alarmTypeCode"],alarmTypeCode_jsarry));
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
