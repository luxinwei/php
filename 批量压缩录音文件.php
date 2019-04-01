<?php
$filename='test.zip'; //最终生成的文件名（含路径） 
if(file_exists($filename)){
    unlink($filename);
}
//重新生成文件 
$zip=new ZipArchive();
if($zip->open($filename,ZIPARCHIVE::CREATE)!==TRUE){
    exit('无法打开文件，或者文件创建失败');
}
$datalist=array('try.php','zip_class.php');
foreach($datalist as $val){
    if(file_exists($val)){
        $zip->addFile($val);
    }
}
$zip->close();//关闭 
if(!file_exists($filename)){
    exit('无法找到文件'); //即使创建，仍有可能失败 
} 