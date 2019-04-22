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
</head>
<style type="text/css">
body{margin:0;padding:0;font-size:12px;}
.con{ overflow:hidden; height:30px;}
.con1{ height:30px;}
.con2{ height:32px;}
.text1{ float:left; width:100px; height:30px; line-height:30px; padding-left:10px; color:#FCBA63;}
.text2{ float:left;width:100px; height:30px; line-height:30px;padding-left:10px; color:#BBD765;}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<body>
<input type="hidden" id="file_path" size="60"/>
  <table >
  	<tr>
  		<td>
  			  <span id="spanButtonPlaceholder"></span>
  		</td>
     	<td>
        	 支持文件格式：<label id="type_msg"></label>
  		</td>
  		<td>
  			<div id="showDiv" >
 			 </div>
  		</td>
  		<td>
  			<div id="perentDiv">
  			</div>
  		</td>
  		<td id="viewmsg">
  		<a target="_blank" id="down_url" style="display:none;" > 
  		   <img src="images/application_view_icons.png" border="0"/> 
  		</a>
  		</td>
  	</tr>
  </table>
    <script type="text/javascript">
    
    var pici=<?php echo Fun::requestInt("i",-1)?>;//第几幅图片
    var uploadparam="<?php echo $uploadparam?>";
    var filenum=<?php echo $filenum?>;
    var allowType = "<?php echo $allowType?>";
    var file_id = "<?php echo $file_id?>";	
    var containerId = "<?php echo $containerId?>";
    var fileserverUrl = "<?php echo ParaUtil::getInstance()->getFileServerUrl()?>";
    var down_url = "#";
  	function init_load(){
  		//格式化allowType
		var tempType = allowType.split(',');
	  	allowType = '';
		for(var i = 0; i < tempType.length ; i++ ){
	  		allowType += "*."+tempType[i]+";";
	  	}
	  	//设置提示信息 
  		$("#type_msg").html(allowType);
  		//编辑下载设置
  		//编辑下载设置
  		var path = $("#"+containerId, window.parent.document).val();
  		var myfileName = "<?php echo $fileName?>";
  		if(path != ""){
  	  		var url=fileserverUrl+"/"+path;
  	  	url=url.replace(/\ufeff/g,'');
  			$("#down_url").attr("href",url);
  			$("#down_url").show();
  		}
  	}
  	init_load();
  	function uploadSuccess(file, serverData) {
		try {
			var data = eval("("+serverData+")");
			$("#file_path").val(data.lastFileName);
			var relativePath="";
			if(filenum==1)relativePath=data.relativePath;
			if(filenum>1){
				var relativePathNew=$("#"+containerId, window.parent.document).val();
				var relativeArray=relativePathNew.split(",");
				if(pici==-1){
					if(relativeArray.length==filenum){
						for(var i=0;i<(relativeArray.length-1);i++){
						 if(relativePath!="")relativePath+=",";
					     relativePath+=relativeArray[i];
						}
					}else{
					  relativePath=relativePathNew;
					}
					if(relativePath!="")relativePath+=",";
					relativePath+=data.relativePath;
				}else{
				   if(pici<relativeArray.length){
					   for(var i=0;i<relativeArray.length;i++){
							 if(relativePath!="")relativePath+=",";
							 if(pici==i){
							  relativePath+=data.relativePath;
							  }else{
							  relativePath+=relativeArray[i]; 
							  }
						}
					}else{
					    relativePath=$("#"+containerId, window.parent.document).val();
						if(relativePath!="")relativePath+=",";
						relativePath+=data.relativePath;
					}
				}
			}
		$("#down_url").attr("href",data.url);
		$("#"+containerId, window.parent.document).val(data.virurl);
			
		} catch (ex) {
		alert(this.debug(ex));
			this.debug(ex);
		}
		
	}  </script>
<iframe name="fileiframe" style="display:none"></iframe>
 <script type="text/javascript" src="js/swfupload.js"></script>
  <script type="text/javascript" src="js/handlers.js"></script>
  <script type="text/javascript" src="js/picupload.js"></script>
  </body>
</html>