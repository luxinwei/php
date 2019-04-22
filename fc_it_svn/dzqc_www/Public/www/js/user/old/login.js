/**
 * 提交登陆
 */
$(function(){
	$("#form").submit(function(){
		var name = $("#name").val();
		var password = $("#password").val();
		if(name == ''){
			alert("手机号或邮箱不能为空");
			$("#name").focus();
			return false;
		}
		if(password == ''){
			alert("密码不能为空");
			$("#password").focus();
			return false;
		}
		
	});
});
