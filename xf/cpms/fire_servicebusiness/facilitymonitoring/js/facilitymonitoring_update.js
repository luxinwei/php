 singlePicUpload();
 $("#btn_reset").bind("click", function(){
//		window.location.href="management_build.php?m="+m;
		window.location.reload(); 
		});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="facilitymonitoring_detail.php?id="+id;});
getdepId();
function getdepId(){
	var params={uri:"test_managements"};
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


//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"test_managements/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#deviceId").val(resultobj["data"]["deviceId"]);
		    	 $("#name").val(resultobj["data"]["name"]);
		    	 $("#department").val(resultobj["data"]["department"]);
		    	 $("#period").val(resultobj["data"]["period"]);
		    	 
	 			 	var testTime=timeFormat
(resultobj["data"]["testTime"]);
	 			 	testTime=testTime.substring(0,10);
 		    	 $("#testTime").val(testTime);
		    	 $("#director").val(resultobj["data"]["director"]);
		    	 $("#result").val(resultobj["data"]["result"]);
 			 	 
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 


//修改信息==========================================
$("#btn_save").bind("click", function(){ 
 
	var deviceId              = $("#deviceId").val();
	var name                  =  $("#name").val()
	var department                    = $("#department").val()
	var period            = $("#period").val();
	var testTime              = $("#testTime").val();
	var director                = $("#director").val();
	var result                = $("#result").val();
  	//if(!Mibile_Validation.notEmpty(taskStateCode,"培训状态不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(percentRate,"合格率不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(joiningRate,"参加率不能为空"))return; 
     var obj=new Object();
	obj.id                          = id;
	obj.deviceId               = deviceId;
	obj.name                = name
	obj.department                  = department
	obj.period             = period;
	obj.testTime               = testTime;
	obj.director                 = director;
	obj.result                 = result;
  	var str = JSON.stringify(obj);
 	var params={uri:"test_managements",commitData:str};
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
		    	window.location.href="facilitymonitoring_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})


function imgPreview(fileDom){
        //判断是否支持FileReader
        if (window.FileReader) {
            var reader = new FileReader();
        } else {
            alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
        }

        //获取文件
        var file = fileDom.files[0];

        var imageType = /^image\//;

        //是否是图片
        if (!imageType.test(file.type)) {
            alert("请选择图片！");
            return;
        }
        //读取完成
        reader.onload = function(e) {
            //获取图片dom
            var img1 = document.getElementById("file_base64img");
            //图片路径设置为读取的图片
            img1.src = e.target.result;
 
            var str=img1.src;
            ss=str.replace(/data:image\/jpeg;base64,/, "");
         
            $("#file_base64").val(ss);
           // draw(img1);
          
        };
       
        reader.readAsDataURL(file);
    }
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
