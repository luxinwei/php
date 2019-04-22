$("#btn_history").bind("click", function(){window.location.href="checkjobmanagement_list.php";});




var user="<?php echo $manageuseraccount;?>" 
 
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
	    		var	checkedDepId=data[0]["id"];
	    			 
	    	 	$("#checkedDepId").val(checkedDepId);
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
$("#btn_le").bind("click",function(){
	var id=$("#checkedDepId").val();
	var result=$("#btn_le").attr("revalue");
	
	var myDate = new Date();
	var y= myDate.getFullYear();
	var m=myDate.getMonth()+1;
	if(myDate.getMonth()+1<10){
	 m= myDate.getMonth()+1;
	 m="0"+m;
	}
	var d=myDate.getDate();
	 
	 if(myDate.getDate()<10){
		d="0"+myDate.getDate();
	 }
	var h= myDate.getHours();
	 if(myDate.getHours()<10){
		h="0"+myDate.getHours()
	 }
	var mm= myDate.getMinutes();
	 if(myDate.getMinutes()<10){
		 mm="0"+myDate.getMinutes()
		 } 
	var s= myDate.getSeconds(); 
	 if(myDate.getSeconds()<10){
		 s="0"+myDate.getSeconds()
		 } 
	var endTime =y+"-"+m+"-"+d+" "+h+":"+mm+":"+s 
 	
	 save(result,id,endTime);
	
})
$("#btn_in").bind("click",function(){
	
	var id=$("#checkedDepId").val();
	var result=$("#btn_in").attr("revalue");
	
	var myDate = new Date();
	var y= myDate.getFullYear();
	var m=myDate.getMonth()+1;
	if(myDate.getMonth()+1<10){
	 m= myDate.getMonth()+1;
	 m="0"+m;
	}
	var d=myDate.getDate();
	 
	 if(myDate.getDate()<10){
		d="0"+myDate.getDate();
	 }
	var h= myDate.getHours();
	 if(myDate.getHours()<10){
		h="0"+myDate.getHours()
	 }
	var mm= myDate.getMinutes();
	 if(myDate.getMinutes()<10){
		 mm="0"+myDate.getMinutes()
		 } 
	var s= myDate.getSeconds(); 
	 if(myDate.getSeconds()<10){
		 s="0"+myDate.getSeconds()
		 } 
	 
	var endTime =y+"-"+m+"-"+d+" "+h+":"+mm+":"+s 

	
	save(result,id,endTime);
})




 function  save(result,id,endTime){
 
 	 obj.startTime                     = startTime;
	 obj.endTime                     = endTime;
	 obj.user                 = user;
	 obj.result                 = result;
	 obj.checkedDepId                 = id;
	 obj.user                 = user;
	 obj.code                 = code;
	 
 
	var str = JSON.stringify(obj);
	var params={uri:"inspect_records",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="cameramonitor_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}
