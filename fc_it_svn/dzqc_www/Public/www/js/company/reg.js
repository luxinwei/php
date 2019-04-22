/**
 * 注册验证码刷新
 */
$(function(){
	var email;
	var password;
	var password2;
	
	$("#email").keyup(function(){
		email = $("#email").val();
		if(valid_email(email)){
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
	
//	$("#submitLogin").click(function(){
//		email = $("#email").val();
//		password = $("#password").val();
//		password2 = $("input[name=password2]").val();
//		
//		if(email.length == ''){
//			$("#beError").show();
//			$("#email").focus();
//			return false;
//		}
//		if(password.length == ''){
//			$("#peError").show();
//			$("#password").focus();
//			return false;
//		}
//		if(password != password2){
//			$("#teError").show();
//			$("input[name=password2]").focus();
//			return false;
//		}
//		
//		if(!$("#checkbox").is(':checked')){
//			$("#submitLogin").attr('disabled','true');
//			return false;
//		}
//		$("#loginForm").submit();
//	});
	
	
});

function valid_email(email) {
	 // var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);

	var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+(com|cn)$/);
	return patten.test(email);
}

function valid_password(password){
	var patten = new RegExp(/^[@_a-zA-Z0-9-]{6,15}$/);
	return patten.test(password);
}