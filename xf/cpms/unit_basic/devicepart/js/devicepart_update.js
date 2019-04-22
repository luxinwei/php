 
$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="devicepart_detail.php?id="+id;});
 
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"device_parts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#deviceName").val(resultobj["data"]["deviceName"]);
		    	 $("#floor").val(resultobj["data"]["floor"]);
		    	 $("#typeName").val(resultobj["data"]["typeName"]);
		    	 $("#name").val(resultobj["data"]["name"]);
		    	 $("#model").val(resultobj["data"]["model"]);
		    	 $("#areaNum").val(resultobj["data"]["areaNum"]);
		    	 $("#circuitNum").val(resultobj["data"]["circuitNum"]);
		    	 $("#bitNum").val(resultobj["data"]["bitNum"]);
		    	 $("#position").val(resultobj["data"]["position"]);
 		    	 $("#state").find("option[value='"+resultobj["data"]["state"]+"']").attr("selected",true);
		    	 $("#description").val(resultobj["data"]["description"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var buildingId            =$("#buildingId").attr("buildIdValue"); 
 	var position              = $("#position").val();
	var height                = $("#height").val();
	var length                = $("#length").val();
	if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物id不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"隧道位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(height,"隧道高度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(length,"隧道长度不能为空"))return; 
 
      var obj=new Object();
	obj.id                       = id;
	obj.buildingId               = buildingId;
	obj.position                 = position;
	obj.height                   = height;
	obj.length                   = length;
	var str = JSON.stringify(obj);
	var params={uri:"device_parts",commitData:str};
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
		    	window.location.href="devicepart_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
