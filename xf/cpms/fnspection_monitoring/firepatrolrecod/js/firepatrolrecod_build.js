$("#btn_history").bind("click", function(){window.location.href="firepatrolrecod_list.php";});
$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});

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
 	obj.patrolPointId                            = patrolPointId;
	obj.patrolTime                       = patrolTime;
	obj.patrolName                     = patrolName;
	obj.custodian                 = custodian;
	obj.content                      = content;
	obj.checkResultCode                = checkResultCode;
	obj.depId                       = depId;
	//obj.depId                       = depId;
	var str = JSON.stringify(obj);
	var params={uri:"patrol_records",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="firepatrolrecod_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
