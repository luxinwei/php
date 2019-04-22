 //返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="inspectiontask_detail.php?id="+id;});
$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
selectData({activeId:"executeDepId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择单位"});
selectData({activeId:"patrolUser",width:600,height:600,url:"select_user_list.php",btntitle:"选择巡查人员"});
selectData({activeId:"btn_chose",width:600,height:600,url:"inspectiontask_search_chose.php?id="+id,btntitle:"修改巡查点"});
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"patrol_tasks/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 $("#dd").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#depId").val(resultobj["data"]["depId"]);
		    	 
		    	 $("#executeDepId").val(resultobj["data"]["executeDepId"]);
 		    	 $("#insname").val(resultobj["data"]["name"]);
		    	 
		    	 
		    	 $("#deviationTime").find("option[value='"+resultobj["data"]["deviationTime"]+"']").attr("selected",true);
		    	 var dtime=resultobj["data"]["deviationTime"];
 
		    	 var strategy=resultobj["data"]["strategy"];  
		    	 var reason = strategy.split(',');  	
		    	 $("[name='strategy']").each(function(){
		    		 for(j=0;j<reason.length;j++){
		    			 if($(this).val()==reason[j]){$(this).attr("checked",true);break;}
		    		 }
		    	 })	 
		    	 $("#patrolUser").val(resultobj["data"]["patrolUserName"]);
 		    	 $("#patrolUser").attr("patrolUserValue",resultobj["data"]["patrolUser"]);
 		    	 $("#patrolPoints").val(resultobj["data"]["patrolPoints"]);
		    	 $("#patrolTypeCode").find("option[value='"+resultobj["data"]["patrolTypeCode"]+"']").attr("selected",true);

 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 


//修改信息==========================================
$("#btn_save").bind("click", function(){ 
	 
	 
 	
  	var depId                = $("#depId").val();
  	var executeDepId                = $("#executeDepId").val();
  	var name                = $("#insname").val();
	var strategy              = $("#strategy").val();
	var patrolUser              = $("#patrolUser").attr("patrolUserValue");
	var deviationTime             = $("#deviationTime").val();
	var patrolPoints               = $("#patrolPoints").val();
	var patrolTypeCode              = $("#patrolTypeCode").val();
	var strategy=''; 
/*	 
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
    obj.id                          = id;
  
 	obj.depId                   = depId;
 	obj.executeDepId                   = executeDepId;
 	obj.name                   = name;
	obj.strategy             = strategy;
	obj.patrolUser               = patrolUser;
	obj.deviationTime                 = deviationTime;
	obj.patrolPoints                 = patrolPoints;
	obj.patrolTypeCode                       =patrolTypeCode
 
 	var str = JSON.stringify(obj);
 
	var params={uri:"patrol_tasks",commitData:str};
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
		    	window.location.href="inspectiontask_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})


 
function get_unix_time(dateStr)
{
    var newstr = dateStr.replace(/-/g,'/'); 
    var date =  new Date(newstr); 
    var time_str = date.getTime().toString();
    return time_str.substr(0, 10);
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
