 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="mini_firestation_list.php";});

//修改信息==========================================btn_look
$("#btn_edit").bind("click", function(){window.location.href="mini_firestation_update.php?id="+id;});
//$("#btn_look").bind("click", function(){window.location.href="mini_firestation_search_user.php?id="+id;});
$("#btn_look").bind("click", function(){
 
 
	var tourl="mini_firestation_search_user.php?id="+id;
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
	var params={uri:"mini_fire_stations/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#mininame").html(resultobj["data"]["name"]);
	    	 $("#code").html(resultobj["data"]["code"]);
	    	 $("#address").html(resultobj["data"]["address"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#chargePerson").html(resultobj["data"]["chargePerson"]);
	    	 $("#phone").html(resultobj["data"]["phone"]);
	    	 $("#dutyPhone").html(resultobj["data"]["dutyPhone"]);
	    	 $("#personCount").html(resultobj["data"]["personCount"]);
	    	 $("#userIds").html(resultobj["data"]["userIds"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}