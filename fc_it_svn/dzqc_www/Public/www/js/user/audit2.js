$(function(){
	$('.upload').each(function() {
		var tag = this;
		new QC.upload(this, function(ret) {
			if (ret.status == 1) {
				$.each(ret.path, function(k, path) {
					$("#img_" + 0).html( ret.name[k]);
					$("#file_key_" + 0).val( ret.path[k]);
					$("#file_name_" + 0).val( ret.name[k]);
					$("#img_" + 0).parent().attr('href',ret.url[k]);
					$("#zp").click(function(){
						$("#img_" + 0).attr('src',ret.url[k]);
					});
					$("#img_" + 0).click(function(){
						$("#img_" + 0).attr('src', null);
					});
				});
			}
		},'','','','',false);
	});
	
	$("#submit").click(function(){
		var realname = $("#realname").val();
		var id_card = $("#id_card").val();
		var university = $("#university").val();
		var major = $("#major").val();
		var user_no = $("#user_no").val();
		if(realname == ''){
			alert('请输入你的身份证姓名');
			$("#realname").focus();
			return false;
		}
		if(id_card == ''){
			alert('请输入你的身份证号码');
			$("#id_card").focus();
			return false;
		}
		if(university == ''){
			alert('请输入你的学校');
			$("#university").focus();
			return false;
		}
		if(major == ''){
			alert('请输入你的专业');
			$("#major").focus();
			return false;
		}
		if(user_no == ''){
			alert('请输入你的学号');
			$("#user_no").focus();
			return false;
		}
		
		$("#form").submit();
	});
	
});