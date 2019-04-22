<?php

class PdfUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	function getPdfPages($path){
		$pages=0;
		if(substr_count(strtoupper(PHP_OS),"LINUX")){//Linux
			$pages=self::getPdfPagesByCmd($path);
		}else{//windows
			$pages=self::getPdfPagesByTxt($path);
		}
		
		return $pages;
		
	}
	
	
	function getPdfPagesByCmd($filename){
		//$cmd = "/usr/bin/pdfinfo";          // Linux
		//$cmd = "C:\\pdfinfo.exe";           // Windows
	
		$cmd = "/usr/bin/pdfinfo";
	
	//	$filename = iconv('UTF-8', 'GB2312', $filename);
	
		exec("$cmd $filename", $output);
	
		$pagecount = 0;
		foreach($output as $op)
		{
			if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1)
			{
				$pagecount = intval($matches[1]);
				break;
			}
		}
	
		return $pagecount;
	}
	
	function getPdfPagesByTxt($path){
		if(!file_exists($path)) return 0;
		if(!is_readable($path)) return 0;
		// 打开文件
		$fp=@fopen($path,"r");
		if (!$fp) {
			return 0;
		}else {
			$max=0;
			while(!feof($fp)) {
				$line = fgets($fp,255);
				if (preg_match('/\/Count [0-9]+/', $line, $matches)){
					preg_match('/[0-9]+/',$matches[0], $matches2);
					if ($max<$matches2[0]) $max=$matches2[0];
				}
			}
			fclose($fp);
			// 返回页数
			return $max;
		}
	}
	
	
	
}
/*
header("Content-type: text/html; charset=utf-8");
$path=dirname(__FILE__)."/../upload/pdf/1000000003/测试文件100p.pdf";

echo "<br/>";
var_dump($path);
$pages=PdfUtil::getInstance()->getPdfPages($path);
echo "<br/>";
var_dump($pages);
*/