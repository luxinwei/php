<?php include '../../../manage/include/page/top.php';?>
        <input class="layui-btn layui-btn-normal layui-btn-small" type="button"  value="数据库备份" id="dbback" />
<input class="layui-btn layui-btn-normal layui-btn-small" type="button"  value="备份文件" id="uploadzip" />
<?php 
$rootdir=str_ireplace("/manage/fim/backups/db_back.php","",strtr(__FILE__,"\\","/"));
$content="";
$data_array=array_merge(scanfiles($rootdir."/backups/db"), scanfiles($rootdir."/backups/upload"));
foreach ($data_array as $objArray) {
	$content.="<tr>";
	$content.="<td>".$objArray["FILENAME"]."</td>";
	$content.="<td>".$objArray["FILESIZE"]."</td>";
	$content.="<td>".$objArray["MODIFYTIME"]."</td>";
	$content.="<td align=\"center\"><a onclick=\"delfn('".$objArray["PATH"]."')\" href=\"#\">[删除]</a></td>";
	$content.="</tr>";
}
?>
<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="grid_list" id="grid_list">
	<tr>
		<th>名称</th>
		<th class="tc"  width="150">文件大小</th>
		<th class="tc"  width="180">日期</th>
		<th class="tc" width="150">操作 </th>
	</tr>
<?php echo $content;?>
</table>
<script type="text/javascript" src="js/db_back.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>
<?php 

function scanfiles($dir) {
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


				$rt []=array("PATH"=> $path,"FILENAME"=> $filename,"MODIFYTIME"=>date("Y-m-d H:i:s", filemtime($path)) ,"FILESIZE"=>calc(filesize($path)));
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