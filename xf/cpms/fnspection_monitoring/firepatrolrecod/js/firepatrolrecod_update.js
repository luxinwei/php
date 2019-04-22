
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="firepatrolrecod_detail.php?id="+id;});
 
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
	var params={uri:"patrol_records/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
  		    	    $("#patrolType").find("option[value='"+resultobj["data"]["patrolType"]+"']").attr("selected",true);
					$("#patrolPointId").val(resultobj["data"]["patrolPointName"]);
					$("#patrolPointId").attr("patrolPointIdValue",resultobj["data"]["patrolPointId"]);

  		    	    $("#checkResultCode").find("option[value='"+resultobj["data"]["checkResultCode"]+"']").attr("selected",true);

					
					$("#patrolTime").val(resultobj["data"]["patrolTime"]);
 					$("#patrolName").val(resultobj["data"]["patrolName"]);
					$("#custodian").val(resultobj["data"]["custodian"]);
 					$("#content").val(resultobj["data"]["content"]);
					$("#depId").val(resultobj["data"]["depId"]);
 
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
//修改信息==========================================
$("#btn_save").bind("click", function(){
	var patrolPointId                      =$("#patrolPointId").attr("patrolPointIdValue");
	var patrolTime                      = $("#patrolTime").val();
	var patrolName                    = $("#patrolName").val();
	var custodian                = $("#custodian").val();
	var content                     = $("#content").val();
	var checkResultCode               = $("#checkResultCode").val();
	var depId               = $("#depId").val();
	 
	if(!Mibile_Validation.notEmpty(patrolPointId,"关联测点不能为空"))return; 
	if(!Mibile_Validation.notEmpty(patrolTime,"巡查日期不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(content,"巡查内容不能为空"))return; 
	 
 
    var obj=new Object();
	obj.id                              = id;
	obj.patrolPointId                            = patrolPointId;
	obj.patrolTime                       = patrolTime;
	obj.patrolName                     = patrolName;
	obj.custodian                 = custodian;
	obj.content                      = content;
	obj.checkResultCode                = checkResultCode;
	obj.depId                       = depId;
	var str = JSON.stringify(obj);
	var params={uri:"patrol_records",commitData:str};
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
		    	window.location.href="firepatrolrecod_detail.php?id="+id;
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
 