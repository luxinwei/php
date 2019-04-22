window.onload = function() {
	document.getElementById("useraccount").focus();
}
function keyLogin(event) {
	var evt = event?event:(window.event?window.event:null);
	if (document.all) {
		if (event.keyCode == 13) { // 回车键的键值为13
			checkform();
		}
	} else {
		if (evt.keyCode == 13) { // 回车键的键值为13
			checkform();
		}

	}

}

var isSubmit=false;
$("#login_btn").bind("click", function(){
	var useraccount=$("#useraccount").val();
	var password   =$("#password").val();
	var maskcode   =$("#maskcode").val();
	var remuseraccount=getCheckBoxValue("remuseraccount");
    if(useraccount==""){alert("账号不能为空");return false;}
    if(password==""){alert("密码不能为空");return false;}
    if(maskcode==""){alert("验证码不能为空");return false;}
	var params={action:"login"
			,useraccount:useraccount
			,password:encode64(password)
            ,maskcode:maskcode
            ,remuseraccount:remuseraccount
        }
    var url="loginAction.php?action=login";
	if(isSubmit)return;
	isSubmit=true;
	 $.post(url,params,function(responseText){
		 isSubmit=false;
		 var data=eval("("+responseText+")");//转化为json串
		   var success=data.success;
         if(success==1){
			  window.location.href="sysindex.php";
		   }else{
			   alert(data.msg);
			   refreshmask(); 
			   
		   };
		 
	  })            
	
	
});

$("#maskimg").bind("click", function(){
	refreshmask();
});
refreshmask();
function refreshmask(){
$("#maskimg").attr("src","../../../com/base/common/ValidationCode.class.php?id="+Math.random())
}