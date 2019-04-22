$("#btn_check").bind("click", function(){
	var file=$("#file").val();
	//var filename=$("#fileName").val();
	var filename="测试";
 
	var tourl="cameramonitor_checkview.php?file="+file+"&filename="+filename;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
$("#btn_pic").bind("click", function(){
	var file=$("#file").val();
	//var filename=$("#fileName").val();
	var filename="测试";
 
	var tourl="cameramonitor_pic.php?file="+file+"&filename="+filename;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="cameramonitor_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="cameramonitor_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"camera_monitors/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 // //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#cameraname").html(resultobj["data"]["name"]);
	    	 $("#impPartId").html(resultobj["data"]["impPartName"]);
	    	 $("#buildingId").html(resultobj["data"]["buildingName"]);
	    	 $("#deviceId").html(resultobj["data"]["deviceName"]);
	    	 $("#code").html(resultobj["data"]["code"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#authCode").html(resultobj["data"]["authCode"]);
	    	 $("#ip").html(resultobj["data"]["ip"]);
	    	 $("#port").html(resultobj["data"]["port"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#file").html(resultobj["data"]["file"]);
	    	 $("#fileName").html(resultobj["data"]["fileName"]);
	    	 $("#pc").attr("src",resultobj["data"]["hlsAddr"])
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}