<?php
//得到根所在的目录
$rootdir=str_ireplace("/com/base/common/filerootdir.php","",strtr(__FILE__,"\\","/"));
echo $rootdir;
?>