 

$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
  
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="firefightingdevice_detail.php?id="+id;});

//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"fire_fighting_devices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	  var systemForm=resultobj["data"]["systemForm"];
		    	  var deviceType=resultobj["data"]["deviceType"];
		    	 $("#fightingname").val(resultobj["data"]["name"]);
		    	 $("#buildingId").val(resultobj["data"]["buildingName"]);
		    	 $("#impPartId").val(resultobj["data"]["impPartName"]);
 	 	    //	$("#systemForm").find("option[value='"+resultobj["data"]["systemForm"]+"']").attr("selected",true);
 	 	    //	$("#deviceType").find("option[value='"+resultobj["data"]["deviceType"]+"']").attr("selected",true);
 		    	// $("#imgName").val(fnChangeName(resultobj["data"]["systemForm"],systemForm_jsarry));
		    //	 $("#position").val(resultobj["data"]["position"]);
		    	 
		    	 systemFormFn(systemForm,deviceType);	    
			
		    	 $("#model").val(resultobj["data"]["model"]);
		    	 $("#areaNum").val(resultobj["data"]["areaNum"]);
		    	 $("#bitNum").val(resultobj["data"]["bitNum"]);
		    	 $("#floor").val(resultobj["data"]["floor"]);
		    	 $("#serviceTime").val(resultobj["data"]["serviceTime"]);
	 	    
		    	 $("#serviceStateCode").val(fnChangeName(resultobj["data"]["serviceStateCode"],serviceStateCode_jsarry));
	 	    	 $("#productName").val(resultobj["data"]["productName"]);
		    	 $("#productTel").val(resultobj["data"]["productTel"]);
	 	    	 $("#maintenanceName").val(resultobj["data"]["maintenanceName"]);
		    	 $("#maintenanceTel").val(resultobj["data"]["maintenanceTel"]);
	 	    	 $("#runStateCode").val(fnChangeName(resultobj["data"]["runStateCode"],runStateCode_jsarry));
	 	    	 $("#stateChangeTime").val(resultobj["data"]["stateChangeTime"]);
	 	    	 $("#stateDescription").val(resultobj["data"]["stateDescription"]);
		    	 $("#cameraNum").val(resultobj["data"]["cameraNum"]);
		    	 $("#shootingAngle").val(resultobj["data"]["shootingAngle"]);
		    	 
		    	 $("#btn_addImg").attr("src",resultobj["data"]["file"])
		    	 
		    	 $("#filebase64").val(resultobj["data"]["file"]);
		    	 $("#iconPosition").val(resultobj["data"]["iconPosition"]);
		    	 $("#fileName").val(resultobj["data"]["fileName"]);
		    	 

	 	    	 
		    	 var FireCode=resultobj["data"]["deviceType"];
		    	 $("[name='deviceType']").each(function(){
		    		 if($(this).val()==FireCode){$(this).attr("checked",true);}
		    	 })
		   
					 
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var fightingname                      =$("#fightingname").val();
	var buildingId                      = $("#buildingId").attr("buildIdValue");
	var impPartId                    = $("#impPartId").attr("impPartIdValue");
	var manufacturer                = $("#manufacturer").val();
	
	var position                     = $("#position").val();
	var systemForm               = $("#systemForm").val();
	var model                      = $("#model").val();
	var areaNum                      = $("#areaNum").val();
	var bitNum                      = $("#bitNum").val();
	var floor                      = $("#floor").val();
	var serviceTime                      = $("#serviceTime").val();
	var deviceType                      = $("#deviceType").val();
	
	var count                      = $("#count").val();
	var count1                     = $("#count1").val();
	var count2                      = $("#count2").val();
	var count3                      = $("#count3").val();
	var file                       = $("#file").val();
	var fileName                       = $("#fileName").val();
	var iconPosition                       = $("#imgData").val();
	
	var serviceStateCode                      = $("#serviceStateCode").val();
	var productName                      = $("#productName").val();
	var productTel                      = $("#productTel").val();
	var maintenanceName                      = $("#maintenanceName").val();
	var maintenanceTel                      = $("#maintenanceTel").val();
	var runStateCode                      = $("#runStateCode").val();
	var stateChangeTime                      = $("#stateChangeTime").val();
	var stateDescription                      = $("#stateDescription").val();
	var cameraNum                      = $("#cameraNum").val();
	var depId                      = $("#depId").val();
	
    var obj=new Object();
    obj.id                                =id;
	obj.name                              = fightingname;
	obj.buildingId                            = buildingId;
	obj.impPartId                       = impPartId;
	obj.manufacturer                     = manufacturer;
	
	obj.position                 = position;
	obj.systemForm                      = systemForm;
	obj.model                   = model;
	obj.areaNum                       = areaNum;
	obj.bitNum               = bitNum;
	obj.floor               = floor;
	obj.serviceTime               = serviceTime;
	obj.deviceType               = deviceType;
	
//	obj.count               = count;
///	obj.count1               = count1;
//	obj.count2               = count2;
//	obj.count3               = count3;
	obj.file               = file;
	obj.fileName               = fileName;
	obj.iconPosition               = iconPosition;
	
	obj.serviceStateCode               = serviceStateCode;
	obj.productName               = productName;
	obj.productTel               = productTel;
	obj.maintenanceName               = maintenanceName;
	obj.maintenanceTel               = maintenanceTel;
	obj.runStateCode               = runStateCode;
	obj.stateChangeTime               = stateChangeTime;
	obj.stateDescription               = stateDescription;
	obj.cameraNum                  = cameraNum;
	obj.depId                     = depId;
	
	var str = JSON.stringify(obj);
	var params={uri:"fire_fighting_devices",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
window.onbeforeunload = null;
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="firefightingdevice_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})
 

 
$("#btn_addImg").bind("click", function(){
 	var file=$("#filebase64").val();
 	if(file!=""){
 		 file=encode64(file);
 	}
	var fileName=$("#fileName").val();
	var iconPosition=$("#iconPosition").val();
	if(iconPosition==""){
		iconPosition="[]";
	}
	 
	//iconPosition=encodeUtf8(iconPosition);
 	 var tourl="firefightingdevice_pic.php?file="+file+"&fileName="+fileName+"&iconPosition="+iconPosition;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});







