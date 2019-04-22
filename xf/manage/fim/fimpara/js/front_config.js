function checkform(){
var FILEUPLOADFOLDER = document.getElementById("FILEUPLOADFOLDER").value;//上传文件地址
var FILESERVERURL    = document.getElementById("FILESERVERURL").value;//上传文件服务URL地址
var FRONTURL         = document.getElementById("FRONTURL").value;
var FRONTROOT        = document.getElementById("FRONTROOT").value;
var FRONTFOLDER      = document.getElementById("FRONTFOLDER").value;
var FRONTTITLE       = document.getElementById("FRONTTITLE").value;
var WEB_DESCRIPTION  = document.getElementById("WEB_DESCRIPTION").value;
var WEB_KEYWORDS     = document.getElementById("WEB_KEYWORDS").value;
var KEYWORDLIST      = document.getElementById("KEYWORDLIST").value;
var XFURL            = document.getElementById("XFURL").value;
var XFAPPCODE         = document.getElementById("XFAPPCODE").value;
var para_obj="";
para_obj+="{\"code\":\"FILEUPLOADFOLDER\",\"content\":\""+FILEUPLOADFOLDER+"\"}";
para_obj+=",{\"code\":\"FILESERVERURL\",\"content\":\""+FILESERVERURL+"\"}";
para_obj+=",{\"code\":\"FRONTURL\",\"content\":\""+FRONTURL+"\"}";
para_obj+=",{\"code\":\"FRONTROOT\",\"content\":\""+FRONTROOT+"\"}";
para_obj+=",{\"code\":\"FRONTFOLDER\",\"content\":\""+FRONTFOLDER+"\"}";
para_obj+=",{\"code\":\"FRONTTITLE\",\"content\":\""+FRONTTITLE+"\"}";
para_obj+=",{\"code\":\"WEB_DESCRIPTION\",\"content\":\""+WEB_DESCRIPTION+"\"}";
para_obj+=",{\"code\":\"WEB_KEYWORDS\",\"content\":\""+WEB_KEYWORDS+"\"}";
para_obj+=",{\"code\":\"KEYWORDLIST\",\"content\":\""+KEYWORDLIST+"\"}";
para_obj+=",{\"code\":\"XFURL\",\"content\":\""+XFURL+"\"}";
para_obj+=",{\"code\":\"XFAPPCODE\",\"content\":\""+XFAPPCODE+"\"}";
para_obj="["+para_obj+"]";
	var params={arrayObj:para_obj}
    var url="fimParaAction.php?action=config&m"+m;
    jQuery.ajax({url:url,
			type:'post',
			async: false,      //ajax同步
			dataType:"html",
			data:params,//URL参数
			success:function(responseText){
			   var data=eval("("+responseText+")");//转化为json串
			   var success=data.success;
				   if(success==0){
				    alert("保存失败!");
				   }else if(success==1){  
				    alert("保存成功!");  
				    window.location.reload();
				   }else if(success==2){
				   }else if(success==3){
				   };
			   },
			   error:function(){
		         alert("错误");
	             }
			});
}
function getPath(){
var params={}
    var url=document.getElementById("FILESERVERROOT").value;
    url+="/manage_app!getPath.action";
    jQuery.ajax({url:url,
			type:'post',
			async: false,      //ajax同步
			dataType:"html",
			data:params,//URL参数
			success:function(responseText){
			    document.getElementById("FILEUPLOADFOLDER").value=responseText;
			   },
			   error:function(){
		         alert("上传文件服务URL地址错误");
	             }
			
			});
}
function getFrontFloder(){
var params=null;
   
    var url= $("#FRONTROOT").val()+"/com/base/common/filerootdir.php";
    $.post(url,params,function(responseText){
    	 document.getElementById("FRONTFOLDER").value=responseText;
    	 
    	 document.getElementById("FILESERVERURL").value="/upload";
    	 document.getElementById("FILEUPLOADFOLDER").value=responseText+"/upload";
    	 
    })

    
   
}


