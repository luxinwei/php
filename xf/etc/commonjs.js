var fileServerUrl="hm/upload";
var rootPath="hm";
importJC(rootPath+"/etc/css/base.css", "css");
importJC(rootPath+"/etc/js/jquery.js", "js");
importJC(rootPath+"/etc/js/jquery-ui/jquery-ui.js", "js");
importJC(rootPath+"/etc/js/common/function.js", "js");
importJC(rootPath+"/etc/js/jquery.SuperSlide.2.1.js", "js");
importJC(rootPath+"/etc/js/DatePicker/WdatePicker.js", "js");
importJC(rootPath+"/etc/js/common/jquery.mypagination.js", "js");

importJC(rootPath+"/etc/js/validator/jquery.validator.css", "css");
importJC(rootPath+"/etc/js/validator/jquery.validator.js", "js");
importJC(rootPath+"/etc/js/validator/local/zh_CN.js", "js");

importJC(rootPath+"/etc/js/layui/css/layui.css", "css");
importJC(rootPath+"/etc/js/layui/layui.js", "js");
importJC(rootPath+"/etc/js/layui/lay/dest/layui.all.js", "js");

importJC(rootPath+"/etc/js/common/smallslider/jquery.smallslider.js", "js");
importJC(rootPath+"/etc/js/common/smallslider/smallslider.css", "css");
importJC(rootPath+"/etc/js/MSClass2.85.js", "js");

importJC(rootPath+"/etc/css/font-awesome/css/font-awesome.min.css", "css");
//importJC(rootPath+"/etc/js/dialog/zDialog.js", "js");
//importJC(rootPath+"/etc/js/dialog/zDrag.js", "js");

//importJC(rootPath+"/etc/js/MSClass2.85.js", "js");

//importJC(rootPath+"/etc/getmembers.js", "js");



function importJC(pathx, type){
  if (type == "css") {
      str="<link href=\"" + pathx + "\" rel=\"stylesheet\" type=\"text/css\"></link>";
  }else{ 
      str="<script src=\"" + pathx + "\"></script>";
  }
  document.write(str); 
}
function loginfn(){
	layer.open({
		  type: 2,
		  title: "<font class='fm f16 fb'>您尚未登录</font>",
		  shadeClose: true,
		  shade: 0.2,
		  area: ['480px', '250px'],
		  content: rootPath+"/vip/login/login_block.php"
		}); 
	
}