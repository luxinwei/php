$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
$("#btn_history").bind("click", function(){window.location.href="checkonfireregulations_detail.php?id="+id;});
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_codes/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#statutename").val(resultobj["data"]["name"]);
		    	 $("#fireLawCode").find("option[value='"+resultobj["data"]["fireLawCode"]+"']").attr("selected",true);
		    	 $("#promulgateOffice").val(resultobj["data"]["promulgateOffice"]);
		    	 $("#promulgateNo").val(resultobj["data"]["promulgateNo"]);
		    	 $("#approveOffice").val(resultobj["data"]["approveOffice"]);
		    	 
		    	 $("#promulgateDate").val(timeFormat(resultobj["data"]["promulgateDate"]));
		    	 $("#implementDate").val(timeFormat(resultobj["data"]["implementDate"]));
		    	 $("#createUser").val(resultobj["data"]["createUser"]);
		    	 $("#content").val(resultobj["data"]["content"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';

	return Y+M+D;
	
	} 

//保存信息==========================================
$("#btn_save").bind("click", function(){
	var statutename                =$("#statutename").val();
	var fireLawCode                = $("#fireLawCode").val();
	var promulgateOffice           = $("#promulgateOffice").val();
	var promulgateNo               = $("#promulgateNo").val();
	var approveOffice              = $("#approveOffice").val();
	var promulgateDate             = $("#promulgateDate").val();
	var implementDate              = $("#implementDate").val();
	var createUser                 = $("#createUser").val();
	var content                    = $("#content").val();
	if(!Mibile_Validation.notEmpty(statutename,"法规名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(fireLawCode,"请选择法规类别"))return; 
	if(!Mibile_Validation.notEmpty(promulgateOffice,"颁布机关不能为空"))return; 
	if(!Mibile_Validation.notEmpty(promulgateNo,"颁布文号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(approveOffice,"批准机关不能为空"))return; 
	if(!Mibile_Validation.notEmpty(promulgateDate,"颁布日期不能为空"))return; 
	if(!Mibile_Validation.notEmpty(implementDate,"实施日期不能为空"))return; 
	if(!Mibile_Validation.notEmpty(createUser,"输入人姓名不能为空"))return; 
	if(!Mibile_Validation.notEmpty(content,"法规内容不能为空"))return; 
	
var obj=new Object();
	obj.id                       = id;
	obj.name                     = statutename;
	obj.fireLawCode              = fireLawCode;
	obj.promulgateOffice         = promulgateOffice;
	obj.promulgateNo             = promulgateNo;
	obj.approveOffice            = approveOffice;
	obj.promulgateDate           = promulgateDate;
	obj.implementDate            = implementDate;
	obj.createUser               = createUser;
	obj.content                  = content;
	var str = JSON.stringify(obj);
	var params={uri:"fire_codes",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="checkonfireregulations_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
