$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
$("#btn_history").bind("click", function(){window.location.href="inspectiontask_list.php?"});

selectData({activeId:"executeDepId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择单位"});
selectData({activeId:"patrolUser",width:600,height:600,url:"select_user_list.php",btntitle:"选择巡查人员"});
selectData({activeId:"btn_chose",width:600,height:600,url:"inspectiontask_search_chose.php",btntitle:"添加关联人员"});

$("#btn_save").bind("click", function(){
	 
 	var depId             =  $("#beginTime").attr("depIdValue");
	var executeDepId       = $("#endTime").attr("executeDepIdValue");
	var name                = $("#insname").val();
	var strategy              = $("#strategy").val();
	var patrolUser              = $("#patrolUser").val();
	var deviationTime             = $("#deviationTime").val();
	var patrolPoints               = $("#patrolPoints").val();
	var patrolTypeCode              = $("#patrolTypeCode").val();
	var strategy=''; 
/*	if(!Mibile_Validation.notEmpty(depId,"下发单位不能为空"))return; 
	if(!Mibile_Validation.notEmpty(patrolTypeCode,"巡查类别不能为空"))return; 
	if(!Mibile_Validation.notEmpty(name,"巡查任务名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(patrolUser,"巡查人员不能为空"))return; */
	if(!Mibile_Validation.notEmpty(deviationTime,"偏差时间不能为空")){
		return; 
		
	}else{
		var arr = [];
		$("[name='strategy']:checked").each(function(){
			strategy+=$(this).val()+',';
			arr.push($(this).val());
		})
		
		strategy=strategy.substring(0,strategy.length-1);
		
		if(deviationTime=="2"){
			for(i=0;i<arr.length;i++){	
 					var a=parseInt(arr[i])+1;
					var b=parseInt(arr[i+1])
					if(a==b){
						alert("巡查时间间隔不能小于偏差时间");
						return;
					}
				}
		}
	}
 		
	
	if(!Mibile_Validation.notEmpty(patrolPoints,"巡查点不能为空"))return; 
	if(!Mibile_Validation.notEmpty(strategy,"巡查策略不能为空"))return; 
      var obj=new Object();
 	obj.depId                = depId;
	obj.executeDepId                = executeDepId
	obj.name                   = name;
	obj.strategy             = strategy;
	obj.patrolUser               = patrolUser;
	obj.deviationTime                 = deviationTime;
	obj.patrolPoints                 = patrolPoints;
	obj.patrolTypeCode                       =patrolTypeCode
 	var str = JSON.stringify(obj);
 
	var params={uri:"patrol_tasks",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="inspectiontask_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
