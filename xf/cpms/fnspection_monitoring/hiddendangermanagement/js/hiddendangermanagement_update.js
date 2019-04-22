
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="hiddendangermanagement_detail.php?id="+id;});
$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
 
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"hidden_hazards/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
 				 
					$("#depId").val(resultobj["data"]["depName"]);
  					$("#depId").attr("depIdValue",resultobj["data"]["depId"]);
					$("#patrolPointId").val(resultobj["data"]["patrolPointName"]);
					$("#patrolPointId").attr("patrolPointIdValue",resultobj["data"]["patrolPointId"]);
 					$("#discoveryTime").val(resultobj["data"]["discoveryTime"]);
					$("#finishTime").val(resultobj["data"]["finishTime"]);
					$("#processor").val(resultobj["data"]["processor"]);
					$("#custodianName").val(resultobj["data"]["custodianName"]);
					$("#content").val(resultobj["data"]["content"]);
  		    	    $("#state").find("option[value='"+resultobj["data"]["state"]+"']").attr("selected",true);

 
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
//修改信息==========================================
$("#btn_save").bind("click", function(){
	var depId                      =$("#depId").attr("depIdValue");
	var patrolPointId                      =	$("#patrolPointId").attr("patrolPointIdValue");
	var discoveryTime                    = $("#discoveryTime").val();
	var finishTime                = $("#finishTime").val();
	var processor                     = $("#processor").val();
	var custodianName               = $("#custodianName").val();
	var content                   = $("#content").val();
	var state                     = $("#state").val();
 	 
	/*if(!Mibile_Validation.notEmpty(patrolPointId,"巡查点不能为空"))return; 
	if(!Mibile_Validation.notEmpty(governanceStateCode,"治理情况不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(hiddenHazardContent,"隐患内容不能为空"))return; */
	 
 
    var obj=new Object();
	obj.id                              = id;
	obj.depId                            = depId;
	obj.patrolPointId                       = patrolPointId;
	obj.discoveryTime                     = discoveryTime;
	obj.finishTime                 = finishTime;
	obj.processor                      = processor;
	obj.custodianName                = custodianName;
	obj.content                       = content;
	obj.state                       = state;
	var str = JSON.stringify(obj);
	var params={uri:"hidden_hazards",commitData:str};
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
		    	window.location.href="hiddendangermanagement_detail.php?id="+id;
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
 