<?php 
error_reporting(0);
$useraccount=trim($_COOKIE["manage_useraccount"]);
$manage_remuseraccount=trim($_COOKIE["manage_remuseraccount"]);
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
<body scroll="no" onkeydown="javascript:keyLogin(event);" style="background-image: url('img/login-logo1.jpg');">
<!--  <div class="login-header">
		<div class="logoing"><img src="img/login-logo.png"></div>
	</div>-->
	<div class="login-main">
		<div class="login-coc">
			<div class="login-operation">
				
				<div style="width:60px;height:60px;background:#5b8cff;border-radius:50%;position:relative;top:-50px;left:150px;
			box-shadow:4px 4px 4px rgba(0,0,0,0.1);z-index:99">
				<img src="img/login-logo.png" style="width:40px;margin:14px 10px 0">
			</div>
				<h2>基础管理</h2>
				<div class="login_action_con">
				  <table width="100%">
					  <input type="hidden" value="baseManagement" id="apptype" >
				   	<tr>
				   		<th>账号:</th>
				   		<td><input class="hmui-input" style="width: 244px;"  name="useraccount" id="useraccount" value="" placeholder="请输入账号"></td>
				   	</tr>
				   	 <tr>
				   		<th>密码:</th>
				   		<td><input class="hmui-input"  style="width: 244px;" type="password" name="password" id="password" maxlength="50"  placeholder="请输入密码" value=""></td>
				   	</tr>
				   	<tr>
				   		<th>验证码:</th>
				   		<td>
				   		<ul>
				   			<li><input class="hmui-input" style="width: 156px;" type="text" placeholder="请输入验证码" id="maskcode"></li>
				   			<li><img style='display: block;height:29px;margin-top:2px;' class="maskimg" src="../../../com/base/common/ValidationCode.class.php"name="maskimg" id="maskimg" onclick="refreshmask();" /></li>
				   		</ul>
				   		</td>
				   	</tr>
			
				   	   
				  	<tr>
				   		<th></th>
				   		<td>
				   		<ul>
				   		<li><input style="width: 18px;height: 18px;margin-bottom:-5px;" type="checkbox"name="remuseraccount" id="remuseraccount" value="1"  <?php if(strcasecmp($manage_remuseraccount,"1")==0) echo "checked"?> /></li>
				   		<li style="color:#999;margin:-1px 0 2px 5px">记住账号</li>
				   		</ul>
				   
				   
				   		</td>
				   	</tr>
				   		<tr>
				   		
				   		<td colspan=2>
				   		<input type="button" value="登录"  id="login_btn">
				   		
				   		</td>
				   	</tr>
				  </table>
				
				</div>
				

				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


</body>
</html>
<script type="text/javascript" src="js/login_t.js"></script>