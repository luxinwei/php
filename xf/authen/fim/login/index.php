<?php 
error_reporting(0);
include dirname(__FILE__)."/../../../com/base/util/DB.class.php";
include dirname(__FILE__)."/../../../com/base/util/Fun.class.php";
include dirname(__FILE__)."/../../../com/base/util/ParaUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/CodeUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/DicationaryUtil.class.php";
include dirname(__FILE__)."/../../../com/base/util/FileUtil.class.php";
include dirname(__FILE__)."/../../../com/base/InterfaceUtil.class.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
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
</head>
<body>



<div>
<!-- 		<input type="button" value="业主平台" class="hmui-btn ml10" name="login_btn" mobile="15981943222" apptype="ownerDepartment" password="123456"/>
		<input type="button" value="监控平台" class="hmui-btn ml10" name="login_btn" mobile="15981943221" apptype="monitorCenter" password="123456"/>
		<input type="button" value="基础平台" class="hmui-btn ml10" name="login_btn"  mobile="13938503678" apptype="baseManagement" password="123456"/> -->
		<div style="width:500px;
    height:100px;
    position:absolute;
    top:50%;
    left:45%;
    margin-top:-50px;
    margin-left:-50px;">
		<a href="loginowner.php"><input type="button" value="业主平台" class="hmui-btn ml10" name="login_btn" /></a>
		<a href="loginmonitor.php"><input type="button" value="监控平台" class="hmui-btn ml10" name="login_btn" /></a>
		<a href="loginbase.php"><input type="button" value="基础平台" class="hmui-btn ml10" name="login_btn" /></a>
		</div>
		
</div>

</body>
</html>
