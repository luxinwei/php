<?php 
include ('../com/base/util/Fun.class.php');
include ('../com/base/util/ParaUtil.class.php');
include ('../com/base/util/FileUtil.class.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
<script type="text/javascript" src="swfupload/js/jquery.js"></script>
<style type="text/css">
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldser,input,textarea,p,blockquote{margin:0; padding:0;}
ol,ul,li{list-style:none;}
.pics{}
.pics li{float:left;margin:3px;border: 2px solid #dfdfdf;}
.pics li img{width:120px;height:120px;margin:3px;}
.pics li:hover{border: 2px solid #f00;cursor:pointer;}
</style>
</head>
<body>
<?php 
$activexid=Fun::request("activexid");
$picsDir=ParaUtil::getInstance()->getFileUploadFolder()."/etc";
$list=scanPdffiles($picsDir);
$content="";
foreach ($list as $fileArray){
	$file_dir=$fileArray["PATH"];
	$virpath=str_replace(ParaUtil::getInstance()->getFileUploadFolder()."/","",$file_dir);
	$filename=strtoupper($fileArray["FILENAME"]);
	if(substr_count($filename,"PNG")>0||substr_count($filename,"GIF")>0||substr_count($filename,"JPEG")>0||substr_count($filename,"JPG")>0){
		
	}else{
		continue;
	}
	if (preg_match("/[\x7f-\xff]/", $filename))continue;//包含中文，则过滤掉
	$picurl=ParaUtil::getInstance()->getFileServerUrl()."/".$virpath;
	$content.="<li virpath=\"".$virpath."\">";
	//$content.="<a target='_blank' href='".$picurl."'>";
	$content.="<img src='".$picurl."'/>";
	//$content.="</a>";
	$content.="</li>";
} 

?>
<ul class="pics">
<?php echo $content;?>
</ul>

</body>
</html>
<script>
$(".pics li").bind("click", function(){
	    var virpath=$(this).attr("virpath");
	    parent.$('#<?php echo $activexid;?>').val(virpath);
		var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		parent.layer.close(index);
	
})

</script>
<?php 

function scanPdffiles($dir) {
	if (!is_dir ( $dir ))
		return array ();
	$dir = rtrim ( str_replace ( '\\', '/', $dir ), '/' ) . '/';// 兼容各操作系统
	$dirs = array ( $dir );// 栈，默认值为传入的目录
	// 放置所有文件的容器
	$rt = array ();
	do {// 弹栈
		$dir = array_pop ( $dirs );
		$tmp = scandir ( $dir );// 扫描该目录
		foreach ( $tmp as $f ) {
			if ($f == '.' || $f == '..')continue; // 过滤. ..
			$path = $dir . $f; // 组合当前绝对路径
			// 如果是目录，压栈。
			if (is_dir ( $path )) {
				array_push ( $dirs, $path . '/' );
			} else if (is_file($path)) { // 如果是文件，放入容器中
				//$rt [] = $path;
				$filename=substr($path,strlen($dir));
				if(substr_count(strtoupper(PHP_OS),"WIN")){//windows
					$filename=iconv('gb2312', 'UTF-8', $filename);
				}
				$filelength=filesize($path);
				$rt []=array("PATH"=> $path,"FILENAME"=> $filename,"MODIFYTIME"=>date("Y-m-d H:i:s", filemtime($path)) ,"FILELENGTH"=>$filelength,"FILESIZE"=>calc($filelength));
			}
		}
	} while ( $dirs ); // 直到栈中没有目录
	return $rt;
}
function calc($size,$digits=2){
	$unit= array('','K','M','G','T','P');
	$base= 1024;
	$i   = floor(log($size,$base));
	$n   = count($unit);
	if($i >= $n){
		$i=$n-1;
	}
	return round($size/pow($base,$i),$digits).' '.$unit[$i] . 'B';
}

?>