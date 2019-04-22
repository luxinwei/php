
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="hiddendangermanagement_list.php"});
 
selectData({activeId:"patrolPointId",width:600,height:600,url:"select_part_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var depId                      =$("#depId").attr("depIdValue");
	var patrolPointId                      =	$("#patrolPointId").attr("patrolPointIdValue");
	var discoveryTime                    = $("#discoveryTime").val();
	var finishTime                = $("#finishTime").val();
	var processor                     = $("#processor").val();
	var custodianName               = $("#custodianName").val();
	var content                   = $("#content").val();
	var state                     = $("#state").val();
 	 
	/*if(!Mibile_Validation.notEmpty(patrolPointId,"巡查点不能为空"))return; 
	if(!Mibile_Validation.notEmpty(governanceStateCode,"治理情况不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(hiddenHazardContent,"隐患内容不能为空"))return; */
	 
 
    var obj=new Object();
 	obj.depId                            = "1";
	obj.patrolPointId                       = patrolPointId;
	obj.discoveryTime                     = discoveryTime;
	obj.finishTime                 = finishTime;
	obj.processor                      = processor;
	obj.custodianName                = custodianName;
	obj.content                       = content;
	obj.state                       = state;
	var str = JSON.stringify(obj);
	alert(str);
 	var params={uri:"hidden_hazards",commitData:str};
 	
	var url=rootPath+"/com/base/InterfacePostAction.php";
	alert(url)
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="hiddendangermanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
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
 

 