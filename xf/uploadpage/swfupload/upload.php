<?php
include_once (dirname(__FILE__)."/../../com/base/util/Fun.class.php");
include_once (dirname(__FILE__)."/../../com/base/util/ParaUtil.class.php");
include_once (dirname(__FILE__)."/../../com/base/util/FileUtil.class.php");
include_once (dirname(__FILE__)."/../../com/base/common/BaseDataLib.class.php");
$uploadparam=Fun::request("uploadparam");
$uploadcolkey=Fun::decode($uploadparam);
$obj=BaseDataLib::$baseDataFimUploadcol[$uploadcolkey];
if(count($obj)==0){echo "非法访问！";exit(0);}
$virtualsavepath = $obj["VIRTUALSAVEPATH"];//上传  文件的虚拟路径
$allowFileType   = $obj["ALLOWFILETYPE"];//允许上传类型
    
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		//header("HTTP/1.1 500 Internal Server Error");
		//echo "POST exceeded maximum allowed size.";
		HandleError("POST exceeded maximum allowed size." );
		exit(0);
	}
	
	
	
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 2147483647;				// 2GB in bytes

// Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"文件上传成功",
        1=>"上传的文件超过了 php.ini 文件中的 upload_max_filesize directive 里的设置",
        2=>"上传的文件超过了 HTML form 文件中的 MAX_FILE_SIZE directive 里的设置",
        3=>"上传的文件仅为部分文件",
        4=>"没有文件上传",
        6=>"缺少临时文件夹"
	);

// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("No upload found in \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("File has no name.");
		exit(0);
	}
//==上传文件大小限定start================================================================================	
// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("File exceeds the maximum allowed size");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("File size outside allowed lower bound");
		exit(0);
	}
//==上传文件大小限定end================================================================================
//==上传文件路径start================================================================================
//  Validate file name (for our purposes we'll just remove invalid characters)
	//$save_path = strtr(getcwd(),"\\","/"). "/file/".date("Y")."/". date("m")."/". date("d");
	//$fileUploadFolder=strtr(getcwd(),"\\","/");
	$fileUploadFolder=ParaUtil::getInstance()->getFileUploadFolder();
	$virpath_start=$virtualsavepath."/".date("Y")."/". date("m")."/". date("d");
	$save_path = $fileUploadFolder."/".$virpath_start;
	FileUtil::getInstance()->forcemkdir($save_path);
	$file_name=basename($_FILES[$upload_name]['name']);//显示带有文件扩展名的文件名
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = strtolower(trim($file_ext));
	$file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
	$virpath=$virpath_start."/".$file_name;
	$file_path=$fileUploadFolder ."/". $virpath;
	if (file_exists($file_path)) {
		HandleError("File with this name already exists");
		exit(0);
	}
//==上传文件路径end================================================================================

//==是否有效扩展名start================================================================================	
//  Validate file extension
	//$extension_whitelist = array("doc", "txt", "jpg", "gif", "png");	// Allowed file extensions
	$extension_whitelist =explode(",", strtolower(trim($allowFileType)));	// Allowed file extensions
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	foreach ($extension_whitelist as $extension) {
		if (strcasecmp($file_extension, $extension) == 0) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Invalid file extension");
		exit(0);
	}
//==是否有效扩展名end================================================================================
	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $file_path)) {
		HandleError("文件无法保存.");
		exit(0);
	}
// Return output to the browser (only supported by SWFUpload for Flash Player 9)
    $json="{'lastFileName':'".$file_name."','url':'".ParaUtil::getInstance()->getFileServerUrl()."/".$virpath."','virurl':'".$virpath."'}";
	echo($json);
	//echo "File Received";
	exit(0);


/* Handles the error output.  This function was written for SWFUpload for Flash Player 8 which
cannot return data to the server, so it just returns a 500 error. For Flash Player 9 you will
want to change this to return the server data you want to indicate an error and then use SWFUpload's
uploadSuccess to check the server_data for your error indicator. */
function HandleError($message) {
	header("HTTP/1.1 500 Internal Server Error");
	echo $message;
}
?>