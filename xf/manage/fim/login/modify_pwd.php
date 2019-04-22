<?php 
error_reporting(0);
include '../../../com/base/util/DB.class.php';
include("../../../com/base/util/Fun.class.php");
include("../../../com/base/util/ParaUtil.class.php");
include dirname(__FILE__)."/../../../manage/include/page/session_manage.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<script src="../../../etc/commonjs.php"></script>
<link rel="stylesheet" type="text/css" href="../../../manage/etc/css/main.css" />

<title>-----</title>
<style type="text/css">
body{margin:0px;padding:0px;}
</style>
</head>
<body>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="usercode" id="usercode"  value="<?php echo($obj["USERCODE"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption>修改密码</caption>
<tr>
	<th width="150"><font color="red">*</font>账号：</th>
	<td><?php echo($manageuseraccount);?></td>
</tr>
<tr>
    <th align="right"><font color="#FF0000">*</font>原始密码：</th>
    <td><input name="oldpassword" type="password" id="oldpassword" maxlength="50"  value=""/></td>
    </tr>
  <tr>
    <th align="right"><font color="#FF0000">*</font>新密码：</th>
    <td><input name="newpassword" type="password" id="newpassword" maxlength="50"  value=""/></td>
    </tr>
  <tr>
    <th align="right"><font color="#FF0000">*</font>确认新密码：</th>
    <td><input name="newpassword1" type="password" id="newpassword1" maxlength="50"  value=""/></td>
    </tr>

<tr>
		<td></td>
		<td>
		<input class="button_paleblue4" type="button" name="ok" value="确 定" id="okfn" onclick="checkform();"/>
		
		</td>
</tr>
</table>
</form>
<script type="text/javascript" src="js/modify_pwd.js"></script>

<?php include '../../../manage/include/page/bottom.php';?>