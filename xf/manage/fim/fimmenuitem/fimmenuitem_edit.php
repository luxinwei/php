<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimMenuitem.class.php';?>
<?php
	$keyvalue=Fun::request("keyvalue");
	$parentid=Fun::request("parentid");
	$parent_obj=array();//父亲对象
	$obj=FimMenuitem::getInstance()->getOne($keyvalue);//当前对象
	if(!empty($obj)){	
		$parent_obj=FimMenuitem::getInstance()->getOne($obj["PARENTID"]);
	}else{
		$parent_obj=FimMenuitem::getInstance()->getOne($parentid);
	}
	if(empty($parent_obj)){
		$parent_obj=FimMenuitem::getInstance()->getRoot();
	}	
	$target=trim($obj["TARGET"]);
	$valid=trim($obj["VALID"]);
?>
<form name="myform"  id="myform" method="post"   autocomplete="off">
<input type="hidden" name="id" id="id"  value="<?php echo($obj["ID"]);?>">
<input name="parentid" id="parentid" type="hidden"  value="<?php echo($parent_obj["ID"]);?>">
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="box_keep">
<tr>
	<td>
	[父菜单：<font class="cred fb"><?php echo($parent_obj["TITLE"]);?></font>]
	菜单名称：<input name="title" id="title"  value="<?php echo($obj["TITLE"]);?>">
	打开目标:
	<select name="target" id="target">
			<option  value=""       <?php if(strcasecmp($target,"")==0)       echo "selected"?>>当前页</option>
			<option  value="_blank" <?php if(strcasecmp($target,"_blank")==0) echo "selected"?>>新页面</option>
			<option  value="_top"   <?php if(strcasecmp($target,"_top")==0)   echo "selected"?>>父窗口</option>
	</select>
	是否有效：<select name="valid" id="valid"><?php echo CodeUtil::getInstance()->getSelectOptionCodeStr("SF", $valid)?></select>
	图标样式：<input name="smallicon" id="smallicon"  value="<?php echo($obj["SMALLICON"]);?>">
	<font onclick="SelectFontAwesome()" style="cursor:pointer;">[选择图标]</font>
	<input class="button_paleblue4" type="submit" name="ok" value="确 定"/>
	</td>
</tr>

<td>链接地址：<input name="linkurl" id="linkurl"  style="width:500px;" value="<?php echo($obj["LINKURL"]);?>"></td>
</tr>
<tr>
<td>权限标志：<input name="qxbz" id="qxbz"   style="width:500px;" value="<?php echo($obj["QXBZ"]);?>"></td>
</tr>
</table>
</form>
<script type="text/javascript" src="js/fimmenuitem_edit.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>