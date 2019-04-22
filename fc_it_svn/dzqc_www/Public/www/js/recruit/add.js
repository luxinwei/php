$(function() {

	QC.ajaxForm("#myform", '', function(ret) {
		if(ret.status){
			QC.msg_e("发布成功");
			window.location=_APP_+"Recruit/detail?id="+ret.info;
			
		}else{
			
			QC.msg_e(ret.info);
		}
	}, function() {
		return true;
	});
	sendSmsCode_init("mobile", 'getSmsCode', 'smsCode', 5);
	var file_index=0;
	$('.upload').each(function() {
		var tag = this;
		new QC.upload(this, function(ret) {
			if (ret.status == 1) {
				$.each(ret.path, function(k, path) {
					if(file_index>4){
						
						QC.msg_e("最多上传5个附件");
						return  false;
					}
					$("#img_" + file_index).html( ret.name[k]);
					$("#file_key_" + file_index).val( ret.path[k]);
					$("#file_name_" + file_index).val( ret.name[k]);
					$("#img_" + file_index).parent().attr('href',ret.url[k]);
					file_index++;
				});
			}
		},'','','','',false);
	});
})

function chk_setp1(){
	if($("[name=arg\\[position\\]]").val()==""){
		QC.msg_e("请输入职位");
		return  false;
	}
	
	if($("[name=mobile]").val()==""){
		QC.msg_e("请输入手机号");
		return  false;
	}
	if($("[name=smsCode]").val()==""){
		QC.msg_e("请输入手机验证码");
		return  false;
	}
	if($("[name=arg\\[responsibility\\]]").val()==""){
		QC.msg_e("请输入具体要求");
		return  false;
	}
	
	
	var code=$("[name=smsCode]").val();
	var mobile=$("[name=mobile]").val();
	var is_ok=1;
	$.ajax({ 

        type: "post", 

       url: _APP_+"SMSCode/chkSmsCode", 

       cache:false, 
       data:{code:code,mobile:mobile,type:5},

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
	return true;
}

function chk_setp2(){
	if($("[name=arg\\[number\\]]").val()==""){
		QC.msg_e("请输入所需人数");
		return  false;
	}
	if($("[name=arg\\[remuneration\\]]").val()==""){
		QC.msg_e("请输入具体薪资");
		return  false;
	}
	
	if($("[name=arg\\[working_cycle\\]]").val()==""){
		QC.msg_e("请输入工作周期");
		return  false;
	}
	return true;
}
	
function  goto_setp2(){
	if(!chk_setp1()){
		return  false;
	}
	QC.show_hide('#step_2','.step')
}
function  goto_setp3(){
	if(!chk_setp1()){
		return  false;
	}
	if(!chk_setp2()){
		return  false;
	}
	QC.show_hide('#step_3','.step')
	gre_show();
}

function gre_show(){
	
	$('input').each(function(k,row){
		var name=$(this).attr('name');
		if(name!=null){
			
			
		
			name=name.replace("arg","")
			name=name.replace("[","")
			name=name.replace("]","")
			$("#show_"+name).html($(this).val());
		}
	});
	
	$('#show_responsibility').html($('[name=arg\\[responsibility\\]]').val());
	var show_files_html="";
	$("[name=files_name\\[\\]]").each(function(kkk,vvv){
		if($(this).val()!=""){
			
			show_files_html+=","+$(this).val()
		}
		
		
	});
	$('#show_files').html(show_files_html);
	
	
	$('#show_grade').html($("[name=push_grade]:checked").attr('s_val'));
	
}