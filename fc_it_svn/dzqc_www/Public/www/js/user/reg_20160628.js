/**
 * 注册验证码刷新
 */
$(function(){
	var mobile;
	var password;
	var password2;
	
	$("#email").keyup(function(){
		mobile = $("#email").val();
		if(valid_mobile(mobile)){
			$("#beError").hide();
		}else{
			$("#beError").show();
		}
	});
	
	$("#password").keyup(function(){
		password = $("#password").val();
		if(valid_password(password)){
			$("#peError").hide();
		}else{
			$("#peError").show();
		}
	});
	
	$("#checkbox").click(function(){
		if(!$("#checkbox").is(":checked")){
			$("#submitLogin").attr("disabled",true);
			$("#submitLogin").css("background",'gray');
		}else{
			$("#submitLogin").attr("disabled",false);
			$("#submitLogin").css("background",'#019875');
		}
	});
	
	$("#submitLogin").click(function(){
		mobile = $("#email").val();
		password = $("#password").val();
		repassword = $("input[name=repassword]").val();
		
		if(mobile.length == ''){
			$("#beError").show();
			$("#email").focus();
			return false;
		}
		if(password.length == ''){
			$("#peError").show();
			$("#password").focus();
			return false;
		}
		if(password != repassword){
			$("#teError").show();
			$("input[name=repassword]").focus();
			return false;
		}
		
		if(!$("#checkbox").is(':checked')){
			$("#submitLogin").attr('disabled','true');
			return false;
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