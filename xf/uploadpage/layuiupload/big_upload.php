<?php
error_reporting(0);
include_once (dirname(__FILE__)."/../../com/base/util/Fun.class.php");
include_once (dirname(__FILE__)."/../../com/base/util/ParaUtil.class.php");
include_once (dirname(__FILE__)."/../../com/base/common/BaseDataLib.class.php");
header("Content-type: text/html; charset=utf-8");
$uploadparam=$_GET["uploadparam"];
$uploadcolkey=Fun::decode($uploadparam);
$obj=BaseDataLib::$baseDataFimUploadcol[$uploadcolkey];
if(count($obj)==0){echo "非法访问！";exit(0);}
$allowFileType   = $obj["ALLOWFILETYPE"];//上传文件格式
$allowFileType = str_replace(",","|",$allowFileType);
$filenum         = Fun::getInt($obj["FILENUM"],1);
//$fileserverUrl   = ParaUtil::getInstance()->getFileServerUrl();
//$fileserverUrl   = "";
$virtualsavepath = $obj["VIRTUALSAVEPATH"];
$allowType       = $allowFileType;//swf里面用到的类型字符串rar,zip
$file_id         = $_GET["file_id"];
$containerId     = $_GET["containerId"];//父页面存放文件路径的容器
$fileName        = $_GET["fileName"];//文件名称
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<script src="../../etc/commonjs.php"></script>
</head>
<body>
<input type="file" name="Filedata" class="layui-upload-file" lay-title="上传"> 


</body>
</html>

  <script type="text/javascript" >
  var uploadparam="<?php echo $uploadparam?>";
  var allowType = "<?php echo $allowType?>";
  var containerId = "<?php echo $containerId?>";
  var fileserverUrl = "<?php echo ParaUtil::getInstance()->getFileServerUrl()?>";
  </script>
 <script type="text/javascript" src="js/big_upload.js"></script>