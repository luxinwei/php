/**
 * 
 */

$(function() {
	if(typeof dis_loading!='undefined'&&dis_loading){
		QC.loading('body',2);
	}
//	d$("input, textarea, select, button").uniform();
	d$('.date').each(function(){
		QC.date(this,$(this).attr('format'));
	});
	$("form.ajax").each(function(){
    	QC.ajaxForm(this);
    });
	//<input name="position" startid=41 class='isel' url="{{$HOST}}common/data/index.do/key/position/pid/" key='position' tips="省,市,区" ids='sel1,sel2,sel3' names='n1,n2,n3'>
	$(".isel").each(function(){
		QC.isel(this,$(this).attr('url'),$(this).attr('names'),$(this).attr('ids'),$(this).attr('tips'),$(this).attr('startid'),$(this).attr('maxdepth'),$(this).attr('classname'),$(this).attr('values'));
    });
	$('.dval').focus(function(){
    	if($(this).val()==$(this).attr('dval')){
    		$(this).val('');
    	}
    }).blur(function(){
    	if($(this).val()==''){
    		$(this).val($(this).attr('dval')).css({color:"#9c9c9c"});
    	}
    }).blur();
	
});
var QC = {};
QC.options={doc:document};
QC.option=document;
QC.option=function(key,val){
	if(typeof val=='undefined'){
		return QC.options[key];
	}else{
		QC.options[key]=val;
	}
}
function d$(sel){
	return $(sel,QC.option('doc'));
}
$(function(){

    // remove layerX and layerY

    var all = $.event.props,

        len = all.length,

        res = [];

    while (len--) {

      var el = all[len];

      if (el != 'layerX' && el != 'layerY') res.push(el);

    }

    $.event.props = res;

}());
QC.alert = function(msg,fun) {
	if(!msg)return;
	var html = '<div id="QC_dialog" class="QC_dialog" style="color:#FF6600;font-size:18px" title="友情提醒"><img src="'+HOST+'view/images/icon/face_smile.png">&nbsp' + msg + '</div>';
	d$('body').append(html);
	fun=fun||function(){};
	d$("#QC_dialog").dialog({
		buttons : {
			"我知道了" : function() {
				d$(this).dialog("close");
				d$('#QC_dialog').remove();
				fun();
			}
		},
		close:function(){
			d$(this).remove();
		},
		dialogClass : 'dialogClass',
		draggable : true,
		hide : "explode",
		modal : false,
		resizable : false,
		stack : false
	});
}

QC.alert_error=function(msg,fun){
	if(!msg)return;
	var html = '<div id="QC_dialog_error" class="QC_dialog" title="友情提醒" ><img src="'+HOST+'view/images/icon/face_sad.png"><span>&nbsp' + msg + '</span></div>';
	d$('body').append(html);
	width=(msg.length)/15*250;
	if(width<300){
		width=300;
	}
	fun=fun||function(){};
	d$("#QC_dialog_error").dialog({
		buttons : {
			"我知道了" : function() {
				d$(this).dialog("close");
				d$(this).remove();
				fun();
			}
		},
		beforeClose:function(){
			d$('#QC_dialog_error').remove();
			d$(this).remove();
		},
		dialogClass : 'dialogClass',
		draggable : true,
		modal : true,
		resizable : false,
		resizable : false,
		stack : false,
		show: { effect: 'drop', direction: "up" },
	    hide: { effect: 'drop', direction: "up" },
	    width:width
	});
}
QC.confirm = function(msg, okfun, cancelfun) {
	if(!msg)return;
	width=(msg.length)/15*250;
	if(width<300){
		width=300;
	}
	html = '<div id="QC_dialog_confirm" class="QC_dialog" title="友情提醒" style="color:#FF6600;;font-size:15px"><img src="'+HOST+'view/images/icon/face_smile.png"><span>&nbsp' + msg + '</span></div>';
	d$('body').append(html);
	d$("#QC_dialog_confirm").dialog({
		buttons : {
			"是的" : function() {
				d$(this).dialog("close");
				d$(this).remove();
				if (typeof okfun != 'undefined') {
					okfun(1);
				}
			},
			"取消" : function() {
				d$(this).dialog("close");
				d$(this).remove();
				if (typeof cancelfun != 'undefined') {
					cancelfun();
				}
			}
		},
		beforeClose:function(){
			d$('#QC_dialog_confirm').remove();
			d$(this).remove();
		},
		dialogClass : 'dialogClass',
		draggable : true,
		hide : "explode",
		modal : true,
		resizable : false,
		stack : false,
		show: { effect: 'drop', direction: "up" },
	    hide: { effect: 'drop', direction: "up" },
	    width:width
	});
}

QC.msg_s=function(msg,fun){
	fun=fun||function(){};
	var d = dialog({
	    content: msg,
	    onclose: function () {
	    	fun();
	    }
	});
	d.show();
	setTimeout(function () {
	    d.close().remove();
	}, 2000);
}
QC.msg_e=function(msg,fun){
	fun=fun||function(){};
	var d = dialog({
	    content: msg,
	    onclose: function () {
	    	fun();
	    }
	});
	d.show();
	setTimeout(function () {
	    d.close().remove();
	}, 2000);
}
QC.msg_i=function(msg,fun){
	fun=fun||function(){};
	jNotify(msg,{
		  HorizontalPosition:'center',
		  VerticalPosition  :'center',
		  autoHide : true,
		  ShowOverlay :false,
		  onClosed:fun
		});
}


QC.openWindow=function(url,isBlank){
//	if(typeof isBlank=='undefined'){
//		isBlank=1;
//	}
//	if(!isBlank){
//		window.location=url;
//	}
//	var paypopupURL = url;
//	var usingActiveX = true;
//	function blockError(){return true;}
//	window.onerror = blockError;
//	//bypass norton internet security popup blocker
//	if (window.SymRealWinOpen){window.open = SymRealWinOpen;}
//	if (window.NS_ActualOpen) {window.open = NS_ActualOpen;}
//	if (typeof(usingClick) == 'undefined') {var usingClick = false;}
//	if (typeof(usingActiveX) == 'undefined') {var usingActiveX = false;}
//	if (typeof(popwin) == 'undefined') {var popwin = null;}
//	if (typeof(poped) == 'undefined') {var poped = false;}
//	var blk = 1;
//	var setupClickSuccess = false;
//	var googleInUse = false;
//	var myurl = location.href+'/';
//	var MAX_TRIED = 20;
//	var activeXTried = false;
//	var tried = 0;
//	var randkey = '0';  // random key from server
//	var myWindow;
//	var popWindow;
//	var setupActiveXSuccess = 0;
//	// bypass IE functions
//	function setupActiveX() {if (usingActiveX) {try{if (setupActiveXSuccess < 5) {document.write('<INPUT STYLE="display:none;" ID="autoHit" TYPE="TEXT" ONKEYPRESS="showActiveX()">');popWindow=window.createPopup();popWindow.document.body.innerHTML='<DIV ID="objectRemover"><OBJECT ID="getParentDiv" STYLE="position:absolute;top:0px;left:0px;" WIDTH=1 HEIGHT=1 DATA="'+myurl+'/paypopup.html" TYPE="text/html"></OBJECT></DIV>';document.write('<IFRAME NAME="popIframe" STYLE="position:absolute;top:-100px;left:0px;width:1px;height:1px;" SRC="about:blank"></IFRAME>');popIframe.document.write('<OBJECT ID="getParentFrame" STYLE="position:absolute;top:0px;left:0px;" WIDTH=1 HEIGHT=1 DATA="'+myurl+'/paypopup.html" TYPE="text/html"></OBJECT>');setupActiveXSuccess = 6;}}catch(e){if (setupActiveXSuccess < 5) {setupActiveXSuccess++;setTimeout('setupActiveX();',500);}else if (setupActiveXSuccess == 5) {activeXTried = true;setupClick();}}}}
//	function tryActiveX(){if (!activeXTried && !poped) {if (setupActiveXSuccess == 6 && googleInUse && popWindow && popWindow.document.getElementById('getParentDiv') && popWindow.document.getElementById('getParentDiv').object && popWindow.document.getElementById('getParentDiv').object.parentWindow) {myWindow=popWindow.document.getElementById('getParentDiv').object.parentWindow;}else if (setupActiveXSuccess == 6 && !googleInUse && popIframe && popIframe.getParentFrame && popIframe.getParentFrame.object && popIframe.getParentFrame.object.parentWindow){myWindow=popIframe.getParentFrame.object.parentWindow;popIframe.location.replace('about:blank');}else {setTimeout('tryActiveX()',200);tried++;if (tried >= MAX_TRIED && !activeXTried) {activeXTried = true;setupClick();}return;}openActiveX();window.windowFired=true;self.focus();}}
//	function openActiveX(){if (!activeXTried && !poped) {if (myWindow && window.windowFired){window.windowFired=false;document.getElementById('autoHit').fireEvent("onkeypress",(document.createEventObject().keyCode=escape(randkey).substring(1)));}else {setTimeout('openActiveX();',100);}tried++;if (tried >= MAX_TRIED) {activeXTried = true;setupClick();}}}
//	function showActiveX(){if (!activeXTried && !poped) {if (googleInUse) {window.daChildObject=popWindow.document.getElementById('objectRemover').children(0);window.daChildObject=popWindow.document.getElementById('objectRemover').removeChild(window.daChildObject);}newWindow=myWindow.open(paypopupURL,'abcdefg');if (newWindow) {newWindow.blur();self.focus();activeXTried = true;poped = true;}else {if (!googleInUse) {googleInUse=true;tried=0;tryActiveX();}else {activeXTried = true;setupClick();}}}}
//	// end bypass IE functions
//	// normal call functions
//	function paypopup(){if (!poped) {if(!usingClick && !usingActiveX) {popwin = window.open(paypopupURL,'abcdefg');if (popwin) {poped = true;}self.focus();}}if (!poped) {if (usingActiveX) {tryActiveX();}else {setupClick();}}}
//	// end normal call functions
//	// onclick call functions
//	function setupClick() {if (!poped && !setupClickSuccess){if (window.Event) document.captureEvents(Event.CLICK);prePaypopOnclick = document.onclick;document.onclick = gopop;self.focus();setupClickSuccess=true;}}
//	function gopop() {if (!poped) {popwin = window.open(paypopupURL,'abcdefg');if (popwin) {poped = true;}self.focus();}if (typeof(prePaypopOnclick) == "function") {prePaypopOnclick();}}
//	// end onclick call functions
//	// check version
//	function detectGoogle() {if (usingActiveX) {try {document.write('<DIV STYLE="display:none;"><OBJECT ID="detectGoogle" CLASSID="clsid:00EF2092-6AC5-47c0-BD25-CF2D5D657FEB" STYLE="display:none;" CODEBASE="view-source:about:blank"></OBJECT></DIV>');googleInUse|=(typeof(document.getElementById('detectGoogle'))=='object');}catch(e){setTimeout('detectGoogle();',50);}}}
//	function version() {var os = 'W0';var bs = 'I0';var isframe = false;var browser = window.navigator.userAgent;if (browser.indexOf('Win') != -1) {os = 'W1';}if (browser.indexOf("SV1") != -1) {bs = 'I2';}else if (browser.indexOf("Opera") != -1) {bs = "I0";}else if (browser.indexOf("Firefox") != -1) {bs = "I0";}else if (browser.indexOf("Microsoft") != -1 || browser.indexOf("MSIE") != -1) {bs = 'I1';}if (top.location != this.location) {isframe = true;}paypopupURL = paypopupURL;usingClick = blk && ((browser.indexOf("SV1") != -1) || (browser.indexOf("Opera") != -1) || (browser.indexOf("Firefox") != -1));usingActiveX = blk && (browser.indexOf("SV1") != -1) && !(browser.indexOf("Opera") != -1) && ((browser.indexOf("Microsoft") != -1) || (browser.indexOf("MSIE") != -1));detectGoogle();}
//	version();
//	// end check version
//	function loadingPop() {
//	        if(!usingClick && !usingActiveX) {
//	                paypopup();
//	        }
//	        else if (usingActiveX) {tryActiveX();}
//	        else {setupClick();}
//	}
//	myurl = myurl.substring(0, myurl.indexOf('/',8));
//	if (myurl == '') {myurl = '.';}
//	setupActiveX();
//	loadingPop();
//	self.focus(); 
//	$('body').click();
//        return;
	if(typeof isBlank=='undefined'){
		isBlank=0;
	}
	var html="";
	if(isBlank){
		html="<form id='sys_QC_hump_href'   action='"+url+"' method='post'><input   name='emailid'  type='hidden' /></form>";
	}else{
		html="<form id='sys_QC_hump_href'  action='"+url+"' method='post'></form>";
	}
	$('body').append(html);
	$('#sys_QC_hump_href').submit();
}
QC.opener={};
QC.open = function(url, option) {
	var iframeHtml = '<iframe id="QC_sys_open_iframe" frameborder="0" name="QC_sys_open_iframe" scrolling="yes" style="overflow:visible;" width="'
			+ ("100%")
			+ '" height="'
			+ "100%"
			+ '"  src="'
			+ url
			+ '"></iframe>';
	var divHtml = '<div id="QC_sys_open" width="'
			+ option.width
			+ '" height="'
			+ option.height
			+ '"  class="ui-widget" style="overflow-x:hidden;overflow-y:scroll;z-index:999" ></div>';
	iframeHtml = d$(iframeHtml);
	divHtml = d$(divHtml);
	$(iframeHtml).bind('load',function() {
		var frameObj=window.frames['QC_sys_open_iframe'].document;
		$("html",frameObj).css("overflow-X", "hidden");
		if ($.browser.msie && $("html",frameObj)[0].scrollHeight > $("html",frameObj).height()) {
			$("html",frameObj).css("overflow-Y", "scroll");
		}
		$('.iframe_loading').hide();
	});
	if(chker.isNum(option.height)){
		var mtop=option.height/2;
	}else{
		var mtop=option.height.substr(0,option.height.length-2)/2;
	}
	if(chker.isNum(option.width)){
		var mleft=option.width/2;
	}else{
		var mleft=option.width.substr(0,option.width.length-2)/2;
	}
	var iframe_loading='<div class="iframe_loading"  style="font-size:14px;color:#808080;margin-top:'+mtop+'px;text-align:center;width:'
					+ option.width+'" ><img src="'+HOST+'view/images/icon/loading.gif">努力加载中....</div>';
	d$('body').append(iframeHtml);
	iframeHtml.wrap(divHtml);
	$(iframe_loading).insertBefore(iframeHtml);
	d$('#QC_sys_open').append(
			'<div id="QC_sys_open_hid" style="display:none"></div>');
	option.callback = option.callback || function() {
	};
	d$('#QC_sys_open_hid').bind('click', function() {
		var val = $(this).attr('QC_sys_open_back_val');
		that=d$('#QC_sys_open');
		that.close=function(){
			d$('#QC_sys_open').remove();
			d$('#QC_sys_open').dialog('close');
		}
		option.callback(that,val);
	});
	d$('#QC_sys_open_hid').bind('dbclick', function() {
		d$('#QC_sys_open').dialog('close');
	});
	option.buttons=option.buttons||[];
	option.create=option.create||[];
	option.height = parseFloat(option.height) + 60;
	option.width = parseFloat(option.width) + 20;
	if(chkBrowser()=='IE 7.0'||chkBrowser()=='IE 8.0'){
		d$('#QC_sys_open').dialog({
			title : option.title,
			height : option.height,
			width : option.width,
			resizable : true,
			close:function(){
				$(this).remove();
				return false;
			},
		   modal:false ,
		   buttons : option.buttons,
		   create:option.create
		});
	}else{
		d$('#QC_sys_open').dialog({
			title : option.title,
			height : option.height,
			width : option.width,
			resizable : true,
			close:function(){
				$(this).remove();
				return false;
			},
		   modal:false ,
		   show: { effect: 'drop', direction: "up" },
		   hide: { effect: 'drop', direction: "up" },
		   buttons : option.buttons,
		   create:option.create
		});
	}
	
}
QC.openBack = function(opt,onlyClose) {
	var obj = $(window.parent.document);
	obj = $('#QC_sys_open_hid', obj)[0];
	$(obj).attr('QC_sys_open_back_val',opt);
	if (document.all) {
		$(obj).trigger('click');
	} else {
		var e = window.parent.document.createEvent('MouseEvent');
		e.initEvent('click', false, false);
		obj.dispatchEvent(e);
	}
}
QC.openClose = function(self) {
	self=self||false;
	if(self){
		d$('#QC_sys_open').dialog('close');
		return ;
	}
	var obj = $(window.parent.document);
	obj = $('#QC_sys_open_hid', obj)[0];
	if (document.all) {
		$(obj).trigger('dbclick');
	} else {
		var e = window.parent.document.createEvent('MouseEvent');
		e.initEvent('dbclick', false, false);
		obj.dispatchEvent(e);
	}
}
QC.openResize = function() {
	var frameObj=window.parent.frames['QC_sys_open_iframe'].document;
	$("html",frameObj).css("overflow-X", "hidden");
	if ($.browser.msie && $("html",frameObj)[0].scrollHeight > $("html",frameObj).height()) {
		$("body",frameObj).css("height", $("html",frameObj).height());
		$("body",frameObj).css("overflow-Y", "scroll");
		$("body",frameObj).css("overflow-X", "hidden");
		
	}
	$('.iframe_loading').hide();
}

ajax_isDoing=false;
QC.ajax=function(){
	this._option={};
	this._option.type='POST';
	this._option.url='';
	this._option.data='';
	this._option.loading=0;
	this._option.form=null;
	this._option.success=function(opt){
			if(opt.islogin){
				
			}else if(opt.flag==1){
				QC.alert(opt.msg);
			}else{
				QC.alert(opt.msg);
			}
			ajax_isDoing=false;
	};
	this._option.error=function(){
		ajax_isDoing=false;
//		QC.alert_error('requestError');
	}
	var that=this;
	this.request=function(){
		if(that._option.form!=null){
			that._option.data=$(that._option.form).serialize(); 
		}
		if(ajax_isDoing){
			$(document).queue("ajaxRequests", function(t){
				var _that=t;
				return function(){
					ajax_isDoing=true;
					if(that._option.loading){
						QC.loading('body',1);
					}
					$.ajax({
						   type: _that._option.type,
						   url:  _that._option.url,
						   data:  _that._option.data,
						   dataType:'json',
						   success: function(opt){
							   if(opt.flag==-1){
								   $(document).queue("ajaxRequests", function(t){
										var _that=t;
										return function(){
											ajax_isDoing=true;
											if(that._option.loading){
												QC.loading('body',1);
											}
											$.ajax({
												   type: _that._option.type,
												   url:  _that._option.url,
												   data:  _that._option.data,
												   dataType:'json',
												   success: function(opt){
													   if(opt.flag==-1){
														   
														   ajax_isDoing=false;
														   dialogLogin();
														   return;
													   }
													   _that._option.success(opt);
													   ajax_isDoing=false;
													   if(that._option.loading){
															QC.loading('body',2);
														}
													   $(document).dequeue("ajaxRequests");
												   },
												   error: function(){
													   ajax_isDoing=false;
													   if(that._option.loading){
															QC.loading('body',2);
														}
													   _that._option.error();
												   }
												})
										}
									}(that));
								   ajax_isDoing=false;
								   dialogLogin();
								   return;
							   }
							   _that._option.success(opt);
							   ajax_isDoing=false;
							   if(that._option.loading){
									QC.loading('body',2);
								}
							   $(document).dequeue("ajaxRequests");
						   },
						   error: function(){
							   ajax_isDoing=false;
							   if(that._option.loading){
									QC.loading('body',2);
								}
							   _that._option.error();
						   }
						})
				}
			}(that));
		}else{
			ajax_isDoing=true;
			if(that._option.loading){
				QC.loading();
			}
			$.ajax({
				   type: that._option.type,
				   url: that._option.url,
				   data: that._option.data,
				   dataType:'json',
				   success: function(opt){
					   if(opt.flag==-1){
						   $(document).queue("ajaxRequests", function(t){
								var _that=t;
								return function(){
									ajax_isDoing=true;
									if(that._option.loading){
										QC.loading('body',1);
									}
									$.ajax({
										   type: _that._option.type,
										   url:  _that._option.url,
										   data:  _that._option.data,
										   dataType:'json',
										   success: function(opt){
											   if(opt.flag==-1){
												   ajax_isDoing=false;
												   dialogLogin();
												   return;
											   }
											   _that._option.success(opt);
											   ajax_isDoing=false;
											   if(that._option.loading){
													QC.loading('body',2);
												}
											   $(document).dequeue("ajaxRequests");
										   },
										   error: function(){
											   ajax_isDoing=false;
											   if(that._option.loading){
													QC.loading('body',2);
												}
											   _that._option.error();
										   }
										})
								}
							}(that));
						   ajax_isDoing=false;
						   dialogLogin();
						   return;
					   }
					   that._option.success(opt);
					   ajax_isDoing=false;
					   if(that._option.loading){
							QC.loading('body',2);
						}
					   $(document).dequeue("ajaxRequests");
				   },
				   error: function(){
					   ajax_isDoing=false;
					   if(that._option.loading){
							QC.loading('body',2);
						}
					   that._option.error();
				   }
				})
		}
};
this.option=function(attr,value){
	if(typeof value=='undefined'){
		return that._option[attr];
	}else{
		that._option[attr]=value;
	}
}
};
var pajax=new QC.ajax();

var qajax=function(url,data,successFun,isRediresct,msg,title){
			var ajaxHandler=new QC.ajax();
			title=title||'c';
			msg=msg||'您确定要进行此操作吗?';
			if(typeof isRediresct=='undefined'){
				isRediresct=1;
			}
			successFun=successFun||function(opt){
				if(opt.status==1){
					QC.msg_s(opt.info,function(){QC.reload();});
				}else{
					QC.msg_e(opt.info);
				}
				
			};
			if(isRediresct==false){
				QC.confirm(msg,
									function(val){
										if(val){
											ajaxHandler.option('url',url);
											ajaxHandler.option('data',data);
											ajaxHandler.option('success',successFun);
											ajaxHandler.request();
										}
									}
									);
			}else{
				ajaxHandler.option('url',url);
				ajaxHandler.option('data',data);
				ajaxHandler.option('success',successFun);
				ajaxHandler.request();
			}
};
var getCheckbox=function(name,attr,split){
	name=name||'checkbox';
	attr=attr||'value';
	split=split||',';
	var ids='';
	$('[name='+name+']:checked').each(function(){
		ids+=split+$(this).attr(attr);
	});
	return ids.replace(split,'');
}
var qajaxAll=function(url,isRediresct){
	isRediresct=isRediresct||false;
	var ids=getCheckbox();
	if(ids==''){
		QC.alert_error('请选择要操作的内容');
		return;
	}
	url+=ids;
	qajax(url,{},null,isRediresct);
}
var cycle=function(that,url,val,attrname){
	attrname=attrname||'class';
	var currentVal=$(that).attr(attrname);
	var arrVal=[];
	var index=0;
	for(var key in val){
		if(currentVal==val[key]){
			index=arrVal.length;
		}
		arrVal[arrVal.length]={'val':key,'class':val[key]};
	}
	var newIndex=index+1;
	if(newIndex>arrVal.length-1){
		newIndex=0;
	}
	requestVal=arrVal[newIndex]['val'];
	successClass=arrVal[newIndex]['class'];
	qajax(
			url+requestVal,
			null,
			function(opt){
				if(opt.flag==1){
					$(that).attr(attrname,successClass);
				}else{
					if(opt.url){
						QC.alert_error(opt.msg,function(){
							QC.reload(opt.url);
						});
					}else{
						QC.alert_error(opt.msg);
					}
				}
			},
			1
	);
}
QC.ajaxForm=function(id,url,succfun,beforefun){
	beforefun=beforefun||function(){
		return true;
	};
	succfun=succfun||function(opt){
		if(opt.status==1){
			if(opt.url){
				QC.msg_s(opt.info,function(){
					QC.reload(opt.url);
				});
			}else{
				QC.msg_s(opt.info);
			}
		}else{
			if(opt.url){
				QC.msg_e(opt.info,function(){
					QC.reload(opt.url);
				});
			}else{
				QC.msg_e(opt.info);
			}
		}
		
	};

	url=$(id).attr('action');
	$('#submit,.submit',id).click(function(){
		$(id).submit();
	});
	 $(id).submit(function(){
		 if(!beforefun()){
			 return false;
		 }
		 var ajax=new QC.ajax();
		 ajax.option('url',url);
		 ajax.option('form',id);
		 ajax.option('success',succfun);
		 ajax.request();
		 return false;
	 });
	
};

 QC.trim=function(str,char){
	char=char||'\s';
	var exp=new RegExp("(^"+char+"*)|("+char+"*$)",'g');
	return str.replace(exp, "");
};
 QC.ltrim=function(str,char){
	char=char||'\s';
	var exp=new RegExp("(^"+char+"*)",'g');
	return str.replace(exp, "");
};
 QC.rtrim=function(str,char){
	char=char||'\s';
	var exp=new RegExp("("+char+"*$)",'g');
	return str.replace(exp, "");
};
QC.url=function(url){
	url=url||window.location.href;
	if(url.indexOf(REQUEST_SUFIX)==-1){
		url=QC.rtrim(url,'\/')+'/index'+REQUEST_SUFIX;
	}
	return url;
}
QC.reload=function(url,isblank){
	isblank=isblank||0;
	if(!isblank){
		if(url){
			window.location=url
		}else{
			window.location.reload();
		}
	}else{
		QC.openWindow(url,1);
	}
}
QC.str_repeat=function(str,count){
	count=count||0;
	var ret='';
	for(var i=0;i<count;i++){
		ret+=str;
	}
	return ret;
}
QC.editor = {};
QC.editor.init = function(id, arg) {
	arg = arg || {};
	arg.autoHeightEnabled = arg.autoHeightEnabled || true;
	arg.autoClearinitialContent = arg.autoClearinitialContent || true;
	editor = new baidu.editor.ui.Editor(arg);
	editor.render(id);
}
QC.str_repeat=function(str,count){
	count=count||0;
	var ret='';
	for(var i=0;i<count;i++){
		ret+=str;
	}
	return ret;
}
function addHtml(type,from, to, search, replace, backfun){
	type=type||1;
	search=search||'index';
	replace=replace||'INDEX';
    content = $(from).html();
	if(isArray(search)){
		$.each(search,function(key,val){
			replaceVar = replace[key]
	        var reg = new RegExp('#' + search[key] + '#', 'g');
	        content = content.replace(reg, replaceVar);
		});
	}else{
		replaceVar = eval(replace);
        var reg = new RegExp('#' + search+ '#', 'g');
        content = content.replace(reg, replaceVar);
        eval(replace + '++');
	}
	if(type==1){
		$(to).append(content);
	}else{
		$(to).after(content);
	}
    if (backfun) {
        backfun(from, to, search, replace);
    }
}

function delHtml(obj){
    $(obj).remove();
    void(0);
}
function isArray(o) {  
  return Object.prototype.toString.call(o) === '[object Array]';   
}
function s_h(sexpr,hexpr){
	if(sexpr.indexOf(',')!=-1){
		arrsexpr=sexpr.spit(',');
	}else{
		arrsexpr=[sexpr];
	}
	$.each(arrsexpr,function(key,val){
		$(val).show();
	});
	
	if(hexpr.indexOf(',')!=-1){
		arrhexpr=hexpr.spit(',');
	}else{
		arrhexpr=[hexpr];
	}
	$.each(arrhexpr,function(key,val){
		$(val).hide();
	});
}
QC.upload=function(tag,backFun,beforeFun,url,data,allowType,multiple){
	var UPSERF=this;
	var uploader=this;
	this.bnt=tag;
	this.cb=backFun;
	this.beforeFun=beforeFun||function(){};
	this.url=url||_APP_+'Qiniu/upload';
	this.file='fileToUpload[]';
	this.data=data||{};
	this.data.ajax=1;
	this.ftype=allowType||'jpg,png,jpeg,gif,bmp,doc,xls,zip,docx,xlsx,txt,rar';
	this.multiple=multiple||false;
	this.error=function(msg){
		QC.msg_e(msg);
	}
	$(tag).attr('has_upload',1);
	this.data.dir=$(tag).attr('dir');
	this.data.ajax=1;
	this.check=function(type,ext){
		if(type=='*') return true;
		if(!ext) return false;
		ext=ext.toLowerCase();
		var arr_ftype=type.split(',');
		for (key in arr_ftype)   {
	      if(arr_ftype[key]==ext) return true;
	   	}
		return false;
	}

	this.init=function(form){
		var button=this.bnt;
		var file=this.file;
		var url=(this.url);
		var ftype=this.ftype;
		var data=this.data;
		var multiple=this.multiple;
		new AjaxUpload(button, {
			action: url,
			name: file,
			data: data,
			autoSubmit: true,
			multiple : multiple,// 可以多选文件
			responseType:'json',
			onChange: function(file, extension){},
			onSubmit: function(file, ext){
				if (!UPSERF.check(ftype,ext)){
					UPSERF.error('只允许上传 '+ftype+' 文件');
					return false;
				}
				this.disable();
				UPSERF.beforeFun();
				var html="<img class='loading' style='width:16px;height:16px'  src="+_PUBLIC_+"www/images/uploading.gif>";
				$(html).insertAfter(button);
			},
			onComplete: function(file, response) {
				$(UPSERF.bnt).next('.loading').remove();
				this.enable();
				if (!response.status)
					return UPSERF.error(response.info);
				else {
					UPSERF.data.old=response.path;
					if (typeof(UPSERF.cb) == 'function') {
						UPSERF.cb(response);
					}
				}
			}
		});
		// --------------
		if (form) {
			var upfile_input = $('#upfile_input');
			if (upfile_input.length < 1)
				$(form).append('<input type="hidden" id="upfile_input" name="fileToUpload" value="">');
		}
		// ---------------
	}
	this.init();
}
QC.date=function(id,dateFormat){
	dateFormat=dateFormat||'yy-mm-dd';
	$( id ).datepicker({
		showOn: "button",
		buttonImage: HOST+"view/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat:dateFormat,
		changeMonth: true,
		changeYear: true,
		autoSize: true,
		yearRange: '1900:2020'
	});
}
QC.isel=function(id,url,tagname,tagid,tips,startid,maxdepth,classname,values){
	$(id).hide();
	var that=this;
	tagname=tagname||'';
	tips=tips||'';
	startid=startid||0;
	tagid=tagid||'';
	arrTagname=tagname.split(',');
	values=values||'';
	arrValue=values.split(',');
	arrTagid=tagid.split(',');
	arrTip=tips.split(',');
	classname=classname||'';
	maxdepth=maxdepth||100;
	QC.isel.fun2=function(sel){
		if($('option:selected',sel).attr('name')=='sys_QC_0_option'){
			$(id).nextAll('select').each(function(){
				if($(sel).attr('depth')+1<=$(this).attr('depth')){
					$(this).remove();
				}
			});
			var val='';
			$(id).nextAll('select.QC_sys_select').each(function(){
				if(!$(this).is(':hidden')){
					val+=','+$(this).val();
				}
			});
			val=QC.ltrim(val,',');
			$(id).val(val);
			return ;
		}
		fun($(sel).val(),parseInt($(sel).attr('depth'))+1);
		if(arrTagname.length==1){
			var val='';
			$(id).nextAll('select.QC_sys_select').each(function(){
				if(!$(this).is(':hidden')){
					val+=','+$(this).val();
				}
			});
			val=QC.ltrim(val,',');
			$(id).val(val);
		}
	}
	var fun=function(pid,depth){
		if(depth>maxdepth){
			return;
		}
		$(id).nextAll('select').each(function(){
			if(depth<=$(this).attr('depth')){
				$(this).remove();
			}
		});
		var qurl=url+pid;
		qajax(qurl,'',function(ret){
			if(ret.flag&&ret.list.total>0){
				var html="<select style='vertical-align:middle;' depth="+depth;
				 html+=" onchange='QC.isel.fun2(this)'";
				if(arrTagname.length>0){
					html+=" name='"+arrTagname[depth-1]+"'";
				}
				if(arrTagid.length>0){
					html+=" id='"+arrTagid[depth-1]+"'";
				}
				if(classname){
					html+=" class='QC_sys_select "+classname+"'";
				}
				html+=">";
				if(arrTip.length>0){
					html+="<option value=0 name='sys_QC_0_option'>"+arrTip[depth-1]+"</option>";
				}else{
					html+="<option value=0 name='sys_QC_0_option'>请选择</option>";
				}
				var autoChange=false;
				$.each(ret.list.rows,function(key,row){
					selected='';
					if(arrValue.length>0&&arrValue[depth-1]==row.id){
						selected="selected";
						autoChange=true;
					}
					html+="<option "+selected+" value="+row.id+">"+row.title+"</option>";
				});
				html+="</select>";
				$(id).parent().append($(html));
				if(autoChange){
					$(html).change();
				}
			}else if(!ret.flag){
				QC.alert_error(ret.msg);
			}
		});
	}
	$(function(){
		if(arrValue.length>1){
			fun(startid,1);
		}else{
			fun(startid,1);
		}
	});
}
var _timer={};
QC.loading=function(sel,type){
	if(typeof(type)=='undefined'){
		type=1;
	}
	var arrobj=$(sel);
		arrobj.each(function(){
			var p = $(this);
			if(p.is(':hidden')){
				return;
			}
			var offset = p.offset();
			var tagid='QC_loading_'+p.attr('id');
			if(type==1){
				if(!$.browser.msie){
					dheight=p.height()+15;
				}else{
					dheight=p.height()+5;
				}
				dwidth=p.width();
				if(dwidth<150){
					dwidth=150;
				}
				html="<div id="+tagid+"_1 style='vertical-align:middle;display: table; z-index:888;-moz-opacity:0.5;opacity:0.5;filter:alpha(opacity=50);background-color:#CDCDC1;position:absolute;left:"+offset.left+"px;top:"+offset.top+"px;width:"+dwidth+"px;height:"+(dheight)+"px;'>";
				html+="</div>";
				html+="<div id="+tagid+"_2 style='color:#006495;vertical-align:middle;position:absolute;width:100%;z-index:889;height:100%;text-align:center;top:"+(offset.top+dheight/2-5)+"px;width:"+dwidth+"px;left:"+offset.left+"px;'><img     src='"+HOST+"view/images/loading.gif'/>";
				html+='<p style="margin-left:15px">努力加载中...</p>';
				html+="</div>";
				$('body').append(html);
				_timer[tagid+'_2']=setInterval ('QC_loading_fun("'+tagid+'_2")',60);
		}else{
			$('#'+tagid+'_1').remove();
			$('#'+tagid+'_2').remove();
			clearInterval(_timer[tagid+'_2']);
		}
	});
	
	
}
function QC_loading_fun(tagId){
	var p=$('p','#'+tagId);
	var pleft = p.offset().left;
	if(pleft>=50+p.parent().offset().left){
		p.css('margin-left','-40px');
	}else{
		p.css('margin-left',parseInt(pleft-p.parent().offset().left+5)+'px');
	}
}
if(typeof dis_loading!='undefined'&&dis_loading){
	QC.loading('body',1);
}
QC.app=function(id){
	cid='#'+$(id).attr('id')+'_content';
	$(id).children().each(function(key,val){
		$(this).click(function(index,that){
			if($(that).attr('href')){
				return function(){
					QC.reload($(that).attr('href'));
				}
			}else{
				return function(){
					$(cid).children().hide();
					$(cid).children().eq(index).show();
					$(id).children().removeClass('active');
					$(this).addClass('active');
				}
			}
		}(key,this));
	});
}
QC.tip=function(sel,content,contentTag,sparams){
	contentTag=contentTag||'';
	content=content||null;
	sparams=sparams||{};
	var tagid;
	if($(sel).attr('id')){
		tagid='QC_tip_'+$(sel).attr('id');
	}else{
		var timestamp=new Date().getTime();
		tagid='QC_tip_'+timestamp;
	}
		var closeHtml='<div style="float:right">';
		closeHtml+='<a onclick="$(\''+sel+'\').poshytip(\'hide\');"><img title="关闭提示" alt="关闭提示" src="'+HOST+'view/images/btn_close.gif"></a>';
		closeHtml+='</div>';
	if(!content&&contentTag){
		content=$(contentTag).html();
	}
	content='<div id="'+tagid+'">'+closeHtml+content+'</div>';
	if($('#'+tagid).length>0){
		$(sel).poshytip('update', content );
		$('.tip_close','#'+tagid).unbind('click');
		$('.tip_close','#'+tagid).click(function(){
			$(sel).poshytip('hide');
		});
		return;
	}
	var params={
			className: 'tip-darkgray',
			showOn: 'none',
			alignTo: 'target',
			alignX: 'inner-left',
			alignY: 'inner-top',
			fade  :true,
			content:content
		};
	$.extend(params, sparams);
	$(sel).poshytip(params);
	$(sel).poshytip('show');
	$('.tip_close','#'+tagid).unbind('click');
	$('.tip_close','#'+tagid).click(function(){
		$(sel).poshytip('hide');
	});
	
}
QC.tipExist=function(sel){
	if($(sel).attr('id')){
		tagid='QC_tip_'+$(sel).attr('id');
		if($('#'+tagid).length>0){
			return true;
		}
	}else{
		return false;
	}
}
QC.input_error=function(tag){
	$(tag).addClass('input_err');
}
QC.input_success=function(tag){
	$(tag).removeClass('input_err');
}
QC.show_hide=function(show_tag,hide_tag){
	$(hide_tag).hide();
	$(show_tag).show();
	
}
var tableSort=function (){
	var sortClass=['sort-0','sort','sort-1'];
	var search_form=$('#searchForm').length>0?$('#searchForm'):null;
	if(!search_form){
		var new_url=QC.url();
		var form_html="<form  method='post' id='searchForm' action='"+new_url+"'></form>";
		$('body').append(form_html);
		search_form=$('#searchForm');
	}
	if(typeof SORT=='undefined'){
		SORT=[];
	}
	$('th.sort').each(function(){
		var inner_span="<span class=''></span>";
		if($(this).attr('field')==SORT.field){
			if(SORT.order=='asc'){
				$(this)[0].className=sortClass[0];
			}else if(SORT.order=='desc'){
				$(this)[0].className=sortClass[2];
			}
		}else{
			$(this).attr('class',sortClass[1]);
		}
		$(this).click(function(){
			var input_html="<input type=hidden name='search[sort][field]' value='"+$(this).attr('field')+"'>";
			var current_class=$(this).attr('class');
			var new_sort=current_class==sortClass[0]||current_class==sortClass[1]?'desc':'asc';
			input_html+="<input type=hidden name='search[sort][order]' value='"+new_sort+"'>";
				search_form.append(input_html);
				search_form.submit();
		});
		
	});
}
chker={};
chker.len=function(str,min,max){
	str=$.trim(str);
	min=min||-1;
	max=max||Number.MAX_VALUE;
	if(str.length>max||str.length<min){
		return false;
	}else{
		return true;
	}
}
chker.isEmpty=function (str){
	return $.trim(str)==''?true:false;
}

chker.isEmail=function(str){
	if(str == "")
	return false;
	if (str.charAt(0) == "." || str.charAt(0) == "@" || str.indexOf('@', 0) == -1|| str.indexOf('.', 0) == -1 || str.lastIndexOf("@") == str.length-1 || str.lastIndexOf(".") == str.length-1)
	return false;
	else
	return true;
}
chker.isNum = function(str) {  
    var re = /^\d+(\.*\d+)*$/ ; 
    return re.test(str);  
} 
chker.isInt = function(str) {  
    var re = /^\d+$/  ;
    return re.test(str);  
}
chker.isUsername = function(str) {  
    var re = /^[_a-zA-Z0-9]*$/  ;
    return re.test(str);  
}



//ajax分页

var pager=function(dataTotal,nowpage,apage,className){
	nowpage=nowpage||1;
	nowpage=parseInt(nowpage);
	apage=apage||20;
	className=className||'badoo';
	this.pageCount=Math.ceil (dataTotal/apage);
	if(dataTotal==0){
		this.pageCount=0;
	}
	var that=this;
	this.html=function(){
		var html="<div class='"+className+"'>";
		if(nowpage==1){
			 html+='<span class="disabled"> |&lt;&lt; </span>';
			 html+='<span class="disabled"> |&lt; </span>';
		}else{
			html+='<span><a href="javascript:void(0)" page=1> |&lt;&lt; </a></span>';
			html+='<span><a href="javascript:void(0)" page='+(nowpage-1)+'> |&lt; </a></span>';
		}
		var pp=nowpage-3>0?nowpage-3:1;
		for(var i=pp;i<nowpage;i++){
			html+='<span><a href="javascript:void(0)" page='+(i)+'> '+i+' </a></span>';
		}
		 html+='<span class="current">'+nowpage+'</span>';
		var pp=nowpage+3<=that.pageCount?nowpage+3:that.pageCount;
		for(var i=nowpage+1;i<=pp;i++){
			html+='<span><a href="javascript:void(0)" page='+(i)+'> '+i+' </a></span>';
		}
		if(nowpage==that.pageCount||that.pageCount==0){
			html+='<span class="disabled"> &gt;| </span>';
			 html+='<span class="disabled"> &gt;&gt;| </span>';
		}else{
			html+='<span><a href="javascript:void(0)" page='+(nowpage+1)+'> &gt;| </a></span>';
			html+='<span><a href="javascript:void(0)" page='+that.pageCount+'> &gt;&gt;| </a></span>';
		}
		html+='<span>&nbsp;<input  style="width:30px"><a  href="javascript:void(0)" name="go"> GO </a><span>';
		html+='<span>共'+that.pageCount+'页   '+dataTotal+'条记录</span>';
		html+='</span></span>';
		return html;
	}
	
}

function importScript(url) {
	   var script = document.createElement('script');
	   script.src = url;
	   script.async = true; // HTML5
	   var s = document.getElementsByTagName('script')[0];
	   s.parentNode.insertBefore(script, s);
	   return true;
}
function importCSS(href) {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
	var s = document.getElementsByTagName('link')[0];
	s.parentNode.insertBefore(link, s);
	return true;
}

function alpha_move(dom){
	dom.style.opacity="0.7";
	dom.style.filter="alpha(opacity=70)";
}
function alpha_out(dom){
	dom.style.opacity="1";
	dom.style.filter="alpha(opacity=100)";
}
function dateFormat(nS,format) {   
	format=format||'yyyy-MM-dd hh:mm';
    date= new Date(parseInt(nS) * 1000);
    var o =
    {
        "M+" : date.getMonth()+1, //month
        "d+" : date.getDate(),    //day
        "h+" : date.getHours(),   //hour
        "m+" : date.getMinutes(), //minute
        "s+" : date.getSeconds(), //second
        "q+" : Math.floor((date.getMonth()+3)/3),  //quarter
        "S" : date.getMilliseconds() //millisecond
    }
    if(/(y+)/.test(format))
    format=format.replace(RegExp.$1,(date.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
    if(new RegExp("("+ k +")").test(format))
    format = format.replace(RegExp.$1,RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length));
    return format;
}   
function defaultInput(tag,defaultval,cssName,blurCssName){
	if($(tag).val()!=''){
		if(blurCssName){
			$(tag).removeClass(cssName).addClass(blurCssName);
		}else{
			$(tag).css('color','#333333');
		}
		return;
	}
	$(tag).val(defaultval);
	cssName=cssName||'';
	blurCssName=blurCssName||'';
	if(cssName){
		$(tag).addClass(cssName);
	}else{
		$(tag).css('color','#808080');
	}
	$(tag).focus(function(){
		$(this).val('');
		if(blurCssName){
			$(tag).removeClass(cssName).addClass(blurCssName);
		}else{
			$(tag).css('color','#333333');
		}
	}).blur(function(){
		if($.trim($(tag).val())==''){
			$(tag).val(defaultval);
			if(cssName){
				$(tag).addClass(cssName);
			}else{
				$(tag).css('color','#808080');
			}
		}
	});
}
function islogin(fun){
	fun=fun||function(){};
	qajax(HOST+'user/login/islogin.htm',{},function(ret){
		if(ret.flag!=1){
			dialogLogin(fun);
		}else{
			fun();
		}
	})
}

function chkBrowser(){
	var bro=$.browser;
    var binfo="";
    if(bro.msie) {binfo="IE "+bro.version;}
    if(bro.mozilla) {binfo="Mozilla Firefox "+bro.version;}
    if(bro.safari) {binfo="Apple Safari "+bro.version;}
    if(bro.opera) {binfo="Opera "+bro.version;}
    return binfo;
}
$(function(){
//	alert(chkBrowser())
})
function AddFavorite(URL,Title){
	try{
		window.external.addFavorite(URL,Title);
	}
	catch (e){
		try{
			window.sidebar.addPanel(Title,URL,"");
		}
		catch (e){
			alert("加入收藏失败，请使用Ctrl+D进行添加");
		}
	}
}

function dialogLogin(){
	
	QC.msg_e('请先登录',function(){
		QC.reload(RHOST+'user/login');
	});
	return false;
}