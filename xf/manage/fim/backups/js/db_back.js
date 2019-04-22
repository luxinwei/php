var issumbit=0;
$("#dbback").bind('click', $(this), function (event) {
	 if(!confirm("确认要备份数据库吗?"))return false;    
	var params=null;
	var url="dbAction.php?action=dbback&m="+m;
	if(issumbit==1)return false;
	issumbit=1;
	$.post(url,params,function(responseText){
		issumbit=0;
	    var data=eval("("+responseText+")"); 
	    var success=data.success;                                
	 	if(success==0){                                          
		    alert(data.msg);                                  
   		}else if(success==1){                                     
       		alert("备份成功!");                              
         	window.location.reload();  
   		}
     })
})

$("#uploadzip").bind('click', $(this), function (event) {
	$(this).attr("disabled","true");
	 if(!confirm("确认要压缩备份上传文件吗?"))return false;    
	var params=null;
	var url="dbAction.php?action=zip&m="+m;
	if(issumbit==1)return false;
	issumbit=1;
	$.post(url,params,function(responseText){
		issumbit=0;
	    var data=eval("("+responseText+")"); 
	    var success=data.success;                                
	 	if(success==0){                                          
		    	alert(data.msg);                                  
   		}else if(success==1){                                     
       		alert("压缩备份成功!");                              
         	window.location.reload();  
   		}
     })
})

function delfn(fullpath){
	 if(!confirm("确认要删除吗?删除后不能恢复 !"))return false;  
	var params={fullpath:fullpath};
	var url="dbAction.php?action=del";
	if(issumbit==1)return false;
	issumbit=1;
	$.post(url,params,function(responseText){
		   issumbit=0;
	       var ds=eval("("+responseText+")"); 
	       var data=eval("("+responseText+")");//转化为json串              
		   var success=data.success;                                      
		   if(success==0){                                              
			    alert(data.msg);                                         
		   }else if(success==1){                                        
			    alert("删除成功!");                                         
			    window.location.reload();                                
		   }  
	})
}