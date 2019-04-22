$("#btn_history").bind("click", function(){window.location.href="checkonfireregulations_list.php?m="+m;});
//保存信息
$("#btn_save").bind("click", function(){
	var statutename                =$("#statutename").val();
	var fireLawCode                = $("#fireLawCode").val();
	var promulgateOffice           = $("#promulgateOffice").val();
	var promulgateNo               = $("#promulgateNo").val();
	var approveOffice              = $("#approveOffice").val();
	var promulgateDate             = $("#promulgateDate").val();
	var implementDate              = $("#implementDate").val();
	var createUser                 = $("#createUser").val();
	var content                    = $("#content").val();
	alert(content);
	 $("#tbody_content").parent().after(content);
	if(!Mibile_Validation.notEmpty(statutename,"法规名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(fireLawCode,"请选择法规类别"))return; 
	if(!Mibile_Validation.notEmpty(promulgateOffice,"颁布机关不能为空"))return; 
	if(!Mibile_Validation.notEmpty(promulgateNo,"颁布文号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(approveOffice,"批准机关不能为空"))return; 
	if(!Mibile_Validation.notEmpty(promulgateDate,"颁布日期不能为空"))return; 
	if(!Mibile_Validation.notEmpty(implementDate,"实施日期不能为空"))return; 
	if(!Mibile_Validation.notEmpty(createUser,"输入人姓名不能为空"))return; 
	if(!Mibile_Validation.notEmpty(content,"法规内容不能为空"))return; 
	
var obj=new Object();
	obj.name                     = statutename;
	obj.fireLawCode              = fireLawCode;
	obj.promulgateOffice         = promulgateOffice;
	obj.promulgateNo             = promulgateNo;
	obj.approveOffice            = approveOffice;
	obj.promulgateDate           = promulgateDate;
	obj.implementDate            = implementDate;
	obj.createUser               = createUser;
	obj.content                  = content;
	var str = JSON.stringify(obj);
	var params={uri:"fire_codes",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.reload();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})


  var E = window.wangEditor;
			        var editor = new E('#div1', '#div2');
			        // 或�?var editor = new E( document.getElementById('#editor') )
			       	var $text1 = $('#content');
        			editor.customConfig.onchange = function (html) {
           			 // 监控变化，同步更新到 textarea
           			 $text1.val(html);
       				 };
       				 editor.customConfig.colors = [
								        '#000000',
								        '#eeece0',
								        '#1c487f',
								        '#4d80bf',
								        '#c24f4a',
								        '#8baa4a',
								        '#7b5ba1',
								        '#46acc8',
								        '#f9963b',
								        '#ffffff'
								    ];
					editor.customConfig.linkImgCallback = function (url) {
						console.log(url); // url 即插入图片的地址
					};
					editor.customConfig.linkCheck = function (text, link) {
					    console.log(text); // 插入的文�?
					    console.log(link); // 插入的链�?
					    return true; // 返回 true 表示校验成功
					    // return '验证失败' // 返回字符串，即校验失败的提示信息
					};
					editor.customConfig.emotions = [
				    {
				            // tab 的标�?
				            title: '默认',
				            // type -> 'emoji' / 'image'
				            type: 'image',
				            // content -> 数组
				            content: [
				                {
				                    alt: '[坏笑]',
				                    src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/50/pcmoren_huaixiao_org.png'
				                },
				                {
				                    alt: '[舔屏]',
				                    src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/pcmoren_tian_org.png'
				                }
				            ]
				        },
				        {
				            // tab 的标�?
				            title: 'emoji',
				            // type -> 'emoji' / 'image'
				            type: 'emoji',
				            // content -> 数组
				            content: ['😀', '😃', '😄', '😁', '😆']
				        }
				    ];
				    editor.customConfig.uploadFileName = 'lilipeng'
				    editor.customConfig.uploadImgShowBase64 = true;
			        editor.create();
			        $text1.val(editor.txt.html());