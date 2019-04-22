$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
selectData({activeId:"depId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择"});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="communicationmodule_detail.php?id="+id;;});
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"communication_modules/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#sid").val(resultobj["data"]["sid"]);
		    	 $("#depId").val(resultobj["data"]["depName"]);
		    	 $("#depId").attr("depIdValue",resultobj["data"]["depId"]);
		    	 $("#modelname").val(resultobj["data"]["name"]);
		    	 $("#comMouldCode").find("option[value='"+resultobj["data"]["comMouldCode"]+"']").attr("selected",true);
		    	 $("#position").val(resultobj["data"]["position"]);
		    	 $("#description").val(resultobj["data"]["description"]);
		    	
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}


//保存信息==========================================
$("#btn_save").bind("click", function(){	
	var sid                   =$("#sid").val();
	var depId                 = $("#depId").attr("depIdValue");
	var modelname             = $("#modelname").val();
	var comMouldCode          = $("#comMouldCode").val();
	var position              = $("#position").val();
	var description           = $("#description").val();
	if(!Mibile_Validation.notEmpty(sid,"唯一标示长度应为1-32字符"))return; 
	if(!Mibile_Validation.notEmpty(depId,"所属业主单位不能为空"))return; 
	if(!Mibile_Validation.notEmpty(name,"模组名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(comMouldCode,"通讯模组类型不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"安装位置长度应为1-100字节"))return; 
	if(!Mibile_Validation.notEmpty(description,"描述信息长度应为1-100字节"))return; 

	var obj=new Object();
	obj.id                      = id;
	obj.sid                     = sid;
	obj.depId                   = depId;
	obj.name                    = modelname;
	obj.comMouldCode            = comMouldCode;
	obj.position                = position;
	obj.description             = description;
	var str = JSON.stringify(obj);
	var params={uri:"communication_modules",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="communicationmodule_detail.php?id="+id;;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

