singlePicUpload();

$("#btn_reset").bind("click", function(){
 	window.location.reload(); 
	});

$("#btn_history").bind("click", function(){window.location.href="unit_detail.php"});

$("#btn_guaxia").bind("click", function(){
	var tourl="unit_mg.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});

$("#btn_pic").bind("click", function(){
	var file=$("#file").val();
	var filename=$("#fileName").val();
	var tourl="unit_update_pic.php?file="+file+"&filename="+filename;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});

//地图查看==========================================
$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var tourl="unit_map_gaode.php";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
  var iLeft = (window.screen.availWidth-10-iWidth)/2; 
  var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
  popup.focus();	
});
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}

initUnit();
function initUnit(){
	var params={uri:"owner_departments"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	 $.post(url,params,function(responseText){	
	    // $("#tbody_content").append(responseText);
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    		if(data.length==1){  
	    		 var id=data[0]["id"];
	    		 $("#unitid").val(id);
	    		 $("#chargePersonName").val(data[0]["chargePersonName"]);
	    		 $("#chargePersonId").val(data[0]["chargePersonId"]);
	    		 $("#chargePersonTel").val(data[0]["chargePersonTel"]);
	    		 $("#custodianName").val(data[0]["custodianName"]);
	    		 $("#custodianId").val(data[0]["custodianId"]);
	    		 $("#custodianTel").val(data[0]["custodianTel"]);
	    		 $("#fireCustodianName").val(data[0]["fireCustodianName"]);
	    		 $("#fireCustodianId").val(data[0]["fireCustodianId"]);
	    		 $("#fireCustodianTel").val(data[0]["fireCustodianTel"]);
	    		 $("#legalPersonName").val(data[0]["legalPersonName"]);
	    		 $("#legalPersonId").val(data[0]["legalPersonId"]);
	    		 $("#legalPersonTel").val(data[0]["legalPersonTel"]);
	    		 $("#ownername").val(data[0]["name"]);
	    		 $("#organizationCode").val(data[0]["organizationCode"]);
	    		 $("#orgTypeCode").find("option[value='"+data[0]["orgTypeCode"]+"']").attr("selected",true);
	    		 
	    		 $("#foundingTime").val(timeFormat(data[0]["foundingTime"]));
	    		  
	    		 $("#address").val(data[0]["address"]);
	    		 $("#position").val(data[0]["position"]);
	    		 $("#postalCode").val(data[0]["postalCode"]);
	    		 $("#employeeAmount").val(data[0]["employeeAmount"]);
 	    		 $("#areaId").attr("areaIdValue",data[0]["areaId"]);
 	    		 $("#areaId").val(data[0]["areaName"]);
 	    		 $("#economicSystemCode").find("option[value='"+data[0]["economicSystemCode"]+"']").attr("selected",true);
 	    		 $("#fixedAssets").val(data[0]["fixedAssets"]);
 	    		 $("#floorSpace").val(data[0]["floorSpace"]);
 	    		 $("#overallFloorage").val(data[0]["overallFloorage"]); 
 	    		 $("#affiliatedCenter").val(data[0]["affiliatedCenterName"]);
 	    		 $("#affiliatedCenter").attr("affiliatedCenterValue",data[0]["affiliatedCenter"]);
 	    		 $("#supervisionLevelCode").find("option[value='"+data[0]["supervisionLevelCode"]+"']").attr("selected",true);
	    		 $("#parentDep").val(data[0]["parentDepName"]);
	    		 $("#parentDep").attr("parentDepValue",data[0]["parentDep"]);
	    		 $("#description").val(data[0]["description"]);
	    		 
	    		 $("#file").val(data[0]["file"]);
	    		 $("#fileName").val(data[0]["fileName"]);
	    		 $("#economicSystemCode").val(data[0]["economicSystemCode"]);
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

selectData({activeId:"areaId",width:600,height:600,url:"select_area_list.php",btntitle:"选择区域"});
selectData({activeId:"affiliatedCenter",width:600,height:600,url:"select_affiliatedCenter_list.php",btntitle:"选择监控中心"});
selectData({activeId:"parentDep",width:600,height:600,url:"select_parentDep_list.php",btntitle:"选择消防单位"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var chargePersonName              = $("#chargePersonName").val();
	var chargePersonId                = $("#chargePersonId").val();
	var chargePersonTel               = $("#chargePersonTel").val();
	var custodianName                 = $("#custodianName").val();
	var custodianId                   = $("#custodianId").val();
	var custodianTel                  = $("#custodianTel").val();
	var fireCustodianName             = $("#fireCustodianName").val();
	var fireCustodianId               = $("#fireCustodianId").val();
	var fireCustodianTel              = $("#fireCustodianTel").val();
	var legalPersonName               = $("#legalPersonName").val();
	var legalPersonId                 = $("#legalPersonId").val();
	var legalPersonTel                = $("#legalPersonTel").val();
	var ownername                     = $("#ownername").val();
	var organizationCode              = $("#organizationCode").val();
	var orgTypeCode                   = $("#orgTypeCode").val();
	var foundingTime                  = $("#foundingTime").val();
	var address                       = $("#address").val();
	var position                      = $("#position").val();
	var postalCode                    = $("#postalCode").val();
	var employeeAmount                = $("#employeeAmount").val();
	var areaId                        = $("#areaId").attr("areaIdValue");
	var fixedAssets                   = $("#fixedAssets").val();
	var economicSystemCode            = $("#economicSystemCode").val();
	var floorSpace                    = $("#floorSpace").val();
	var overallFloorage               = $("#overallFloorage").val();
	var affiliatedCenter              = $("#affiliatedCenter").attr("affiliatedCenterValue")
	var supervisionLevelCode          = $("#supervisionLevelCode").val();
	var parentDep                     = $("#parentDep").attr("parentDepValue");
	var description                   = $("#description").val();
	var file                          = $("#file_base64").val();
	var fileName                      = $("#filename").val();
	var id                            =$("#unitid").val();
 
	if(!Mibile_Validation.notEmpty(chargePersonName,"消防安全责任人姓名不能为空"))return; 
	if(!Mibile_Validation.checkIDCard(chargePersonId,"0","消防安全责任人身份证号不能为空,身份证号长度应为18字符"))return; 
	if(!Mibile_Validation.checkTelMobile(chargePersonTel,"0","消防安全责任人电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(custodianName,"消防安全管理人姓名不能为空"))return; 
	if(!Mibile_Validation.checkIDCard(custodianId,"0","消防安全管理人身份证号不能为空,身份证号长度应为18字符"))return; 
	if(!Mibile_Validation.checkTelMobile(custodianTel,"0","消防安全管理人电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(fireCustodianName,"专兼职消防管理人姓名不能为空"))return; 
	if(!Mibile_Validation.checkIDCard(fireCustodianId,"0","消专兼职消防管理人身份证号不能为空,身份证号长度应为18字符"))return; 
	if(!Mibile_Validation.checkTelMobile(fireCustodianTel,"0","专兼职消防管理人电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(legalPersonName,"法人代表姓名不能为空"))return; 
	if(!Mibile_Validation.checkIDCard(legalPersonId,"0","法人代表身份证号不能为空,身份证号长度应为18字符"))return; 
	if(!Mibile_Validation.checkTelMobile(legalPersonTel,"0","法人代表电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 	
	if(!Mibile_Validation.notEmpty(ownername,"业主单位名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(organizationCode,"组织机构代码不能为空"))return; 	
	if(!Mibile_Validation.notEmpty(orgTypeCode,"业主单位类别不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(foundingTime,"成立时间不能为空"))return; 
	if(!Mibile_Validation.notEmpty(address,"地图位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"地图坐标不能为空 "))return; 
	if(!Mibile_Validation.notEmpty(postalCode,"安全出口形式不能为空"))return; 
	if(!Mibile_Validation.notEmpty(employeeAmount,"安全出口形式不能为空"))return; 
	if(!Mibile_Validation.notEmpty(areaId,"所属区域不能为空"))return; 
	if(!Mibile_Validation.notEmpty(fixedAssets,"固定资产不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(economicSystemCode,"安全出口形式不能为空"))return; 	
	//if(!Mibile_Validation.notEmpty(floorSpace,"安全出口形式不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(overallFloorage,"安全出口形式不能为空"))return; 
	
	if(!Mibile_Validation.notEmpty(affiliatedCenter,"所属监控中心不能为空"))return; 
	if(!Mibile_Validation.notEmpty(supervisionLevelCode,"监管级别不能为空"))return; 
	
	if(!Mibile_Validation.notEmpty(parentDep,"消防单位不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(description,"安全出口形式不能为空"))return; 
	
//	if(!Mibile_Validation.notEmpty(file,"安全出口形式不能为空"))return;  
	//if(!Mibile_Validation.notEmpty(fileName,"安全出口形式不能为空"))return;  
  var obj=new Object();
	obj.id                              = id;
	obj.chargePersonName                = chargePersonName;
	obj.chargePersonId                  = chargePersonId;
	obj.chargePersonTel                 = chargePersonTel;
	obj.custodianName                   = custodianName;
	obj.custodianId                     = custodianId;
	obj.custodianTel                    = custodianTel;
	obj.fireCustodianName               = fireCustodianName;
	obj.fireCustodianId                 = fireCustodianId;
	obj.fireCustodianTel                 = fireCustodianTel;
	obj.legalPersonName                 = legalPersonName;
	obj.legalPersonId                   = legalPersonId;
	obj.legalPersonTel                  = legalPersonTel;
	
	obj.name                            = ownername;
	obj.organizationCode                = organizationCode;
	
	obj.orgTypeCode                     = orgTypeCode;
	obj.foundingTime                    = foundingTime;
	obj.address                         = address;
	obj.position                        = position;
	obj.postalCode                      = postalCode;
	obj.employeeAmount                  = employeeAmount;
	obj.areaId                          = areaId;
	obj.economicSystemCode              = economicSystemCode;
	obj.fixedAssets                     = fixedAssets;
	obj.floorSpace                      = floorSpace;
	obj.overallFloorage                 = overallFloorage;
	obj.affiliatedCenter                = affiliatedCenter;
	obj.supervisionLevelCode            = supervisionLevelCode;
	obj.parentDep                       = parentDep;
	obj.description                     = description;
 	obj.file                           =file;
	obj.fileName                       =fileName;
	var str = JSON.stringify(obj);
	var params={uri:"owner_departments",commitData:str};
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
		    	window.location.href="unit_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		  	alert("错误码："+code+message);
		    
		    	return ;
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
            var filename=$("#filename").val();
            var p=filename.indexOf("."); 
            var b = filename.substring(p+1);
            //图片路径设置为读取的图片
            img1.src = e.target.result;
            
            var str=img1.src;
            var t="/data:image\/"+b+";base64,"
            ss=str.replace(t, "");
           
         
            $("#file_base64").val(ss);
           // draw(img1);
          
        };
       
        reader.readAsDataURL(file);
    }
function draw(img1){
	  // var c=document.createElement('canvas'),
	   var c= document.getElementById("myCanvas"); 
	   ctx=c.getContext('2d'),
	   c.width=454;
	   c.height=621;
	   ctx.rect(0,0,c.width,c.height);
	   ctx.fillStyle='transparent';//画布填充颜色
	   ctx.fill();
	   alert(0);
	   var img1=new Image;
	   img1.src= document.getElementById("preview").src;
	   img1.onload=function(){
		   ctx.drawImage(img1,0,0,454,746); 
		   
	   }
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
 
 
	return Y+M+D;
	
	}   