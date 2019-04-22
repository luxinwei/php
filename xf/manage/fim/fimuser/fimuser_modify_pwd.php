<?php include '../../../manage/include/page/top.php';?>

<?php
	$keyvalue=Fun::request("key");
	$obj=DB::getInstance()->getOneObjByKey("csm_member","USERCODE", $keyvalue);
?>
<style type="text/css">
.supplysltImg{cursor:pointer;border: 2px solid #d7d7d7;width:73px;height:73px;}
.supplysltImg:hover{cursor:pointer;border: 2px solid #E9AAA5;}
/*上传ul*/
.upload{}
.upload li{float:left;line-height:35px;}
</style>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="usercode" id="usercode"  value="<?php echo($obj["USERCODE"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption>修改密码</caption>
<tr>
	<th  width="200">编号：</th>
	<td><?php echo($obj["USERCODE"]);?></td>
</tr>
<tr>
	<th>账号：</th>
	<td><?php echo($obj["USERACCOUNT"]);?></td>
</tr>
<tr>
	<th ><font color="red">*</font>昵称：</th>
	<td><?php echo($obj["NICKNAME"]);?></td>
</tr>
<tr>
	<th >联系手机：</th>
	<td><?php echo($obj["MOBILE"]);?></td>
</tr>
<tr>
	<th >联系邮箱：</th>
	<td><?php echo($obj["EMAIL"]);?></td>
</tr>
<tr>
	<th >密码：</th>
	<td><input style="width: 200px;" type="password" name="pwd" id="pwd"  value="123456">默认密码为123456</td>
</tr>
<tr>
		<td></td>
		<td>
		<input class="button_paleblue4" type="button" name="ok" value="确 定" id="okfn"/>
		<input class="button_paleblue4" type="button" name="ok" value="返回" id="backhistory"/>
		
		</td>
</tr>
</table>
</form>
<script type="text/javascript" src="js/fimuser_modify_pwd.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>