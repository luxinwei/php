 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="automaticfirealarm_list_content1.php";});

  
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"auto_fire_alarms/detail/2/"+eId};
 	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	// $("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#ctime").val(resultobj["data"]["ctime"]);
	    	 $("#type").val(resultobj["data"]["type"]);
	    	 $("#buildName").val(resultobj["data"]["buildName"]);
	    	 $("#deviceName").val(resultobj["data"]["deviceName"]);
	    	 $("#partName").val(resultobj["data"]["partName"]);
	    	 $("#content").val(resultobj["data"]["content"]);
 	    	 $("#rtime").val(resultobj["data"]["rtime"]);
 	    	 $("#result").val(resultobj["data"]["result"]);
 	    	$("#state").find("option[value='"+resultobj["data"]["state"]+"']").attr("selected",true);
 	    	$("#error").find("option[value='"+resultobj["data"]["error"]+"']").attr("selected",true);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}

//修改信息==========================================
$("#btn_save").bind("click", function(){

	var state             = $("#state").val();
	var error             = $("#error").val();
	if(!Mibile_Validation.notEmpty(state,"状态不能为空"))return; 
	if(!Mibile_Validation.notEmpty(error,"是否误报不能为空"))return; 
       var obj=new Object();
	obj.id                       = id;
	obj.ctime              = $("#ctime").val();
	obj.type             = $("#type").val();
	obj.buildName             = $("#buildName").val();
	obj.deviceName             = $("#deviceName").val();
	obj.partName             = $("#partName").val();
	obj.rtime             = $("#rtime").val();
	obj.result             = $("#result").val();
	obj.state               = state;
	obj.error                  = error;
 	var str = JSON.stringify(obj);
	var params={uri:"/auto_fire_alarms/1/"+eId,commitData:str};
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
		    	window.location.href="refugestorey_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
