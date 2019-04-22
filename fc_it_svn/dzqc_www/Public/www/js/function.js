
function sendSmsCode_init(mobile_tag, send_btn_tag, code_text_tag, sms_type) {
	if (typeof mobile_tag == "string") {
		mobile_tag = "#" + mobile_tag;
	}
	if (typeof send_btn_tag == "string") {
		send_btn_tag = "#" + send_btn_tag;
	}
	if (typeof code_text_tag == "string") {
		code_text_tag = "#" + code_text_tag;
	}
	$(send_btn_tag).click(function() {
		sendSmsCode(mobile_tag, send_btn_tag, code_text_tag, sms_type);
	});

}

function sendSmsCode(mobile_tag, send_btn_tag, code_text_tag, sms_type) {
	var mobile_val = $(mobile_tag).val();
	if (mobile_val == "") {
		QC.msg_e("请输入手机号");
		return false;
	}
	qajax(_APP_ + "SMSCode/sendSmsCode", {
		type : sms_type,
		mobile : mobile_val
	}, function(ret) {
		if (ret.status == 1) {
			QC.msg_e(ret.info);
			sendSmsCode_time(send_btn_tag);
		} else {

			QC.msg_e(ret.info);

		}
	});
}
var sms_wait_time = 60;
var now_sms_time = sms_wait_time;

function sendSmsCode_time(send_btn_tag) {

	if (now_sms_time <= 0) {
		$(send_btn_tag).attr('disabled', false);
		$(send_btn_tag).html("获取验证码");
		$(send_btn_tag).val("获取验证码");
		now_sms_time = sms_wait_time;
		return false;
	}
	$(send_btn_tag).attr('disabled', true);
	$(send_btn_tag).html(now_sms_time + "秒后可重新获取");
	$(send_btn_tag).val(now_sms_time + "秒后可重新获取");
	now_sms_time--;
	setTimeout(function(){
		sendSmsCode_time(send_btn_tag)
	},1000);

}