$("#btn_reset").bind("click", function(){
//	window.location.href="cameramonitor_build.php?m="+m;
	window.location.reload(); 
	});
singlePicUpload();
//返回列表
$("#btn_history").bind("click", function(){window.location.href="cameramonitor_list.php";});
selectData({activeId:"impPartId",width:600,height:600,url:"select_imppar_list.php",btntitle:"选择部位"});
selectData({activeId:"deviceId",width:600,height:600,url:"select_device_list.php",btntitle:"选择设施"});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//保存信息
$("#btn_save").bind("click", function(){
	var cameraname             =$("#cameraname").val();
	var impPartId              =  $("#impPartId").attr("impPartIdValue");
	var deviceId               = $("#deviceId").attr("deviceIdValue");
	var buildingId             = $("#buildingId").attr("buildIdValue");
	var floor                  = $("#floor").val();
	var code                   = $("#code").val();
	var authCode               =  $("#authCode").val();
	var ip                     =  $("#ip").val();
	var position               =  $("#position").val();
	var port                   = $("#port").val();
 	var file                   = $("#file_base64").val();
	var fileName               = $("#fileName").val();
	if(!Mibile_Validation.notEmpty(cameraname,"监控点名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingId,"所属建筑不能为空"))return; 
	if(!Mibile_Validation.notEmpty(impPartId,"主要部不能为空"))return; 
	if(!Mibile_Validation.notEmpty(deviceId,"所属设施不能为空"))return; 
	if(!Mibile_Validation.notEmpty(floor,"所属楼层不能为空"))return; 
	if(!Mibile_Validation.notEmpty(code,"摄像头序列号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(ip,"IP长度应为1-50字符"))return; 
	if(!Mibile_Validation.notEmpty(authCode,"摄像头验证码不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(port,"端口长度应为1-10字符"))return; 
    var obj=new Object();
 	obj.name                     = cameraname;
	obj.impPartId                = impPartId;
	obj.buildingId               = buildingId;
	obj.deviceId                 = deviceId;
	obj.code                     = code;
	obj.floor                    = floor;
	obj.ip                       = ip;
	obj.authCode                 = authCode;
	obj.position                 = position;
	obj.port                     = port;
	//obj.file                     = file;
	//obj.fileName                 = fileName;
	
	var str = JSON.stringify(obj);
	var params={uri:"camera_monitors",commitData:str};
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
 
 