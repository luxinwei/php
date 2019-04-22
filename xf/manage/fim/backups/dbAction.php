<?php error_reporting(0);?>
<?php include_once(dirname(__FILE__)."/../../../config.php");?>
<?php include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");?>
<?php
header ( "Content-type: text/html; charset=utf-8" );
$action=$_GET["action"];
$rootdir=str_ireplace("/manage/fim/backups/dbAction.php","",strtr(__FILE__,"\\","/"));
if (strcmp($action,"dbback")==0){
	$json = "{success:0,msg:'失败!'}";
	// 备份数据库
	$host     = sysconfig::DBHOST;
	$user     = sysconfig::DBUSER; //数据库账号
	$password = sysconfig::DBPWD; //数据库密码
	$dbname   = sysconfig::DBNAME; //数据库名称
	if(!mysql_connect($host, $user, $password)) {
		$json = "{success:0,msg:'数据库连接失败，请核对后再试!'}";
		echo ($json);
		exit;
	}
	if(!mysql_select_db($dbname)){
		$json = "{success:0,msg:'不存在数据库:' . $dbname . ',请核对后再试'}";
		echo ($json);
		exit;
	}
	mysql_query("set names 'utf8'");
	$mysql = "set charset utf8;\r\n";
	$q1 = mysql_query("show tables");
	while ($t = mysql_fetch_array($q1))
	{
		$table = $t[0];
		$q2 = mysql_query("show create table `$table`");
		$sql = mysql_fetch_array($q2);
		$mysql .= $sql['Create Table'] . ";\r\n";
		$q3 = mysql_query("select * from `$table`");
		while ($data = mysql_fetch_assoc($q3))
		{
			$keys = array_keys($data);
			$keys = array_map('addslashes', $keys);
			$keys = join('`,`', $keys);
			$keys = "`" . $keys . "`";
			$vals = array_values($data);
			$vals = array_map('addslashes', $vals);
			$vals = join("','", $vals);
			$vals = "'" . $vals . "'";
			$mysql .= "insert into `$table`($keys) values($vals);\r\n";
		}
	}
	$savedir=$rootdir."/backups/db";
	if(!file_exists($savedir))mkdir($savedir);
	$filename = $savedir."/".$dbname . date('Ymjgi') . ".sql"; //存放路径，默认存放到项目最外层
	$fp = fopen($filename, 'w');
	fputs($fp, $mysql);
	fclose($fp);
	$json = "{success:1,msg:'成功!'}";
	echo ($json);
	exit;
}elseif(strcmp($action,"zip")==0){
	$path=$rootdir."/upload";
	$filename=$rootdir."/backups/upload/upload".date('Ymjgi').".zip";
	zip($path,$filename);
	$json = "{success:1,msg:'成功!'}";
	echo ($json);
	exit;
}elseif(strcmp($action,"del")==0){	
	$fullpath=Fun::request("fullpath");
	$fullpath=iconv('UTF-8','GB2312',$fullpath);
	$json="{success:0,msg:'删除失败!'}";
	if(is_file($fullpath)){
		if(unlink($fullpath)){
			$json="{success:0,msg:'文件删除成功 !'}";
			$json="{success:1,msg:'成功!'}";
		}else{
			$json="{success:0,msg:'对不起，文件删除失败，权限不够 !'}";
		}
	}else{
		$json="{success:0,msg:'对不起，不是有一个有效的文件 !'}";
	}
	
	echo($json);
}

//==============================================================================================================================================================
function ezip($zip, $hedef = ''){
	$dirname=preg_replace('/.zip/', '', $zip);
	$root = $_SERVER['DOCUMENT_ROOT'].'/zip/';
	// echo $root. $zip;
	$zip = zip_open($root . $zip);
	// var_dump($zip);
	@mkdir($root . $hedef . $dirname.'/'.$zip_dosya);
	while($zip_icerik = zip_read($zip)){
		$zip_dosya = zip_entry_name($zip_icerik);
		if(strpos($zip_dosya, '.')){
			$hedef_yol = $root . $hedef . $dirname.'/'.$zip_dosya;
			@touch($hedef_yol);
			// echo $hedef_yol;
			$yeni_dosya = @fopen($hedef_yol, 'w+');
			@fwrite($yeni_dosya, zip_entry_read($zip_icerik));
			@fclose($yeni_dosya);
			// $yeni_dosya;
		}else{
			@mkdir($root . $hedef . $dirname.'/'.$zip_dosya);
			// echo $root . $hedef . 'x/'.$zip_dosya;
		};
	};
}
// ezip('yuol.zip','./tr/');
function zip($path,$filename) {
	$path=preg_replace('/\/$/', '', $path);
	preg_match('/\/([\d\D][^\/]*)$/', $path, $matches, PREG_OFFSET_CAPTURE);
	//$filename=$matches[1][0].".zip";
	$zip = new ZipArchive();
	$zip->open($filename,ZIPARCHIVE::OVERWRITE);//return ;
	if (is_file($path)) {
		$path=preg_replace('/\/\//', '/', $path);
		$base_dir=preg_replace('/\/[\d\D][^\/]*$/', '/', $path);
		$base_dir=addcslashes($base_dir, '/:');
		$localname=preg_replace('/'.$base_dir.'/', '', $path);
		$zip->addFile($path,$localname);
		$zip->close();
		return;
	}elseif (is_dir($path)) {
		//$path=preg_replace('/\/[\d\D][^\/]*$/', '', $path);
		$base_dir=$path.'/';//基目录
		$base_dir=addcslashes($base_dir, '/:');
		// var_dump($base_dir);
	}
	$path=preg_replace('/\/\//', '/', $path);
	// var_dump($path);
	function addItem($path,&$zip,&$base_dir){
		// var_dump($path);
		$handle = opendir($path);
		// var_dump($path);
		while (false !== ($file = readdir($handle))) {
			if (($file!='.')&&($file!='..')){
				// var_dump($file);
				$ipath=$path.'/'.$file;
				if (is_file($ipath)){//条目是文件
					$localname=preg_replace('/'.$base_dir.'/', '', $ipath);
					//var_dump($localname);
					$zip->addFile($ipath,$localname);
				} else if (is_dir($ipath)){
					addItem($ipath,$zip,$base_dir);
					$localname=preg_replace('/'.$base_dir.'/', '', $ipath);
					//var_dump($localname);
					$zip->addEmptyDir($localname);
				}
			}
		}
	}
	addItem($path,$zip,$base_dir);
	$zip->close();
}



?>

