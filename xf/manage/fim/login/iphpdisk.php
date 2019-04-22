<?php 
##
#	Project: PHPDisk Probe
#	This is NOT a freeware, use is subject to license terms.
#
#	Site: http://www.phpdisk.com
#
#	$Id: iphpdisk.php 267 2010-01-13 13:31:48Z along $
#
#	Copyright (C) 2008-2014 PHPDisk Team. All Rights Reserved.
#
##
error_reporting(E_ALL ^E_NOTICE);
header("Content-Type: text/html; charset=utf-8");
$mysql_host = 'localhost';
$phpself = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
define("PHPSELF", preg_replace("/(.{0,}?\/+)/", "", $phpself));
define('VERSION','2.1');
define('RELEASE','20140316');
define('YES','<span class="f12 txtblue">支持</span>');
define('NO','<span class="f12 txtred">不支持</span>');

$action = isset($_GET['action']) ? trim($_GET['action']) : trim($_POST['action']);
switch($action){
	case 'phpinfo':
		phpinfo();
		echo '<script>document.title="PHPDisk专用探针 v'.VERSION.' release'.RELEASE.'";</script>';
		exit;
	break;
	case 'mysql_test':
		$mysql_host = trim($_POST['mysql_host']);
		$mysql_user = trim($_POST['mysql_user']);
		$mysql_pwd = trim($_POST['mysql_pwd']);
		$mysql_dbname = trim($_POST['mysql_dbname']);
		$mysql_str = '';
		
		if($mysql_host =='' || $mysql_user =='' || $mysql_pwd =='' || $mysql_dbname ==''){
			$mysql_str .= '<span class="txtred">数据库测试信息不能为空，请确认。</span>';
		}else{
			$mysql_str = '<b>数据库测试结果：</b><br>';
			$mysql_str .= "数据库主机 <i>{$mysql_host}</i> 连接... ";
			$link = @mysql_connect($mysql_host,$mysql_user,$mysql_pwd);
			$mysql_str .= $link ? '<span class="txtblue">成功</span>' : '<span class="txtred">失败</span>';
			$mysql_str .= '<br>';
			$result = @mysql_select_db($mysql_dbname);
			$mysql_str .= "数据库 <i>{$mysql_dbname}</i> 连接... ";
			$mysql_str .= $result ? '<span class="txtblue">成功</span>' : '<span class="txtred">失败</span>';
			$mysql_str .= 'mysql_server 版本：<span class="txtblue">'.@mysql_get_server_info().'</span><br>';
			$mysql_str .= 'mysql_client 版本：<span class="txtblue">'.@mysql_get_client_info().'</span>';
		}
	break;
}
if(!ini_get('short_open_tag')){
	echo '<h2 align="center" style="color:#FF0000;font-weight:bold">php.ini 配置 short_open_tag 没有开启，PHPDISK探针将以精简模式运行。</h2>';
	echo '<h2 align="center" style="color:#0000FF;font-weight:bold">请配置您现在PHP环境的 php.ini并把<u>short_open_tag</u>的值设置为On，再运行本探针。</h2>';
	phpinfo();
	echo '<script>document.title="PHPDisk专用探针 v'.VERSION.' release'.RELEASE.'";</script>';
	exit();
}

$post_max_size = ini_get("post_max_size");
$upload_max_filesize = ini_get("upload_max_filesize");
$phpdisk_max_filesize = get_size(min(get_byte_value($post_max_size),get_byte_value($upload_max_filesize)));
function is_func($func){
	return function_exists($func) ? YES : NO;
}
function get_size($s,$u='B',$p=1){
	$us = array('B'=>'K','K'=>'M','M'=>'G','G'=>'T');
	return (($u!=='B')&&(!isset($us[$u]))||($s<1024))?(number_format($s,$p)." $u"):(get_size($s/1024,$us[$u],$p));
}
function get_gd_info(){
	if(function_exists('gd_info')){
		$gd_info_arr = gd_info();
		return $gd_info_arr['GD Version'];
	}else{
		return '<span class="txtred">请开启PHP GD库支持</span>';
	}
}
function get_cfg($val){
	return ini_get($val) ? YES : NO;
}
function get_byte_value($v){
	$v = trim($v);
	$l = strtolower($v[strlen($v) - 1]);
	switch($l){
	  case 'g':
		$v *= 1024;
	
	  case 'm':
		$v *= 1024;
	
	  case 'k':
		$v *= 1024;
	}
	return $v;
}
function show_mysql_test(){
	return function_exists('mysql_connect') ? '<a href="javascript:void(0);" onclick="show_form();">MySQL连接测试<span class="txtred">【可测试探针所在机器是否能连接远程数据库】</span></a>' : '';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="PHPDISK网盘专用探针" />
<meta name="author" content="PHPDisk Team" />
<title>PHPDISK网盘专用探针 Version <?php echo VERSION?> Release <?php echo RELEASE?></title>
<style type="text/css">
body{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px}
a{color:#4A6EA5; text-decoration:none}
a:hover{text-decoration:underline}
#container{width:800px; margin:auto;}
#container h1{color:#4A6EA5; margin-left:6px}
#nav{}
#nav ul{list-style:none}
#nav ul li{float:left;width:80px}
.f14{font-size:14px}
.ff{font-size:80px}
.txtgray{color:#666}
.txtblue{color:#0000FF}
.txtred{color:#FF0000}
.txtgreen{color:#008800}
.clear{clear:both}

.td_style{border:1px #4A6EA5 solid}
.td_style .tit{font-size:14px; font-weight:bold; background:#9EB6D8; }
.td_style td{ padding:6px; border-bottom:1px #CCCCCC dotted}
</style>
</head>

<body>
<div id="container">
	<div>
		<h1><a href="<?php echo $phpself?>" title="在梦想的路上，我们一直在用心创造">PHPDISK</a> <span class="txtgray f14">网盘专用探针 Version <?php echo VERSION?> Release <?php echo RELEASE?></span></h1>
	</div>
	<table align="center" width="98%" cellpadding="4" cellspacing="1" border="0" class="td_style" id="news_banner_wrap" style="display:none">
	<tr>
		<td>
	<div>
		<iframe id="news_banner" style="z-index: 1;visibility: inherit; overflow: auto; width: auto; height: 20px;" frameborder="0" scrolling="no"></iframe>
	</div>
	</td>
	</tr>
	</table>
	<Br>
	<table align="center" width="98%" cellpadding="4" cellspacing="1" border="0" class="td_style">
	<tr>
		<td colspan="2" class="tit">服务器基本信息：</td>
	</tr>
	<tr>
		<td width="30%">服务器主机系统</td>
		<td><?php echo php_uname()?></td>
	</tr>
	<tr>
		<td>PHP运行方式</td>
		<td><?php echo php_sapi_name()?></td>
	</tr>
	<tr>
		<td>PHP版本</td>
		<td><?php echo PHP_VERSION?></td>
	</tr>
	<tr>
		<td>服务器域名/IP地址</td>
		<td><?php echo $_SERVER['SERVER_NAME']?>(<?php echo @gethostbyname($_SERVER['SERVER_NAME'])?>)</td>
	</tr>
	<tr>
		<td>服务器时区/时间</td>
		<td><?php echo @date_default_timezone_get()?> / <?php echo date("Y年n月j日 H:i:s")?> <span class="txtgray">(北京时间: <?php echo gmdate("Y年n月j日 H:i:s",time()+8*3600)?>)</span></td>
	</tr>
	<tr>
		<td>服务器解释引擎</td>
		<td><?php echo $_SERVER['SERVER_SOFTWARE']?></td>
	</tr>
	<tr>
		<td>Web服务端口</td>
		<td><?php echo $_SERVER['SERVER_PORT']?></td>
	</tr>
	<tr>
		<td>探针真实地址</td>
		<td><?php echo $_SERVER['DOCUMENT_ROOT'].$phpself?></td>
	</tr>
	<tr>
		<td>当前剩余空间</td>
		<td><?php echo get_size(@disk_free_space(dirname(__FILE__)))?></td>
	</tr>
	<tr>
		<td class="txtred">当前正在使用的 php.ini 位置</td>
		<td><?php echo function_exists('php_ini_loaded_file') ? php_ini_loaded_file() : '请查看 phpinfo';?></td>
	</tr>
	<tr>
		<td>PHPINFO PHP详细配置</td>
		<td><a href="<?php echo $phpself?>?action=phpinfo" target="_blank">PHPINFO</a></td>
	</tr>
	</table>
	
	<br />
	<a name="a2" id="a2"></a>
	<table align="center" width="98%" cellpadding="4" cellspacing="1" border="0" class="td_style">
	<tr>
		<td colspan="2" class="tit">PHP环境配置：</td>
	</tr>
	<tr>
		<td width="30%">MySQL数据库</td>
		<td><?php echo is_func('mysql_connect')?>&nbsp;&nbsp;<?php echo show_mysql_test()?></td>
	</tr>
	<tbody id="mysql_form" style="display:none">
	<form action="<?php echo $phpself?>#a2" method="post" onsubmit="dosubmit(this);">
	<input type="hidden" name="action" value="mysql_test" />
	<tr>
		<td>&nbsp;<?php echo $mysql_str?></td>
		<td>
		服务器地址&nbsp;<input type="text" name="mysql_host" value="<?php echo $mysql_host?>" /><br />
		数据库用户&nbsp;<input type="text" name="mysql_user" value="<?php echo $mysql_user?>" /><br />
		数据库密码&nbsp;<input type="text" name="mysql_pwd" value="<?php echo $mysql_pwd?>" /><br />
		数据库名称&nbsp;<input type="text" name="mysql_dbname" value="<?php echo $mysql_dbname?>" />&nbsp;&nbsp;<input type="submit" name="s1" value="测试" /> 
		</td>
	</tr>
	</form>
	</tbody>
	<tr>
		<td>图形处理库 GD Library</td>
		<td><?php echo is_func('gd_info')?> (<?php echo get_gd_info()?>)</td>
	</tr>
		<tr>
		<td>用户访问文件的活动范围限制 open_basedir</td>
		<td><?php echo ini_get("open_basedir") ? ini_get("open_basedir") : '无'?></td>
	</tr>	
	<tr>
		<td>字符转换函数支持</td>
		<td>iconv <?php echo is_func('iconv')?> 或 mbstring <?php echo is_func('mb_convert_encoding')?> <span class="txtgray">(针对中文字符编码进行转换，没有安装文字将会出现乱码。)</span></td>
	</tr>
	<tr>
		<td>&lt;?=?&gt;短标签支持(short_open_tag)：</td>
		<td><?php echo ini_get("short_open_tag") ? YES : NO ?></td>
	</tr>
	<tr>
		<td>PHP安全模式运行</td>
		<td><?php echo ini_get("safe_mode") ? YES : NO ?>&nbsp;&nbsp;<span class="txtred">(为了服务器安全，建议关闭)</span></td>
	</tr>
	<tr>
		<td>压缩文件支持(Zlib)</td>
		<td><?php echo is_func("gzopen")?></td>
	</tr>
	<tr>
		<td>fsockopen函数支持</td>
		<td><?php echo is_func("fsockopen")?>&nbsp;&nbsp;<span class="txtred">(若不支持，发送邮件功能将不能使用)</span></td>
	</tr>
	<tr>
		<td>FTP函数支持</td>
		<td><?php echo is_func("ftp_connect")?></td>
	</tr>
	<tr>
		<td>OpenSSL支持</td>
		<td><?php echo is_func("openssl_open")?></td>
	</tr>
	<tr>
		<td>CURL函数支持</td>
		<td><?php echo is_func("curl_init")?></td>
	</tr>
	<tr>
		<td>is_dir函数支持</td>
		<td><?php echo is_func("is_dir")?></td>
	</tr>
	<tr>
		<td>目录搜索scandir函数支持</td>
		<td><?php echo is_func("scandir")?></td>
	</tr>
	<tr>
		<td>文件遍历glob函数支持</td>
		<td><?php echo is_func("glob")?></td>
	</tr>
	<tr>
		<td>允许使用URL打开文件 allow_url_fopen</td>
		<td><?php echo get_cfg("allow_url_fopen")?>&nbsp;&nbsp;<span class="txtred">(为了服务器安全，建议关闭)</span></td>
	</tr>
	<tr>
		<td>程序最多允许使用内存量 memory_limit</td>
		<td><?php echo ini_get("memory_limit")?>&nbsp;&nbsp;<span class="txtgray">(如果出现文件上传后没有显示的问题，请适当将此值改大。)</span></td>
	</tr>
	<tr>
		<td>POST表单最大字节数 post_max_size</td>
		<td><?php echo ini_get("post_max_size")?>
		<?php if(!@ini_get("post_max_size") || get_byte_value('999M')<get_byte_value(@ini_get("post_max_size"))){?>
		<span class="txtred">(理论上，php.ini 只允许设置最大值为 999M ，设置过大时会产生运行异常！！！)</span>
		<?php }?>
		</td>
	</tr>
	<tr>
		<td>允许最大上传文件 upload_max_filesize</td>
		<td><?php echo ini_get("upload_max_filesize")?>
		<?php if(!@ini_get("upload_max_filesize") || get_byte_value('999M')<get_byte_value(@ini_get("upload_max_filesize"))){?>
		<span class="txtred">(理论上，php.ini 只允许设置最大值为 999M ，设置过大时会产生运行异常！！！)</span>
		<?php }?><br />
		<span class="txtblue">(当前环境PHPDISK可上传单个文件的最大值为<u class="txtred"><?php echo $phpdisk_max_filesize?></u>，推荐单个文件的大小在50MB以内)</span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#FFFADC;border:1px solid #FFE3A0"><a href="http://www.phpdisk.com/" target="_blank" class="f14 txtgreen">〖如果需要支持大文件上传，断点续传等文件上传方式，可以使用我们的网盘系统客户端软件进行上传。〗</a></td>
	</tr>	
	<tr>
		<td>程序运行超时时间 max_execution_time</td>
		<td><?php echo ini_get("max_execution_time")?> 秒</td>
	</tr>
	<tr>
		<td>上传临时目录 upload_tmp_dir</td>
		<td><?php echo ini_get("upload_tmp_dir") ? ini_get("upload_tmp_dir") : '默认(建议手动指定目录)'?>&nbsp;&nbsp;<span class="txtgray">(请确认此目录拥有读写权限。)</span></td>
	</tr>
	<tr>
		<td>Session支持</td>
		<td><?php echo is_func('session_start')?></td>
	</tr>
	<tr>
		<td>Session临时目录 session.save_path</td>
		<td><?php echo ini_get('session.save_path') ? ini_get('session.save_path') : '默认(建议手动指定目录)'?>&nbsp;&nbsp;<span class="txtgray">(请确认此目录拥有读写权限。)</span></td>
	</tr>
	<tr>
		<td>自定义全局变量 register_globals</td>
		<td><?php echo get_cfg("register_globals")?>&nbsp;&nbsp;<span class="txtgray">(PHP5 以上默认关闭。)</span></td>
	</tr>
	<tr>
		<td>显示错误信息 display_errors</td>
		<td><?php echo get_cfg("display_errors")?></td>
	</tr>
	<tr>
		<td>PHP错误信息 error_reporting</td>
		<td><?php echo ini_get("error_reporting")?></td>
	</tr>
	<tr>
		<td>禁用的函数 disable_functions</td>
		<td style="word-break:break-all"><?php echo ini_get("disable_functions") ? ini_get("disable_functions") : '无'?>&nbsp;&nbsp;<br><span class="txtgray">(如果禁用了scandir目录遍历函数，请修改php.ini开启。)</span></td>
	</tr>
	<tr>
		<td>输出缓冲 output_buffering</td>
		<td><?php echo ini_get("output_buffering") ? ini_get("output_buffering") : '无'?></td>
	</tr>
	<tr>
		<td>服务PHP内存占用</td>
		<td><?php echo get_size(memory_get_usage())?></td>
	</tr>
	</table>
	<br /><br />
	<div align="center">
	<a href="http://www.phpdisk.com/">官方首页</a>&nbsp;
	<a href="http://demo.phpdisk.com/">在线演示</a>&nbsp;
	<a href="http://bbs.phpdisk.com" target="_blank">交流论坛</a>&nbsp;
	<a href="http://www.phpdisk.com/contact.html">联系方式</a>&nbsp;
	<a href="http://faq.phpdisk.com/">教程帮助</a>&nbsp;
	</div>
	<br />
	<div align="center" id="copyright"><a href="http://www.phpdisk.com/">PHPDisk Team</a> (C) 2008-2014 All Rights Reserved.</div></div>
<script type="text/javascript">
String.prototype.strtrim = function(){
	return this.replace(/(^\s*)|(\s*$)/g, "");
}
function g(id){
	return document.getElementById(id);	
}
function dosubmit(o){
	if(o.mysql_host.value.strtrim() ==''){
		alert('请输入数据库服务器地址。');
		o.mysql_host.focus();
		return false;
	}
	if(o.mysql_user.value.strtrim() ==''){
		alert('请输入数据库用户名。');
		o.mysql_user.focus();
		return false;
	}
	if(o.mysql_pwd.value.strtrim() ==''){
		alert('请输入数据库用户密码。');
		o.mysql_pwd.focus();
		return false;
	}
	if(o.mysql_dbname.value.strtrim() ==''){
		alert('请输入需要连接的数据库名称。');
		o.mysql_dbname.focus();
		return false;
	}
	o.s1.disabled = true;
}
function show_form(){
	return (g('mysql_form').style.display == '') ? g('mysql_form').style.display = 'none' : g('mysql_form').style.display = '';
}
function getnews(){
	g('news_banner').src = "http://www.phpdisk.com/iphpdisk_news.php";
	g('news_banner_wrap').style.display = "";
}
<? if(show_mysql_test()){?>
g('mysql_form').style.display = '';
<? }?>
setTimeout('getnews()',3000);
</script>	
</body>
</html>
