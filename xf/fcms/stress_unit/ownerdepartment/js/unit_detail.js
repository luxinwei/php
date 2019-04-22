
$("#btn_history").bind("click", function(){window.location.href="unit_list.php?"});

$("#btn_pic").bind("click", function(){
	var file=$("#file").val();
	var filename=$("#fileName").val();
 
	var tourl="unit_pic.php?file="+file+"&filename="+filename;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});

initDetail();
function initDetail(){
	var params={uri:"owner_departments/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#chargePersonName").html(resultobj["data"]["chargePersonName"]);
	    	 $("#chargePersonId").html(resultobj["data"]["chargePersonId"]);
	    	 $("#chargePersonTel").html(resultobj["data"]["chargePersonTel"]);
	    	 $("#custodianName").html(resultobj["data"]["custodianName"]);
	    	 $("#custodianId").html(resultobj["data"]["custodianId"]);
	    	 $("#custodianTel").html(resultobj["data"]["custodianTel"]);
	    	 $("#fireCustodianName").html(resultobj["data"]["fireCustodianName"]);
	    	 $("#fireCustodianId").html(resultobj["data"]["fireCustodianId"]);
	    	 $("#fireCustodianTel").html(resultobj["data"]["fireCustodianTel"]);
	    	 $("#legalPersonName").html(resultobj["data"]["legalPersonName"]);
	    	 $("#legalPersonId").html(resultobj["data"]["legalPersonId"]);
	    	 $("#legalPersonTel").html(resultobj["data"]["legalPersonTel"]);
	    	 
	    	 $("#ownername").html(resultobj["data"]["name"]);
	    	 $("#organizationCode").html(resultobj["data"]["organizationCode"]);
	    	 $("#orgTypeCode").html(fnChangeName(resultobj["data"]["orgTypeCode"],orgTypeCode_jsarry));
	 		 	var foundingTime=timestampToTime(resultobj["data"]["foundingTime"]);
	 		 	foundingTime=foundingTime.substring(0,10);
	    	 $("#foundingTime").html(foundingTime);
 	 
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#address").html(resultobj["data"]["address"]);
	    	 $("#postalCode").html(resultobj["data"]["postalCode"]);
	    	 $("#employeeAmount").html(resultobj["data"]["employeeAmount"]);
	    	 $("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
	    	 
	    	 $("#areaId").html(resultobj["data"]["areaName"]);
	    	 $("#precinctDep").html(resultobj["data"]["precinctDep"]);
 	    	 $("#economicSystemCode").html(fnChangeName(resultobj["data"]["economicSystemCode"],economicSystemCode_jsarry));
	    	 $("#fixedAssets").html(resultobj["data"]["fixedAssets"]);
	    	 $("#floorSpace").html(resultobj["data"]["floorSpace"]);
	    	 
	    	 $("#verallFloorage").html(resultobj["data"]["verallFloorage"]);
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#supervisionLevelCode").html(fnChangeName(resultobj["data"]["supervisionLevelCode"],supervisionLevelCode_jsarry));
	    	 $("#parentDep").html(resultobj["data"]["parentDepName"]);
	    	 $("#affiliatedCenter").html(resultobj["data"]["affiliatedCenterName"]);
	    	 $("#onlineState").html(resultobj(["data"]["onlineState"],onlineState_jsarray));
    		 $("#file").val(data[0]["file"]);
    		 $("#fileName").val(data[0]["fileName"]);
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

	

	
	
