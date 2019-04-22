/**
 * 
 */

$(function(){
	$("#login").click(function(){
		var name = $("#email").val();
		var password = $("#password").val();
		if(name.length == ''){
			alert('请填写已注册手机号');
			$("#email").focus();
			return false;
		}
		if(password == ''){
			alert('请输入6-16位密码，字母区分大小写');
			$("#password").focus();
			return false;
		}
		$("#loginForm").submit();
	});
});
