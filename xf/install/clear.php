<?php
/*
 * php隐形字符65279解释如下：
UTF-8 编码的文件可以分为无 BOM 和 BOM 两种格式。
何谓BOM？
　　"EF BB BF" 这三个字节就叫BOM，全称是"Byte Order Mard"。在utf8文件中常用BOM来表明这个文件是UTF-8文件，而BOM的本意是在utf16中用。
　　utf-8文件在php中输出的时候bom是会被输出的，所以要在php中使用utf-8，必须要是使用不带bom头的utf-8文件。
　　常用的文本编辑软件对utf-8文件保存的支持方式并不一样，使用的时候要特别留意。
例如：
1、使用ultraedit时，另存时会有“UTF-8”和“UTF-8 - 无BOM”两种选择。
2、 window的记事本保存的是带bom的。
3、EditPlus软件不同版本对utf-8的保存支持不一样，例如：2.31版本保存的是不带bom的，2.11版本保存的是带bom的。
把utf-8文件头去掉的办法：
1、使用ultraedit另存，选择“UTF-8 - 无BOM”
2、一个很有用的php程序，放在站点根目录下运行，会把目录下全部utf-8文件的bom头去掉，代码如下：
 * */
if (isset($_GET['dir'])){ //config the basedir 
   $basedir=$_GET['dir']; 
 }else{ 
   $basedir = '.'; 
 } 
   
 $auto = 1; 
   
 checkdir($basedir); 
   
 function checkdir($basedir){ 
   if ($dh = opendir($basedir)) { 
     while (($file = readdir($dh)) !== false) { 
       if ($file != '.' && $file != '..'){ 
         if (!is_dir($basedir."/".$file)) { 
           echo "filename
 $basedir/$file ".checkBOM("$basedir/$file")." <br>"; 
         }else{ 
           $dirname = $basedir."/".$file; 
           checkdir($dirname); 
         } 
       } 
     } 
   closedir($dh); 
   } 
 } 
   
 function checkBOM ($filename) { 
   global $auto; 
   $contents = file_get_contents($filename); 
   $charset[1] = substr($contents, 0, 1); 
   $charset[2] = substr($contents, 1, 1); 
   $charset[3] = substr($contents, 2, 1); 
   if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) { 
     if ($auto == 1) { 
       $rest = substr($contents, 3); 
       rewrite ($filename, $rest); 
       return ("<font color=red>BOM found, automatically removed.</font>"); 
     } else { 
       return ("<font color=red>BOM found.</font>"); 
     } 
   } 
   else return ("BOM Not Found."); 
 } 
   
 function rewrite ($filename, $data) {
   $filenum = fopen($filename, "w"); 
   flock($filenum, LOCK_EX); 
   fwrite($filenum, $data); 
   fclose($filenum); 
 }
 ?>