$("#btn_reset").bind("click", function(){
//	window.location.href="mini_firestation_build.php?m="+m;
	window.location.reload(); 
	});

getdepId();
function getdepId(){
	var params={uri:"owner_departments"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	 $.post(url,params,function(responseText){	
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    		if(data.length==1){  
	    		 var id=data[0]["id"];
	    		 $("#depId").val(id);
		 	   }else if(data.length>1){
		 		  content+="查询数据存在问题";                                                                                           
		 	   }else if(data.length==0){
		 		  content+="没有查询到数据"; 
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="错误码："+code+message; 
	    }	
 })
}
//返回列表
$("#btn_history").bind("click", function(){window.location.href="mini_firestation_list.php";});
selectData({activeId:"btn_chose",width:600,height:600,url:"mini_firestation_search_build.php",btntitle:"添加关联人员"});

//保存信息
$("#btn_save").bind("click", function(){
	var mininame               = $("#mininame").val();
	var code                   = $("#code").val();
	var address                = $("#address").val();
	var chargePerson           = $("#chargePerson").val();
	var phone                  = $("#phone").val();
	var dutyPhone              = $("#dutyPhone").val();
	var position              = $("#position").val();
 	var userIds              = $("#userIds").val();
	if(!Mibile_Validation.notEmpty(mininame,"名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(code,"编号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(address,"地图位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"地图坐标不能为空"))return; 
	if(!Mibile_Validation.notEmpty(chargePerson,"负责人姓名不能为空"))return; 
	if(!Mibile_Validation.checkTelMobile(phone,0,"联系电话不能为空;电话格式：0371-56694566或 手机号为11位"))return;
	if(!Mibile_Validation.checkTelMobile(dutyPhone,0,"值班电话不能为空;电话格式：0371-56694566或 手机号为11位"))return;
	if(!Mibile_Validation.notEmpty(userIds,"微型消防站关联人员不能为空"))return; 
     var obj=new Object();
 	obj.name                     = mininame;
	obj.code                     = code;
	obj.address                  = address;
	obj.position                 = position;
	obj.chargePerson             = chargePerson;
	obj.phone                    = phone;
	obj.dutyPhone                = dutyPhone;
 	obj.userIds                  = userIds;
	obj.depId                    = $("#depId").val();
	var str = JSON.stringify(obj);
	var params={uri:"mini_fire_stations",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="mini_firestation_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
//地图查看==========================================
$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var tourl="mini_firestation_map_gaode.php";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
  var iLeft = (window.screen.availWidth-10-iWidth)/2; 
  var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
  popup.focus();
	
	
});
 