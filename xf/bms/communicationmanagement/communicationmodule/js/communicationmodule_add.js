//选择单位
selectData({activeId:"depId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择"});
//返回列表
$("#btn_history").bind("click", function(){window.location.href="communicationmodule_list.php";});
//重置
$("#btn_relode").bind("click", function(){window.location.href="communicationmodule_add.php";});

//保存信息
$("#btn_save").bind("click", function(){
	var sid                   =$("#sid").val();
	var depId                 = $("#depId").attr("depIdValue");
	var modelname             = $("#modelname").val();
	var comMouldCode          = $("#comMouldCode").val();
	var position              = $("#position").val();
	var description           = $("#description").val();
	if(!Mibile_Validation.notEmpty(sid,"唯一标示长度应为1-32字符"))return; 
	if(!Mibile_Validation.notEmpty(depId,"所属业主单位不能为空"))return; 
	if(!Mibile_Validation.notEmpty(name,"模组名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(comMouldCode,"通讯模组类型不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"安装位置长度应为1-100字节"))return; 
	if(!Mibile_Validation.notEmpty(description,"描述信息长度应为1-100字节"))return; 

	
	var obj=new Object();
	obj.sid                     = sid;
	obj.depId                   = depId;
	obj.name                    = modelname;
	obj.comMouldCode            = comMouldCode;
	obj.position                = position;
	obj.description             = description;
	var str = JSON.stringify(obj);
	var params={uri:"communication_modules",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="communicationmodule_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
