<?php
error_reporting(0);
include_once (dirname(__FILE__)."/../common/BaseDataLib.class.php");
class ParaUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	public function getContent($paracode){
		$content=BaseDataLib::$baseDataFimPara[$paracode];
		return $content;
	}
	public function getRoot(){
		return self::getContent("FRONTROOT");
	}
	public static function getRootDir(){
		$rootdir=str_ireplace("/com/base/util/ParaUtil.class.php","",strtr(__FILE__,"\\","/"));
		return $rootdir;
	}
	public function isCreateHtml(){
		return self::getContent("ISCREATEHTML");
	}
	//系统标题
	public function getSystitle(){
	  return self::getContent("SYSTITLE");
	}
	
	//系统底部标题
	public function getSysBottomTitle(){
		return self::getContent("SYSBOTTOMTITLE");
	}
	//前台网站标题
	public function getFrontTitle(){
		return self::getContent("FRONTTITLE");
	}
	public function getFrontFolder(){
		return self::getContent("FRONTFOLDER");
	}
	
	/*
	 * 文件上传目录路径
	 * 例如 d:/upload
	 */

	public function getFileUploadFolder(){
		return self::getContent("FILEUPLOADFOLDER");
	}
	/*
	 * 上传文件服务URL地址 
	 * 例如1:http://192.168.1.10/file
	 * 例如2:/file
	 */
	public function getFileServerUrl(){
		return self::getContent("FILESERVERURL");
	}
	public function getMarketUsercode(){
		return self::getContent("MARKET_USERCODE");
	}
}
