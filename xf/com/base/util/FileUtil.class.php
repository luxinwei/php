<?php
class FileUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	/*
	 * 递归创建文件夹
	 */
	function CreateFolder($dir){
		if (is_dir($dir) || mkdir($dir)){
			return true;
		}
		if (!self::CreateFolder(dirname($dir))){
			return false;
		}
		return mkdir($dir);
	}
	/**
	 * 复制目录 以及目录下的文件
	 * @param unknown $fromFile
	 * @param unknown $toFile
	 */
	function copyDir($fromFile,$toFile){
		self::CreateFolder($toFile);
		$folder1=opendir($fromFile);
		while($f1=readdir($folder1)){
			if($f1!="." && $f1!=".."){
				$path2=$fromFile."/".$f1;
				if(is_file($path2)){
					$file = $path2;
					$newfile = $toFile."/".$f1;
					echo "<br/>";echo($newfile);
					copy($file, $newfile);
				}elseif(is_dir($path2)){
					$toFiles = $toFile."/".$f1;
					self::copyDir($path2,$toFiles);
				}
			}
		}
	
	}
	/*
	 * 删除目录以及目录下的文件
	 */
	function delDirAndFile( $delDir ){
		if ($handle = opendir($delDir) ) {
			while ( false!==( $item = readdir( $handle ) ) ) {
				if ( $item != "." && $item != ".." ) {
					if ( is_dir( $delDir."/".$item) ) {
						self::delDirAndFile( $delDir."/".$item );
					} else {
						if(unlink($delDir."/".$item)){echo "<br/>成功删除文件". $delDir."/".$item;}
					}
	
				}
			}
			closedir( $handle );
			if(rmdir( $delDir ) )echo "<br/>成功删除目录：".$delDir;
		}
	}
	/*
	 * 删除目录下的文件，保留目录
	 */
	function delDirFile( $delDir ){
		if ($handle = opendir($delDir) ) {
			while ( false!==( $item = readdir( $handle ) ) ) {
				if ( $item != "." && $item != ".." ) {
					if ( is_dir( $delDir."/".$item) ) {
						self::delDirFile( $delDir."/".$item );
					} else {
						if(unlink($delDir."/".$item)){echo "<br/>成功删除文件". $delDir."/".$item;}
					}
	
				}
			}
			closedir( $handle );
		}
	}
	//=========================================================================================================================================
    //创建目录
    function forcemkdir($content_path){
    	$content_path=strtr($content_path,"\\","/");
    	if(file_exists($content_path))return true;//如果存在文件则退出
		$pathArray=explode('/',$content_path);
		$level=count($pathArray);
		for($i=3;$i<=$level;$i++){
			$filedir="";
			for($j=0;$j<$i;$j++){
				if($j>0)$filedir.="/";
				$filedir.=$pathArray[$j];
		    }
		    if(file_exists($filedir))continue;
		    if($i!=$level)mkdir($filedir);
			if($i==$level){
				if(substr_count($pathArray[$level-1],".")==0)mkdir($filedir);//如果是目录则创建
				if(substr_count($pathArray[$level-1],".")>0){
					$myfile=fopen($filedir, "w");
					fclose($myfile);
				}
			}
		}
    }
//写入文件
    function writetofile($file_path,$content){
    	self::forcemkdir($file_path);
    	$myfile = fopen($file_path, "w");
    	fwrite($myfile, $content);
    	fclose($myfile);
    } 
    function  writetofileAdd($file_path,$content){
    	$isok=false;
    	self::forcemkdir($file_path);
    	$isok=file_put_contents($file_path, $content, FILE_APPEND);
    	return $isok;
    }
    function getFileContent($content_path){
    	$content="";
    	if(file_exists($content_path)){
    		if(!is_dir($content_path)){
    			$file = fopen($content_path,"r");//只读方式打开文本文件
    			while(! feof($file)){//当文件不结束
    				$line=fgets($file);//读一行到$line变量
    				$content.=$line;
    			}
    			fclose($file);//关闭文本文件
    		}
    	}
    	return $content;
    }
    //====================================================================================
    /*
     ----------------------------------------------------------------------
     函数:调整图片尺寸或生成缩略图
     返回:True/False
     参数:
     $Image  需要调整的图片(含路径)
     $Dw=450  调整时最大宽度;缩略图时的绝对宽度
     $Dh=450  调整时最大高度;缩略图时的绝对高度
     $Type=1  1,调整尺寸; 2,生成缩略图
     $path='img/';//路径
     $phtypes=array(
     'img/gif',
     'img/jpg',
     'img/jpeg',
     'img/bmp',
     'img/pjpeg',
     'img/x-png'
     );
     */
    
    function compress($Image,$Dw=450,$Dh=450,$Type=1){

    	IF(!File_Exists($Image)){
    		Return False;
    	}

    	//如果需要生成缩略图,则将原图拷贝一下重新给$Image赋值.
    	Copy($Image,Str_Replace(".","_big.",$Image));
    	/*
    	IF($Type!=1){
    		Copy($Image,Str_Replace(".","_small.",$Image));
    		$Image=Str_Replace(".","_small.",$Image);
    	}
    	*/
    	//取得文件的类型,根据不同的类型建立不同的对象

    	$ImgInfo=GetImageSize($Image);
    	
    	Switch($ImgInfo[2]){
    		Case 1:
    			$Img = @ImageCreateFromGIF($Image);
    			Break;
    		Case 2:
    			$Img = @ImageCreateFromJPEG($Image);
    			Break;
    		Case 3:
    			$Img = @ImageCreateFromPNG($Image);
    			Break;
    	}
    	//如果对象没有创建成功,则说明非图片文件
    	IF(Empty($Img)){
    		//如果是生成缩略图的时候出错,则需要删掉已经复制的文件
    		IF($Type!=1){Unlink($Image);}
    		Return False;
    	}
    	//如果是执行调整尺寸操作则
    	IF($Type==1){
    		$w=ImagesX($Img);
    		$h=ImagesY($Img);
    		$width = $w;
    		$height = $h;
    		IF($width>$Dw){
    			$Par=$Dw/$width;
    			$width=$Dw;
    			$height=$height*$Par;
    			IF($height>$Dh){
    				$Par=$Dh/$height;
    				$height=$Dh;
    				$width=$width*$Par;
    			}
    		}ElseIF($height>$Dh){
    			$Par=$Dh/$height;
    			$height=$Dh;
    			$width=$width*$Par;
    			IF($width>$Dw){
    				$Par=$Dw/$width;
    				$width=$Dw;
    				$height=$height*$Par;
    			}
    		}Else{
    			$width=$width;
    			$height=$height;
    		}
    		$nImg = ImageCreateTrueColor($width,$height);   //新建一个真彩色画布
    		ImageCopyReSampled($nImg,$Img,0,0,0,0,$width,$height,$w,$h);//重采样拷贝部分图像并调整大小
    		ImageJpeg ($nImg,$Image);     //以JPEG格式将图像输出到浏览器或文件
    		Return True;
    		//如果是执行生成缩略图操作则
    	}Else{
    		$w=ImagesX($Img);
    		$h=ImagesY($Img);
    		$width = $w;
    		$height = $h;
    		$nImg = ImageCreateTrueColor($Dw,$Dh);
    		IF($h/$w>$Dh/$Dw){ //高比较大
    			$width=$Dw;
    			$height=$h*$Dw/$w;
    			$IntNH=$height-$Dh;
    			ImageCopyReSampled($nImg, $Img, 0, -$IntNH/1.8, 0, 0, $Dw, $height, $w, $h);
    		}Else{   //宽比较大
    			$height=$Dh;
    			$width=$w*$Dh/$h;
    			$IntNW=$width-$Dw;
    			ImageCopyReSampled($nImg, $Img, -$IntNW/1.8, 0, 0, 0, $width, $Dh, $w, $h);
    		}
    		ImageJpeg ($nImg,$Image);
    		Return True;
    	}
    }
    /**
     * [将Base64图片转换为本地图片并保存]
     * @E-mial wuliqiang_aa@163.com
     * @TIME   2017-04-07
     * @WEB    http://blog.iinu.com.cn
     * @param  [Base64] $base64_image_content [要保存的Base64]
     * @param  [目录] $path [要保存的路径]
     */
    function base64_image_content($base64_image_content,$fileUploadFolder,$virtualsavepath){
    	//匹配出图片的格式
    	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
    		$file_ext = $result[2];
    		$virpath_start=$virtualsavepath."/".date("Y")."/". date("m")."/". date("d");
    		$this->forcemkdir($fileUploadFolder."/".$virpath_start);
    		$file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    		$virpath=$virpath_start."/".$file_name;
    		$file_path=$fileUploadFolder ."/". $virpath;
    
    		if (file_put_contents($file_path, base64_decode(str_replace($result[1], '', $base64_image_content)))){
    			return $virpath;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }
    /*
     $img = 'test.jpg';
     $base64_img = base64EncodeImage($img);
    
     echo '<img src="' . $base64_img . '" />';
     */
     
    
    function base64EncodeImage ($image_file) {
    	$base64_image = '';
    	$image_info = getimagesize($image_file);
    	$image_data = fread(fopen($image_file, 'r'), filesize($image_file));
    	$base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
    	return $base64_image;
    }
    //$url图片下载到本地图片
    function urlDownPic($url,$fileUploadFolder,$virtualsavepath) {
    
    	$headers = @get_headers($url);
    	if($headers[0] == 'HTTP/1.1 404 Not Found'){
    		return "";
    		exit();
    	}
    
    
    	$header = array("Connection: Keep-Alive", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:29.0) Gecko/20100101 Firefox/29.0");
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HEADER, $v);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    
    	$content = curl_exec($ch);
    	$curlinfo = curl_getinfo($ch);
    
    	//print_r($curlinfo);
    	//关闭连接
    	curl_close($ch);
    	 
    	if ($curlinfo['http_code'] != 200) {
    		return "";
    	}
    	$file_ext="";
    	if ($curlinfo['content_type'] == 'image/jpeg') {
    		$file_ext = '.jpg';
    	} else if ($curlinfo['content_type'] == 'image/png') {
    		$file_ext = '.png';
    	} else if ($curlinfo['content_type'] == 'image/gif') {
    		$file_ext = '.gif';
    	}
    	//存放图片的路径及图片名称  *****这里注意 你的文件夹是否有创建文件的权限 chomd -R 777 mywenjian
    	$virpath_start=$virtualsavepath."/".date("Y")."/". date("m")."/". date("d");
    	$this->forcemkdir($fileUploadFolder."/".$virpath_start);
    	$file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    	$virpath=$virpath_start."/".$file_name;
    	$file_path=$fileUploadFolder ."/". $virpath;
    
    	if(file_exists($file_path)){
    		return $virpath;
    	}
    
    
    
    	$res = file_put_contents($file_path, $content);//同样这里就可以改为$res = file_put_contents($filepath, $content);
    	if(!file_exists($file_path)){
    		return "";
    	}
    	return $virpath;
    	 
    }
    
}
?>