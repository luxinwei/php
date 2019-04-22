
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="key_parts_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="key_parts_update.php?id="+id;});
/*$("#img_rf").bind("click", function(){
	window.parent.navfn("单位监管->防火巡查任务管理");
	window.location.href="../../fnspection_monitoring/detectionmanagement/detectionmanagement_list.php"});*/
/*$("#img_jf").bind("click", function(){
	window.parent.navfn("单位信息->消防设施管理");

	window.location.href="../firefightingdevice/firefightingdevice_list.php"
		
});*/
$("#img_jf").bind("click", function(){
	window.parent.navfn("单位监管->防火巡查任务管理");
	var tourl="../firefightingdevice/firefightingdevice_list.php";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
//查询信
$("#img_rf").bind("click", function(){
	window.parent.navfn("单位监管->防火巡查任务管理");
	var tourl="../../fnspection_monitoring/detectionmanagement/detectionmanagement_list.php";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    
    popup.focus();
});
//查询信息==========================================
initDetail();
function initDetail(){
 
	var params={uri:"important_parts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#chargePersonName").html(resultobj["data"]["chargePersonName"]);
	    	 $("#chargePersonId").html(resultobj["data"]["chargePersonId"]);
	    	 $("#chargePersonTel").html(resultobj["data"]["chargePersonTel"]);
 	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#buildingResistFireCode").html(fnChangeName(resultobj["data"]["buildingResistFireCode"],buildingResistFireCode_jsarry));
	    	 $("#buildingUseKindCode").html(fnChangeName(resultobj["data"]["buildingUseKindCode"],buildingUseKindCode_jsarry));
 	    	 $("#fireproofSignCode").html(fnChangeName(resultobj["data"]["fireproofSignCode"],fireproofSignCode_jsarry));
 	    	 $("#dutyCode").html(fnChangeName(resultobj["data"]["dutyCode"],dutyCode_jsarry));
	    	 var establishReasonCode="";
	    	 var arr=new Array()  
	    	 var arr = resultobj["data"]["establishReasonCode"].split(',');
	    	 for(var i= 0;i<arr.length;i++){  establishReasonCode+=fnChangeName(arr[i],establishReasonCode_jsarry)+",";}  
	    	 if (establishReasonCode.length > 0) {establishReasonCode = establishReasonCode.substr(0, establishReasonCode.length - 1);}
	    	 $("#establishReasonCode").html(establishReasonCode);
	    	 
	    	 var dangerSourceCode="";
	    	 var arr=new Array()  
	    	 var arr = resultobj["data"]["dangerSourceCode"].split(',');
	    	 for(var i= 0;i<arr.length;i++){  dangerSourceCode+=fnChangeName(arr[i],dangerSourceCode_jsarry)+",";}  
	    	 if (dangerSourceCode.length > 0) {dangerSourceCode = dangerSourceCode.substr(0, dangerSourceCode.length - 1);}
	    	 $("#dangerSourceCode").html(dangerSourceCode);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}