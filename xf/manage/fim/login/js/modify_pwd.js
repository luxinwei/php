function checkform(){
	var oldpassword=$("#oldpassword").val();
	var newpassword=$("#newpassword").val();
	var newpassword1=$("#newpassword1").val();
	if(oldpassword==""){
		alert("原始密码不能为空!");
		return false;
	}
	if(newpassword==""){
		alert("新密码不能为空!");
		return false;
	}
	if(newpassword1==""){
		alert("确认新密码不能为空!");
		return false;
	}
	if(newpassword!=newpassword1){
		alert("新密码和确认新密码不一致!");
		return false;
		
	}
	var params={oldpassword:encode64(oldpassword)
               ,newpassword:encode64(newpassword)
           }
	 var url="loginAction.php?action=modifypwd";
    jQuery.ajax({url:url,
			type:'post',
			async: false,      //ajax同步
			dataType:"html",
			data:params,//URL参数
			success:function(responseText){
			   var data=eval("("+responseText+")");//转化为json串
			   var success=data.success;
				   if(success==0){
				    alert("修改失败!");
				   }else if(success==1){  
				    alert("修改成功!");
				    window.location.reload();
				   }else if(success==2){
				    alert("对不起，原始密码不正确!");
				   }else if(success==3){
				   };
			   },
			   error:function(){
		         alert("错误");
	             }
			
			});
 
}