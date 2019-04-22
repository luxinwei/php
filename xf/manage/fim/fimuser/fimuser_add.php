<?php include '../../../manage/include/page/top.php';?>
<?php
	$keyvalue=Fun::request("key");
	$obj=DB::getInstance()->getOneObjByKey("csm_member","USERCODE", $keyvalue);
	$fimGroup =new FimGroup();
?>
<style type="text/css">
.supplysltImg{cursor:pointer;border: 2px solid #d7d7d7;width:73px;height:73px;}
.supplysltImg:hover{cursor:pointer;border: 2px solid #E9AAA5;}
/*上传ul*/
.upload{}
.upload li{float:left;line-height:35px;}
</style>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<caption  class="alert_info">基本信息</caption>
<tr>
	<th  width="200"><font color="red">*</font>账号：</th>
	<td>
		<input name="useraccount" id="useraccount"   style="width:300px;" >
	</td>
</tr>
<tr>
	<th ><font color="red">*</font>昵称：</th>
	<td><input style="width: 300px;" name="nickname" id="nickname" ></td>
</tr>
<tr>
	<th >联系手机(不能重复)：</th>
	<td><input style="width: 300px;" name="mobile" id="mobile"></td>
</tr>
<tr>
	<th >联系邮箱(不能重复)：</th>
	<td><input style="width: 300px;" name="email" id="email"></td>
</tr>



<tr>
	<th >密码：</th>
	<td>
	<input style="width: 300px;" type="password" name="pwd" id="pwd"  value="123456">默认密码为123456
	</td>
</tr>
<tr>
	<th >有效期：</th>
	<td><input style="width: 300px;" name="endtime" id="endtime" maxlength="10" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" class="Wdate">
	有效期如果为空，则永久有效
	</td>
</tr>


<tr   style="display: none;">
	<th >机构：</th>
	<td>
	<select style="width: 300px;" name="orgid" id="orgid">
	<option value="">请选择所在机构</option>
	<?php // echo FimOrg::getInstance()->getMenuSelectOptionAtNews($obj["ORGID"])?>
	</select>
	</td>
</tr>
<tr>
	<th >角色：</th>
	<td>
	<select style="width: 300px;" name="fimgroupid" id="fimgroupid">
	<option value="">--</option>
	<?php  echo $fimGroup->getSelectOptionStr("")?>
	</select>
	</td>
</tr>
<tbody style="display: none;">
<tr>
	<th >联系地址：</th>
	<td>
	<input type="hidden" name="linkarea" id="linkarea" >
	<select name="province" id="province"></select>
	<select name="city" id="city"></select>
	<select name="area" id="area"></select>
	<span id="linkarea_msg"></span>
	
	
	</td>
</tr>
<tr>
	<th >联系地址(详细地址)：</th>
	<td><input style="width: 300px;" name="linkaddress" id="linkaddress"></td>
</tr>
<tr>
	<th >邮编：</th>
	<td><input style="width: 300px;" name="linkpost" id="linkpost"></td>
</tr>
<tr>
	<th >固定电话-：</th>
	<td><input style="width: 300px;" name="linktel" id="linktel"></td>
</tr>


<tr>
	<th >QQ：</th>
	<td><input style="width: 300px;" name="qq" id="qq"></td>
</tr>
<tr>
	<th >MSN：</th>
	<td><input style="width: 300px;" name="msn" id="msn"></td>
</tr>
<tr>
	<th >阿里旺旺：</th>
	<td><input style="width: 300px;" name="ww" id="ww"></td>
</tr>

<tr>
	<th >头像：</th>
	<td><input type="hidden" name="pic" id="pic" class="uploadsinglepic" tip=""  uploadparam="<?php echo Fun::encode("COMMON_PIC");?>" value=""/><div id="pic_con"></div></td>
</tr>
</tbody>

	<tr>
		<td></td>
		<td>
		<input class="layui-btn layui-btn-normal" type="submit" name="ok" value="确 定"/>
		<input class="layui-btn layui-btn-primary" type="button" name="ok" value="返回" id="backhistory"/>
		
		</td>
	</tr>
</table>
</form>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/common/pcasunzip.js"></script>
<script type="text/javascript" src="js/fimuser_add.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>