  $("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="fireengine_detail.php?id="+id;});

//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"mainframes/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
  				
		        	 $("#name").val(resultobj["data"]["name"]);
		    	    $("#sid").val(resultobj["data"]["sid"]);
					$("#moduleId").val(resultobj["data"]["moduleId"]);
					$("#manufacturer").val(resultobj["data"]["manufacturer"]);
					$("#model").val(resultobj["data"]["model"]);
					$("#number").val(resultobj["data"]["number"]);
					$("#description").val(resultobj["data"]["description"]);
  					 var FireCode=resultobj["data"]["delFlag"];
			    	 $("[name='delFlag']").each(function(){
			    		 if($(this).val()==FireCode){$(this).attr("checked",true);}
			    	 })
		 

					 
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var name                      =$("#name").val();
	var sid                      = $("#sid").val();
	var moduleId                    = $("#moduleId").val();
	var manufacturer                = $("#manufacturer").val();
	
	var model                     = $("#model").val();
	var number               = $("#number").val();
	var description                      = $("#description").val();
	
 	var delFlag = $('[name="delFlag"]:checked ').val();

	if(!Mibile_Validation.notEmpty(name,"主机名称不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(sid,"主机sid不能为空"))return; 
	if(!Mibile_Validation.notEmpty(moduleId,"通讯模组不能为空"))return; 
	if(!Mibile_Validation.notEmpty(number,"编号不能为空"))return; 
	 if(!Mibile_Validation.notEmpty(delFlag,"删除状态不能为空"))return; 
	 

  var obj=new Object();
	obj.id                              = id;
	obj.name                            = name;
	obj.sid                       = sid;
	obj.moduleId                     = moduleId;
	obj.manufacturer                 = manufacturer;
	
	obj.model                      = model;
	obj.number                = number;
	obj.description                       = description;
	obj.delFlag               = delFlag;
	
 

	var str = JSON.stringify(obj);
	var params={uri:"mainframes",commitData:str};
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
		    	window.location.href="fireengine_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})
