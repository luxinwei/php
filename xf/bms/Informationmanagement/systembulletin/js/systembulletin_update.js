$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	}); 

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="systembulletin_detail.php?id="+id;});
 
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"system_notices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		 
		    	 
		    	 $("#content").val(resultobj["data"]["content"]);
		    	 $("#scopeValue").val(resultobj["data"]["scopeValue"]);
		    	 $("#createUser").val(resultobj["data"]["createUser"]);
		    	 $("#createTime").val(resultobj["data"]["createTime"]);
  		    	 $("#dataStateCode").find("option[value='"+resultobj["data"]["dataStateCode"]+"']").attr("selected",true);
		    	 $("#bulletinAreaCode").find("option[value='"+resultobj["data"]["bulletinAreaCode"]+"']").attr("selected",true);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
 
 	var content              = $("#content").val();
	var scopeValue                = $("#scopeValue").val();
	var createUser                = $("#createUser").val();
	var createTime                = $("#createTime").val();
	var dataStateCode                = $("#dataStateCode").val();
	var bulletinAreaCode                = $("#bulletinAreaCode").val();
/*	if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物id不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"隧道位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(height,"隧道高度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(length,"隧道长度不能为空"))return; */
 
      var obj=new Object();
	obj.id                       = id;
	obj.content               = content;
	obj.scopeValue               = scopeValue;
	obj.createUser                 = createUser;
	obj.createTime                   = createTime;
	obj.dataStateCode                   = dataStateCode;
	obj.bulletinAreaCode                   = bulletinAreaCode;
	var str = JSON.stringify(obj);
	var params={uri:"system_notices",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="systembulletin_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
