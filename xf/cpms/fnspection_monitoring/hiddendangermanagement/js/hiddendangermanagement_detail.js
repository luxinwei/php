 

$("#btn_history").bind("click", function(){window.location.href="hiddendangermanagement_list.php";});
//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="hiddendangermanagement_update.php?id="+id;});


//查询信息==========================================
initDetail();
function initDetail() {

	var params = {uri: "hidden_hazards/" + id};
	var url = rootPath + "/com/base/InterfaceGetAction.php";
	$.post(url, params, function (responseText) {
		  //////$("#tbody_content").parent().after(responseText);
		var resultobj = eval("(" + responseText + ")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
			$("#depName").html(resultobj["data"]["depName"]);
			$("#patrolPointName").html(resultobj["data"]["patrolPointName"]);
			$("#finishTime").html(resultobj["data"]["finishTime"]);
			$("#discoveryTime").html(resultobj["data"]["discoveryTime"]);
			$("#processor").html(resultobj["data"]["processor"]);
			$("#custodianName").html(resultobj["data"]["custodianName"]);
			$("#content").html(resultobj["data"]["content"]);
  	    	 $("#state").html(fnChangeName(resultobj["data"]["state"],result_jsarray));
 	 
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
 