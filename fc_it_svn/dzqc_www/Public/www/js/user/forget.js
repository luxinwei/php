//获取验证码
$(function(){
	sendSmsCode_init("name", 'getSmsCode', 'smsCode', 3);
	
	$("#next").click(function(){
		var name = $("#name").val();
		var code = $("#smsCode").val();
		var is_ok=1;
		$.ajax({ 

	        type: "post", 

	       url: _APP_+"SMSCode/chkSmsCode", 

	       cache:false, 
	       data:{code:code,mobile:name,type:3},

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
		$("#myform").submit();
	});
});
