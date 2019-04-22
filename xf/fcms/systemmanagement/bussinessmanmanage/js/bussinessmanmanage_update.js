$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="bussinessmanmanage_detail.php?id="+id;});
 
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"user_infos/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
    				
 		    	    $("#name").val(resultobj["data"]["name"]);
					$("#phone").val(resultobj["data"]["phone"]);
					$("#educationDegree").val(resultobj["data"]["educationDegree"]);
					$("#trainingFlag").find("option[value='"+resultobj["data"]["trainingFlag"]+"']").attr("selected",true);
		 		 	
					var trainingTime=timestampToTime(resultobj["data"]["trainingTime"]);
		 		 	trainingTime=trainingTime.substring(0,10);
					$("#trainingTime").val(trainingTime);
					
		 		 	var getTime=timestampToTime(resultobj["data"]["getTime"]);
		 		 	getTime=getTime.substring(0,10);
					$("#getTime").val(getTime);
					
					$("#certificateNum").val(resultobj["data"]["certificateNum"]);
					$("#evacuationGuide").find("option[value='"+resultobj["data"]["evacuationGuide"]+"']").attr("selected",true);

					 
   		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
 

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var userId                      =$("#userId").val();
	var name                      = $("#name").val();
	var phone                    = $("#phone").val();
	var educationDegree                = $("#educationDegree").val();
	
	var trainingFlag                     = $("#trainingFlag").val();
	var trainingTime               = $("#trainingTime").val();
	var getTime                      = $("#getTime").val();
	
	var certificateNum              = $("#certificateNum").val();
	var evacuationGuide                = $("#evacuationGuide").val();
	
	if(!Mibile_Validation.notEmpty(name,"用户详情名称不能为空;"))return; 
 	if(!Mibile_Validation.checkTelMobile(phone,"1","人员手机号电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(educationDegree,"用户文化程度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(trainingFlag,"是否受过消防培训不能为空;"))return; 
	if(!Mibile_Validation.notEmpty(evacuationGuide,"是否为疏散引导员不能为空"))return; 
	 

    var obj=new Object();
	obj.id                              = id;
	obj.userId                            = userId;
	obj.name                       = name;
	obj.phone                     = phone;
	obj.educationDegree                 = educationDegree;
	
	obj.trainingFlag                      = trainingFlag;
	obj.trainingTime                = trainingTime;
	obj.getTime                       = getTime;
	obj.certificateNum               = certificateNum;
	
	obj.evacuationGuide                 = evacuationGuide;
 
	var str = JSON.stringify(obj);
	var params={uri:"user_infos",commitData:str};
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
		    	window.location.href="bussinessmanmanage_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
function timestampToTime(timestamp) {
    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + '';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    return Y+M+D+h+m+s;
}
