 

$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="rectificationnotice_detail.php?id="+id;});


//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"rectification_notices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
	 	    	 $("#code").val(resultobj["data"]["code"]);rectificationStateCode
		    	 $("#monitorCenterId").val(resultobj["data"]["sentDepName"]);
	 	    	 $("#monitorCenterId").attr("monitorCenterIdvalue",resultobj["data"]["monitorCenterId"]);
	 	    	 $("#depId").val(resultobj["data"]["depName"]);
	  		 	var checkTime=timeFormat
(resultobj["data"]["checkTime"]);
			 	checkTime=checkTime.substring(0,10);
	 	    	 $("#checkTime").val(checkTime);
	 	    	 $("#rectificationDeadline").val(resultobj["data"]["rectificationDeadline"]);
	 	    	 $("#illegalContent").val(resultobj["data"]["illegalContent"]);
  	 	    	$("#rectificationStateCode").find("option[value='"+resultobj["data"]["rectificationStateCode"]+"']").attr("selected",true);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 
//修改信息==========================================
$("#btn_save").bind("click", function(){
	var rectificationStateCode      = $("#rectificationStateCode").val();

	if(!Mibile_Validation.notEmpty(rectificationStateCode,"整改状态不能为空"))return; 
    var obj=new Object();
	obj.id                        = id;
	obj.rectificationStateCode    = rectificationStateCode;
	var str = JSON.stringify(obj);
	var params={uri:"rectification_notices",commitData:str};
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
		    	window.location.href="rectificationnotice_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})
function timeFormat(t) {   

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}
