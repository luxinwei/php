  

$("#btn_history").bind("click", function(){window.location.href="firepatrolrecod_list.php";});
//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="firepatrolrecod_update.php?id="+id;});


//查询信息==========================================
initDetail();
function initDetail() {

	var params = {uri: "patrol_records/" + id};
	var url = rootPath + "/com/base/InterfaceGetAction.php";
	$.post(url, params, function (responseText) {
		  //////$("#tbody_content").parent().after(responseText);
		var resultobj = eval("(" + responseText + ")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
 	    	 $("#patrolType").html(fnChangeName(resultobj["data"]["patrolType"],patrolTypeCode_jsarry));
 	    	 $("#checkResultCode").html(fnChangeName(resultobj["data"]["patrolType"],checkResultCode_jsarry));
	    	 $("#patrolPointId").html(resultobj["data"]["patrolPointId"]);
				
	 		  
			 
				
	 		 	$("#patrolTime").html(resultobj["data"]["patrolTime"]);
			$("#patrolName").html(resultobj["data"]["patrolName"]);
			$("#custodian").html(resultobj["data"]["custodian"]);
 			$("#content").html(resultobj["data"]["content"]);
 		 
 	 
		} else {
			var message = resultobj.message;
			alert("错误码：" + code + message);
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
 
