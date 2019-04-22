<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
</head>
<body>
<div class="m10">
<?php 
error_reporting(0);
include dirname(__FILE__)."/../../../com/base/util/DB.class.php";
include dirname(__FILE__)."/../../../com/base/util/Fun.class.php";
include dirname(__FILE__)."/../../../com/base/util/ParaUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/CodeUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/DicationaryUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/FileUtil.class.php";
include dirname(__FILE__)."/../../../com/base/InterfaceUtil.class.php";


include dirname(__FILE__)."/../../../authen/include/page/session_manage.php";
$m=Fun::request("m");

//禁止在 地址栏里输入 访问!
if(substr_count($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])==0){
	//echo ("禁止非法访问");
	//exit;
}
$navContent="";
?>
<script>
var fileServerUrl="<?php echo(ParaUtil::getInstance()->getFileServerUrl());?>";
var rootPath="<?php echo ParaUtil::getInstance()->getRoot();?>";

</script>

<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/css/base.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/common/function.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery.SuperSlide.2.1.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/common/jquery.mypagination.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/formvalidation/js/formvalidation.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/jquery.validator.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/local/zh_CN.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/lay/dest/layui.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/css/layui.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/getmembers.js"></script>

<script>
var m="<?php echo($m);?>";
var navContent="<?php echo($navContent);?>";

$(document).ready(function(){
var navObj=$(".bodynav .nav");
var navValue=navObj.html();
	if (navObj.length>0&&navValue=="")navObj.empty().append(navContent);
	//form_style();
});

function ajaxInitHeight(){
	  var main = $(window.parent.document).find("#mainFrame");
	  var thisheight = $(document).height()+30;
	  main.height(thisheight);
	  $(window.parent.document).find(".right").height(thisheight);
	  $(window.parent.document).find(".left").height(thisheight);
	}

</script>