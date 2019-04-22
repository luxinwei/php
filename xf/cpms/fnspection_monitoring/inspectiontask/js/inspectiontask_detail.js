$("#btn_history").bind("click", function(){window.location.href="inspectiontask_list.php?m="+m;});


$("#btn_edit").bind("click", function(){window.location.href="inspectiontask_update.php?id="+id;});
$("#btn_look").bind("click", function(){
	 
	 
	var tourl="inspectiontask_search_part.php?id="+id;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"patrol_tasks/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#depId").html(resultobj["data"]["depName"]);
	    	 $("#executeDepId").html(resultobj["data"]["executeDepName"]);
	    	 $("#insname").html(resultobj["data"]["name"]);
	    	 $("#patrolTypeCode").html(fnChangeName(resultobj["data"]["patrolTypeCode"],patrolTypeCode_jsarry));

	   
	    	 
	     	 var strategy=resultobj["data"]["strategy"];  
	    	 var reason = strategy.split(','); 
	    	 var strategys="";
	    	 for(j=0;j<reason.length;j++){
	    		 strategys=reason[j]+"点,"
	    			 
	    	 }
	    	 strategys=strategys.substring(0,strategys.length-1);
	    	 
	     	 $("#strategy").html(strategys);
 	    	 $("#patrolUser").html(resultobj["data"]["patrolUserName"]);
	    	 $("#deviationTime").html(resultobj["data"]["deviationTime"]);
	    	 $("#patrolPoints").html(resultobj["data"]["patrolPoints"]);
   	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}