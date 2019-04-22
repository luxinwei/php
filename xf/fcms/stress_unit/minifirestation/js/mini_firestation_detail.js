$("#btn_history").bind("click", function(){window.location.href="mini_firestation_list.php?m="+m;});


//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"mini_fire_stations/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#mininame").html(resultobj["data"]["name"]);
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 $("#code").html(resultobj["data"]["code"]);
	    	 $("#address").html(resultobj["data"]["address"]);
	    	 $("#chargePerson").html(resultobj["data"]["chargePerson"]);
	    	 $("#phone").html(resultobj["data"]["phone"]);
	    	 $("#dutyPhone").html(resultobj["data"]["dutyPhone"]);
	    	 $("#personCount").html(resultobj["data"]["personCount"]);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}