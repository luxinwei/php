//获取验证码
$(function(){
	var InterValObj; //timer变量，控制时间
	var count = 60; //间隔60
	var curCount;
	$("#sendCode").click(function(){
		curCount = count;
		var mobile = $("#mobile").val();
		if(mobile == ''){
			alert('手机号不允许为空');
			$("#mobile").focus();
			return false;
		}else{
			$("#sendCode").val(curCount+"s");
			$("#sendCode").attr("disabled","true");
			$("#sendCode").css("background-color","#888");
			 InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
			//向后台发送处理数据
			$.ajax({
				type:"POST",
				dataType:"json",
				url:"http://localhost/dzqc_www/SMSCode/sendSmsCode",
				data:{mobile:mobile,type:1},
				success:function(data){
					if(data.status == 1){
						$("#verify").val(data.info);
					}else{
						alert(data.info);
						window.location.reload();  //刷新当前页面.
					}
				},
				error:function(e){
					//alert(e);
				}
			});
		}
	});
	
	 //timer处理函数
	function SetRemainTime() {
        if (curCount == 0) {                
            window.clearInterval(InterValObj);//停止计时器
            $("#sendCode").removeAttr("disabled");//启用按钮
            $("#sendCode").val("重新发送验证码");
            $("#verify").val() = "";  
        }
        else {
            curCount--;
            $("#sendCode").val(curCount+"s");
        }
    }
	
	$("#form1").submit(function(e){
		var mobile = $("#mobile").val();
		var verify = $("#verify").val();
		var password = $("#password").val();
		var repassword = $("#repassword").val();
		if(mobile == ''){
			alert('手机号不允许为空');
			$("#mobile").focus();
			return false;
		}
		if(verify == ''){
			alert('验证码不允许为空');
			$("#verify").focus();
			return false;
		}
		if(password == ''){
			alert('密码不允许为空');
			$("#password").focus();
			return false;
		}
		if(repassword == ''){
			alert('确认密码不允许为空');
			$("#repassword").focus();
			return false;
		}
		if(repassword != password){
			alert('2次密码输入不一致');
			$("#repassword").focus();
			return false;
		}
		
		if($("input[type='checkbox']").is(':checked')){
			$("#submit").attr("disabled","false");
			$("#submit").css("background-color","green");
			return true;
		}else{
			$("#submit").css("background-color","#888");
			//$("#submit").attr("disabled","true");
			return false;
		}
	});
	
});


/*function submitReg(){
	if($("input[type='checkbox']").is(':checked')){
		return true;
	}else{
		$("#sendCode").css("background-color","#888");
		$("#submit").attr("disabled","true");
		return false;
	}
}*/