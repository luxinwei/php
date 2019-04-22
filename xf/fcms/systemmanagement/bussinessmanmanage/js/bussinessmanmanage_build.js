$("#btn_reset").bind("click", function(){
//	window.location.href="bussinessmanmanage_build.php?m="+m;
	window.location.reload(); 
	});
$("#btn_history").bind("click", function(){window.location.href="bussinessmanmanage_list.php?"});
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
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="bussinessmanmanage_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
