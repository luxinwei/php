
 
$("#btn_prc1").bind("click", function(){
	var tourl="management_prc1.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
$("#btn_prc2").bind("click", function(){
	var tourl="management_prc2.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
$("#btn_prc3").bind("click", function(){
	var tourl="management_prc3.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});

$("#btn_history").bind("click", function(){window.location.href="management_list.php";});
//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="management_update.php?id="+id;});


//查询信息==========================================
initDetail();
function initDetail() {

	var params = {uri: "buildings/" + id};
	var url = rootPath + "/com/base/InterfaceGetAction.php";
	$.post(url, params, function (responseText) {
		// ////$("#tbody_content").parent().after(responseText);
		var resultobj = eval("(" + responseText + ")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
	    	 $("#buildingTypeCode").html(fnChangeName(resultobj["data"]["buildingTypeCode"],buildingTypeCode_jsarry));
	    	 $("#buildingUseKindCode").html(fnChangeName(resultobj["data"]["buildingUseKindCode"],buildingUseKindCode_jsarry));
	    	 $("#buildingFireDangerCode").html(fnChangeName(resultobj["data"]["buildingFireDangerCode"],buildingFireDangerCode_jsarry));
	    	 $("#buildingResistFireCode").html(fnChangeName(resultobj["data"]["buildingResistFireCode"],buildingResistFireCode_jsarry));
	    	 $("#monitorCenterRankCode").html(fnChangeName(resultobj["data"]["monitorCenterRankCode"],monitorCenterRankCode_jsarry));
	    	 $("#buildingStructureCode").html(fnChangeName(resultobj["data"]["buildingStructureCode"],monitorCenterRankCode_jsarry));
		
	    	 $("#buildname").html(resultobj["data"]["name"]);
	    	 
	 		 	var buildTime=timestampToTime(resultobj["data"]["buildTime"]);
	 		 	buildTime=buildTime.substring(0,10);
			$("#buildTime").html(buildTime);
			$("#buildHeight").html(resultobj["data"]["buildHeight"]);
			$("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
			$("#floorSpace").html(resultobj["data"]["floorSpace"]);
			$("#standardFloorage").html(resultobj["data"]["standardFloorage"]);
			$("#workerNum").html(resultobj["data"]["workerNum"]);
			$("#aboveGroundFloors").html(resultobj["data"]["aboveGroundFloors"]);
			$("#aboveGroundArea").html(resultobj["data"]["aboveGroundArea"]);
			$("#underGroundFloors").html(resultobj["data"]["underGroundFloors"]);
			$("#underGroundArea").html(resultobj["data"]["underGroundArea"]);
			$("#maxnumCapacity").html(resultobj["data"]["maxnumCapacity"]);
			$("#controlRoomPosition").html(resultobj["data"]["controlRoomPosition"]);
			$("#controlRoomPerson").html(resultobj["data"]["controlRoomPerson"]);
			$("#controlRoomPhone").html(resultobj["data"]["controlRoomPhone"]);
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
