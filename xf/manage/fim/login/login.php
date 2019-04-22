<?php 
error_reporting(0);
$useraccount=trim($_COOKIE["manage_useraccount"]);
$manage_remuseraccount=trim($_COOKIE["manage_useraccount"])

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title></title>
<script src="../../../etc/commonjs.php"></script>
<link href="js/login.css" rel="stylesheet" type="text/css">
</head>
<body scroll="no" onkeydown="javascript:keyLogin(event);">
	<div class="login_top_bg_out">
		<div class="login_top_bg"></div>
	</div>
	<div class="login_center_bg"
		style="background: url(js/img/login_center_bg.jpg) no-repeat top center;">
		<form name="myform" method="post">
			<table width="313" border="0" align="right" cellpadding="0"
				cellspacing="0" class="login_table">
				<tr>
					<td width="80" height="35" align="right">会员账号：</td>
					<td><input class="logintxt" name="useraccount" id="useraccount" value="<?php echo $useraccount;?>" maxlength="20" /></td>
				</tr>
				<tr>
					<td height="35" align="right">密 码：</td>
					<td height="35"><input class="logintxt" type="password" name="password" id="password" maxlength="50" value="" /></td>
				</tr>
				<tr>
					<td height="35" align="right">验证码：</td>
					<td height="35">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><input class="logintxt1" name="maskcode" id="maskcode" maxlength="4" value="" /></td>
								<td><img style='display: block;' class="maskimg"
									src="../../../com/base/common/ValidationCode.class.php"
									name="maskimg" id="maskimg" onclick="refreshmask();" /></td>
							</tr>
						</table>


					</td>
				</tr>
				<tr>
					<td height="35" colspan="2" align="left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
						name="remuseraccount" id="remuseraccount" value="1"  <?php if(strcasecmp($manage_remuseraccount,"1")==0) echo "checked"?> />记住账号
					</td>
				</tr>
				<tr>
					<td height="35" colspan="2" align="center"><img
						style="cursor: pointer;" src="js/img/login_button_submit.gif"
						width="79" height="33" id="login_btn" /> &nbsp;&nbsp;&nbsp;
						<img style="cursor: pointer;" src="js/img/login_button_reset.gif"
						width="80" height="34" onclick="document.myform.reset();" /></td>
				</tr>
				<tr>
					<td height="35" colspan="2" align="center"><img
						src="js/img/login_copy.gif" width="254" height="27" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div align=center>系统推荐屏幕分辨率为 ：1600*900像素以上，服务热线：0371-63365860！</div>

</body>
</html>
<script type="text/javascript" src="js/login.js"></script>