selectData({activeId:"appcode",width:600,height:600,url:"accountmanagement_app_select.php",btntitle:"选择应用范围"});

$("#btn_role").bind("click", function(){
	var tourl="accountmanagement_role_select_pic.php";
	var iWidth=550; 
	var iHeight=500; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
$("#btn_app").bind("click", function(){
	var tourl="accountmanagement_app_select_pic.php";
	var iWidth=550; 
	var iHeight=500; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
