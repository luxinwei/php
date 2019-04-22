  
$("#btn_history").bind("click", function(){window.location.href="personnel_list.php";});
//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="personnel_update.php?id="+id;});

 
//查询信息==========================================
initDetail();
function initDetail() {

	var params = {uri: "user_infos/" + id};
	var url = rootPath + "/com/base/InterfaceGetAction.php";
	$.post(url, params, function (responseText) {
		// ////$("#tbody_content").parent().after(responseText);
		var resultobj = eval("(" + responseText + ")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
 
	    	$("#buildname").html(resultobj["data"]["name"]);
			$("#phone").html(resultobj["data"]["phone"]);
			$("#educationDegree").html(resultobj["data"]["educationDegree"]);
			$("#trainingFlag").html(fnChangeName(resultobj["data"]["trainingFlag"],yesornot_jsarry));
			
 		 	var trainingTime=timestampToTime(resultobj["data"]["trainingTime"]);
 		 	trainingTime=trainingTime.substring(0,10);
			$("#trainingTime").html(trainingTime);
			
 		 	var getTime=timestampToTime(resultobj["data"]["getTime"]);
 		 	getTime=getTime.substring(0,10);
			$("#getTime").html(getTime);
			
			$("#certificateNum").html(resultobj["data"]["certificateNum"]);
			$("#evacuationGuide").html(fnChangeName(resultobj["data"]["evacuationGuide"],yesornot_jsarry));
		
		} else {
			var message = resultobj.message;
			alert("错误码：" + code + message);
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
