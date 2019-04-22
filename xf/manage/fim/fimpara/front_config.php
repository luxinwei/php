<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimPara.class.php';?>
<?php
	$allList=FimPara::getInstance()->getAllList();
	$FILESERVERURL_obj     = FimPara::getInstance()->getOneByAll("FILESERVERURL", $allList);
	$FILEUPLOADFOLDER_obj  = FimPara::getInstance()->getOneByAll("FILEUPLOADFOLDER", $allList);
	$FRONTROOT_obj         = FimPara::getInstance()->getOneByAll("FRONTROOT", $allList);
	$FRONTFOLDER_obj       = FimPara::getInstance()->getOneByAll("FRONTFOLDER", $allList);
	$FRONTTITLE_obj        = FimPara::getInstance()->getOneByAll("FRONTTITLE", $allList);
	$WEB_DESCRIPTION_obj   = FimPara::getInstance()->getOneByAll("WEB_DESCRIPTION", $allList);
	$WEB_KEYWORDS_obj      = FimPara::getInstance()->getOneByAll("WEB_KEYWORDS", $allList);	
	$KEYWORDLIST_obj       = FimPara::getInstance()->getOneByAll("KEYWORDLIST", $allList);

	$FRONTURL_obj          = FimPara::getInstance()->getOneByAll("FRONTURL", $allList);
	$XFURL_obj             = FimPara::getInstance()->getOneByAll("XFURL", $allList);
	$XFAPPCODE_obj         = FimPara::getInstance()->getOneByAll("XFAPPCODE", $allList);
	
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="box_keep">
<tr>
<td colspan="2" class="alert_info f12">系统设置</td>
</tr>
  <tr>
	  <th colspan="2" style="text-align:left;">网站前台设置</th>
  </tr>

  <tr>
    <th width="150px;">网站前台标题：</th>
    <td><input name="FRONTTITLE" style="width:500px;"  id="FRONTTITLE"  value="<?php echo $FRONTTITLE_obj["PARACONTENT"]?>" maxlength="255" /></td>
  </tr>
    <tr>
    <th>网站SEO关键字描述：</th>
    <td><textarea name="WEB_DESCRIPTION" style="width:500px;height:80px;"  id="WEB_DESCRIPTION"  ><?php echo $WEB_DESCRIPTION_obj["PARACONTENT"]?></textarea></td>
  </tr>
    <tr>
    <th>网站SEO关键字：</th>
    <td><textarea name="WEB_KEYWORDS" style="width:500px;height:80px;"  id="WEB_KEYWORDS"  ><?php echo $WEB_KEYWORDS_obj["PARACONTENT"]?></textarea></td>
  </tr>
   <tr>
    <th>首页顶部关键字：</th>
    <td><textarea name="KEYWORDLIST" style="width:500px;height:80px;"  id="KEYWORDLIST"  ><?php echo $KEYWORDLIST_obj["PARACONTENT"]?></textarea>用逗号分开</td>
  </tr>


   <tr>
	  <th colspan="2" style="text-align:left;">上传文件设置</th>
  </tr>
   <tr>
    <th>网站地址：</th>
    <td><input name="FRONTURL" style="width:500px;"  id="FRONTURL"  value="<?php echo $FRONTURL_obj["PARACONTENT"]?>" maxlength="255" />例如：http://192.168.16.26:8081/shop</td>
  </tr>
 <tr>
    <th>网站前台跟目录：</th>
    <td><input name="FRONTROOT" style="width:500px;"  id="FRONTROOT"  value="<?php echo $FRONTROOT_obj["PARACONTENT"]?>" maxlength="255" />例如：http://192.168.16.26:8081/bgw</td>
  </tr>
  <tr>
    <th>网站前台目录地址：</th>
    <td>
    <input class="input_text_reaonly" name="FRONTFOLDER" style="width:500px;"  id="FRONTFOLDER"  value="<?php echo $FRONTFOLDER_obj["PARACONTENT"]?>" maxlength="255" />
    <span style="cursor:pointer" onclick="getFrontFloder()">[获取地址]</span>
      例如：
     D:/workspacephp/site
    </td>
  </tr>
  <tr>
    <th>上传文件服务URL地址：</th>
    <td><input class="input_text_reaonly" name="FILESERVERURL" style="width:500px;"  id="FILESERVERURL"  value="<?php echo $FILESERVERURL_obj["PARACONTENT"]?>" maxlength="255" />
    例如： /upload或者http://192.168.16.26:8081/upload</td>
  </tr>

  <tr>
    <th>上传文件存放地址：</th>
    <td><input  class="input_text_reaonly" name="FILEUPLOADFOLDER" style="width:500px;"  id="FILEUPLOADFOLDER"  value="<?php echo $FILEUPLOADFOLDER_obj["PARACONTENT"]?>" maxlength="255" />
      <span style="cursor:pointer;" onclick="getPath()">[获取地址]</span>
      例如：D:/workspacephp/site/upload
    </td>
  </tr>
  <tr>
	  <th width="200">消防物联网监管平台URL：</th>
	   <td><input name="XFURL" style="width:500px;"  id="XFURL"  value="<?php echo $XFURL_obj["PARACONTENT"]?>" maxlength="255" /></td>
  </tr>
   <tr>
	  <th width="200">appCode：</th>
	   <td><input name="XFAPPCODE" style="width:500px;"  id="XFAPPCODE"  value="<?php echo $XFAPPCODE_obj["PARACONTENT"]?>" maxlength="255" /></td>
  </tr>
  
  <tr>
	    <td align="right" width="200">&nbsp;</td>
	    <td><input class="button_paleblue4" type="button" name="ok" value="确 定" onclick="checkform()" />
	    <input class="button_paleblue4" type="reset" name="reset" value="重 置" /></td>
	</tr>
</table>
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/front_config.js"></script>