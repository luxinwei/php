<?php 
include dirname(__FILE__)."/../com/base/util/ParaUtil.class.php";
include_once(dirname(__FILE__)."/../com/base/util/phpqrcode.php");
$fronturl=ParaUtil::getInstance()->getContent("FRONTURL")."/wap";
ob_clean();//这个一定要加上，清除缓冲区
QRcode::png(urldecode($fronturl),false,0,7,2);
//QRcode::png($fronturl,false,H,7,5);

?>