 
 $("#btn_edit").bind("click", function(){window.location.href="unit_update.php" });

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
search();
function search(){
	var params={uri:"owner_departments"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	 $.post(url,params,function(responseText){	
		//$("#tbody_content").parent().after(responseText);
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content=""
 	     if(success){
	    	 var data=resultobj.data;
	    	
	    		if(data.length==1){  
	    		 var id=data[0]["id"];
	    		 $("#unitid").val(id);
	    		 $("#chargePersonName").html(data[0]["chargePersonName"]);
	    		 $("#chargePersonId").html(data[0]["chargePersonId"]);
	    		 $("#chargePersonTel").html(data[0]["chargePersonTel"]);
	    		 $("#custodianName").html(data[0]["custodianName"]);
	    		 $("#custodianId").html(data[0]["custodianId"]);
	    		 $("#custodianTel").html(data[0]["custodianTel"]);
	    		 $("#fireCustodianName").html(data[0]["fireCustodianName"]);
	    		 $("#fireCustodianId").html(data[0]["fireCustodianId"]);
	    		 $("#fireCustodianTel").html(data[0]["fireCustodianTel"]);
	    		 $("#legalPersonName").html(data[0]["legalPersonName"]);
	    		 $("#legalPersonId").html(data[0]["legalPersonId"]);
	    		 $("#legalPersonTel").html(data[0]["legalPersonTel"]);
	    		 
	    		 $("#ownername").html(data[0]["name"]);
	    		 $("#organizationCode").html(data[0]["organizationCode"]);
	    		 $("#orgTypeCode").html(fnChangeName(data[0]["orgTypeCode"],orgTypeCode_jsarry));
	    		 
	    		 $("#foundingTime").html(timeFormat(data[0]["foundingTime"]));
	    		 
	    		 $("#address").html(data[0]["address"]);
	    		 $("#position").html(data[0]["position"]);
	    		 $("#postalCode").html(data[0]["postalCode"]);
	    		 $("#employeeAmount").html(data[0]["employeeAmount"]);
	    		 
	    		 $("#areaId").html(data[0]["areaName"]);
	    		 $("#precinctDep").html(data[0]["precinctDep"]);
	    		 $("#economicSystemCode").html(fnChangeName(data[0]["economicSystemCode"],economicSystemCode_jsarry));
	    		 $("#fixedAssets").html(data[0]["fixedAssets"]);
	    		 $("#floorSpace").html(data[0]["floorSpace"]);
	    		 
	    		 $("#overallFloorage").html(data[0]["overallFloorage"]);
	    		 $("#description").html(data[0]["description"]);
	    		 $("#supervisionLevelCode").html(fnChangeName(data[0]["supervisionLevelCode"],supervisionLevelCode_jsarry));
	    		 $("#parentDep").html(data[0]["parentDepName"]);
 	    		 $("#affiliatedCenter").html(data[0]["affiliatedCenterName"]);
	    		 $("#onlineState").html(fnChangeName(data[0]["onlineState"],onlineState_jsarray));
	    		 $("#file").val(data[0]["file"]);
	    		 $("#fileName").val(data[0]["fileName"]);
		 	   }else if(data.length>1){
		 		  content+="查询数据存在问题";                                                                                           
					
		 	   }else if(data.length==0){
		 		  content+="没有查询到数据"; 
		    	
		    }

	    }else{
	    	var message=resultobj.message; 
	    	content+="错误码："+code+message; 
	    }	
	     $("#tbody_content").empty().append(content);
  })
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
 
	return Y+M+D;
	
	}   
