/**
 * 注册验证码刷新
 */
$(function(){
	
	sendSmsCode_init("mobile", 'getSmsCode', 'smsCode', 1);
	
	$("#checkbox").click(function(){
		if(!$("#checkbox").is(":checked")){
			$("#submitLogin").attr("disabled",true);
			$("#submitLogin").css("background",'gray');
		}else{
			$("#submitLogin").attr("disabled",false);
			$("#submitLogin").css("background",'#09BA08');
		}
	});
	
	$("#submitLogin").click(function(){
		var mobile = $("#mobile").val();
		var code = $("#smsCode").val();
		var password = $("#password").val();
		var repassword = $("#repassword").val();
		var is_ok=1;
		
		if(mobile.length == ''){
			alert('请填写要注册的手机号码');
			$("#mobile").focus();
			return false;
		}
		if(password.length == ''){
			alert('请填写密码');
			$("#password").focus();
			return false;
		}
		if(password != repassword){
			alert('2次密码输入不一致');
			$("#repassword").focus();
			return false;
		}
		
		if(!$("#checkbox").is(':checked')){
			$("#submitLogin").attr('disabled','true');
			return false;
		}
		
		$.ajax({ 

	        type: "post", 

	       url: _APP_+"SMSCode/chkSmsCode", 

	       cache:false, 
	       data:{code:code,mobile:mobile,type:1},

	       async:false, 

	        dataType: "json", 

	         success: function(ret){ 
	        	 if(!ret.status){
	     			is_ok=0;
	     			QC.msg_e("手机验证码不正确");
	     			return  false;
	     		}
	        } 

	});
		if(!is_ok){
			return  false;
		}
		$("#loginForm").submit();
	});
	
	
});

function valid_mobile(mobile) {
	 // var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);

	var patten = new RegExp(/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/);
	return patten.test(mobile);
}

function valid_password(password){
	var patten = new RegExp(/^[@_a-zA-Z0-9-]{6,15}$/);
	return patten.test(password);
}