//获取验证码
$(function(){
	var InterValObj; //timer变量，控制时间
	var count = 60; //间隔60
	var curCount;
	$("#sendCode").click(function(){
		curCount = count;
		var mobile = $("#name").val();
		if(mobile == ''){
			alert('手机号不允许为空');
			$("#name").focus();
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
				data:{mobile:mobile,type:3},
				success:function(data){
					if(data.status == 1){
						$("#code").val(data.info);
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
	
	$("#form").submit(function(e){
		var name = $("#name").val();
		var verify = $("#verify").val();
		var code = $("#code").val();
		if(name == ''){
			alert('手机号或邮箱不允许为空');
			$("#name").focus();
			return false;
		}
		if(verify == ''){
			alert('验证码不允许为空');
			$("#verify").focus();
			return false;
		}
		if(code == ''){
			alert('发送验证码不允许为空');
			$("#code").focus();
			return false;
		}
		
	});
	
});


