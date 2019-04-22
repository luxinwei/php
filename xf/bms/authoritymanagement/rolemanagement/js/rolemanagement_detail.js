
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="rolemanagement_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="rolemanagement_updata.php?id="+id;});
 
initDetail();
function initDetail(){
 
	var params={uri:"roles/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#appCode").html(resultobj["data"]["appCode"]);
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#description").html(resultobj["data"]["description"]);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}