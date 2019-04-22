singlePicUpload();
$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="traintaskmanagement_detail.php?id="+id;});
selectData({activeId:"executeDepId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择单位"});

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


//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"training_duties/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#executeDepId").val(resultobj["data"]["executeDepName"]);
		    	 $("#executeDepId").attr("executeDepIdValue",resultobj["data"]["executeDepId"]);
		    	 $("#trainingTitle").val(resultobj["data"]["trainingTitle"]);
		    	 
			 	var beginTime=timestampToTime(resultobj["data"]["beginTime"]);
				var endTime=timestampToTime(resultobj["data"]["endTime"]);
				beginTime=beginTime.substring(0,10);
				endTime=endTime.substring(0,10);
		    	 $("#beginTime").val(beginTime);
		    	 $("#endTime").val(endTime);
		    	 
		    	 $("#trainingContent").val(resultobj["data"]["trainingContent"]);
  

		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
 


//修改信息==========================================
$("#btn_save").bind("click", function(){ 
	
	var trainingTitle              = $("#trainingTitle").val();
	var beginTime                  =  $("#beginTime").val()
	var endTime                    = $("#endTime").val()
	var trainingContent            = $("#trainingContent").val();
	var taskStateCode              = $("#taskStateCode").val();
	var percentRate                = $("#percentRate").val();
	var joiningRate                = $("#joiningRate").val();
	var executeDepId               =  $("#executeDepId").attr("executeDepIdValue");
	//var files                        = $("#file_base64").val();
	//var fileNames                    = $("#fileName").val();
	if(!Mibile_Validation.notEmpty(taskStateCode,"培训状态不能为空"))return; 
	if(!Mibile_Validation.notEmpty(percentRate,"合格率不能为空"))return; 
	if(!Mibile_Validation.notEmpty(joiningRate,"参加率不能为空"))return; 
     var obj=new Object();
	obj.id                          = id;
	obj.trainingTitle               = trainingTitle;
	obj.beginTime                   = beginTime
	obj.endTime                     = endTime
	obj.trainingContent             = trainingContent;
	obj.taskStateCode               = taskStateCode;
	obj.percentRate                 = percentRate;
	obj.joiningRate                 = joiningRate;
	obj.executeDepId                 = executeDepId;
	obj.depId                       =$("#depId").val();
 	var str = JSON.stringify(obj);
 	var params={uri:"training_duties",commitData:str};0
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
		    	window.location.href="traintaskmanagement_detail.php?id="+id;
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
function timestampToTime(timestamp) {
    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + '';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    return Y+M+D+h+m+s;
}