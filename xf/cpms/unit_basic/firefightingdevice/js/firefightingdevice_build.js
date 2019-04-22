$("#btn_reset").bind("click", function(){
//	window.location.href="exit_build.php?m="+m;
	window.location.reload(); 
	});
 $("#btn_history").bind("click", function(){window.location.href="firefightingdevice_list.php";});
 selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});
 selectData({activeId:"impPartId",width:600,height:600,url:"select_impt_list.php",btntitle:"选择部位"});

 
 getdepId();
 function getdepId(){
 	var params={uri:"owner_departments"};
 	var url=rootPath+"/com/base/InterfaceGetAction.php";
 	 $.post(url,params,function(responseText){	
 	     var resultobj=eval("("+responseText+")");
 	     var success=resultobj.success; 
 	     var code=resultobj.code; 
 	     var content="";   
 	     var online="";
 	     if(success){
 	    	 var data=resultobj.data;
 	    		if(data.length==1){  
 	    		 var id=data[0]["id"];
 	    		 $("#depId").val(id);
 		 	   }else if(data.length>1){
 		 		  content+="查询数据存在问题";                                                                                           
 		 	   }else if(data.length==0){
 		 		  content+="没有查询到数据"; 
 		    }
 	    }else{
 	    	var message=resultobj.message; 
 	    	content+="错误码："+code+message; 
 	    }	
  })
 }

 
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
		 
	  //	iconPosition=encodeUtf8(iconPosition);
	 	 var tourl="firefightingdevice_pic.php?file="+file+"&fileName="+fileName+"&iconPosition="+iconPosition;
		var iWidth=1000; 
		var iHeight=800; 
		var iTop = (window.screen.availHeight-30-iHeight)/2; 
	    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
	    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
	    popup.focus();
	});
 
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
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="firefightingdevice_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})


