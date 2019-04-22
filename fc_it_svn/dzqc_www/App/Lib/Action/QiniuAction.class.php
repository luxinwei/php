<?php

// 引入鉴权类
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\UploadManager;
class QiniuAction extends QAction {
	private static $allowType = array (".jpg", ".jpeg", ".gif", ".png", ".bmp", ".zip", ".rar", ".txt", ".ogg", ".mp3", ".wma" );
	
	function __construct() {
		Vendor ( 'Qiniu.autoload' );
		parent::__construct ( "User" );
	}
	
	private static $QN_CFG = array ('bucket' => 'dzqc-c2c-common', 'accessKey' => 'seR2X9R5Cd-z8b_pxjd1YQHZVXJpYmc61R856sVQ', 'secretKey' => 'Hr7MUxIjP98l0urCJMV7muo954ktdC-WNQSut4HP', 'callbackUrl' => '', 'callbackBody' => '' );
	
	function callback() {
		header ( 'Content-Type: application/json' );
		$resp = array ('ret' => 'success' );
		$_body = file_get_contents ( 'php://input' );
		$body = json_decode ( $_body, true );
		
		$bucket = self::$QN_CFG ['bucket'];
		$accessKey = self::$QN_CFG ['accessKey'];
		$secretKey = self::$QN_CFG ['secretKey'];
		$auth = new Auth ( $accessKey, $secretKey );
		
		//回调的contentType
		$contentType = 'application/x-www-form-urlencoded';
		
		//回调的签名信息，可以验证该回调是否来自七牛
		$authorization = $_SERVER ['HTTP_AUTHORIZATION'];
		
		//七牛回调的url，具体可以参考：http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html
		$url = self::$QN_CFG ['callbackUrl'];
		
		$isQiniuCallback = $auth->verifyCallback ( $contentType, $authorization, $url, $_body );
		if (! $isQiniuCallback) {
			$resp = array ('ret' => 'failed' );
			echo json_encode ( $resp );
			die ();
		}
		
		$uid = $body ['uid'];
		$fname = $body ['fname'];
		$fkey = $body ['fkey'];
		$desc = $body ['desc'];
		
		$date = new DateTime ();
		$ctime = $date->getTimestamp ();
		$FilesModel = D ( 'Files' );
		
		$arr_data = array ();
		$arr_data ['uid'] = $uid;
		$arr_data ['fname'] = $fname;
		$arr_data ['fkey'] = $fkey;
		$arr_data ['desc'] = $desc;
		$FilesModel->add ( $arr_data );
		
		echo json_encode ( $resp );
		die ();
	}
	
	function upload() {
		$filename = 'fileToUpload';
		$uploadp = (C ( 'UPLOAD_PATH' ));
		// 需要填写你的 Access Key 和 Secret Key
		$accessKey = self::$QN_CFG ['accessKey'];
		$secretKey = self::$QN_CFG ['secretKey'];
		
		// 构建鉴权对象
		$auth = new Auth ( $accessKey, $secretKey );
		
		// 要上传的空间
		//var_dump($_FILES);exit;

		$bucket = self::$QN_CFG ['bucket'];
		
		
		if (! is_array ( $_FILES [$filename] ['name'] )) {
			$_FILES [$filename] ['name'] = array ($_FILES [$filename] ['name'] );
			$_FILES [$filename] ['type'] = array ($_FILES [$filename] ['type'] );
			$_FILES [$filename] ['size'] = array ($_FILES [$filename] ['size'] );
			$_FILES [$filename] ['tmp_name'] = array ($_FILES [$filename] ['tmp_name'] );
			$_FILES [$filename] ['error'] = array ($_FILES [$filename] ['error'] );
		}
		$i = 1;
		
		foreach ( $_FILES [$filename] ['name'] as $key => $val ) {
			$current_type = strtolower ( strrchr ( $val, '.' ) );
			if (! in_array ( $current_type, self::$allowType )) {
				$result ['code'] = '002';
				$result ['msg'] = '文件类型不允许上传2';
				return $result;
			}
		}
		$return=array('flag'=>1,"url"=>array(),"path"=>array(),"name"=>array());
		foreach ( $_FILES [$filename] ['name'] as $key => $val ) {
			$current_type = strtolower ( strrchr ( $val, '.' ) );
			
			$new_filename = microtime ( 1 ) . 'qc' . $i . $current_type;
			
			
			// 生成上传 Token
		$token = $auth->uploadToken ( $bucket );
			// 要上传文件的本地路径
			$filePath = $_FILES [$filename] ["tmp_name"] [$key];
			
			// 上传到七牛后保存的文件名
			$key = $new_filename;
			
			// 初始化 UploadManager 对象并进行文件的上传。
			$uploadMgr = new UploadManager ();
			
			// 调用 UploadManager 的 putFile 方法进行文件的上传。
			list ( $ret, $err ) = $uploadMgr->putFile ( $token, $key, $filePath );
			if ($err !== null) {
				return $this->q_error($err->message());
			} else {
				$return['url'][]=C('QINIU_IMG_DOMAIN').$ret["key"];
				$return['path'][]=$ret["key"];
				$return['name'][]=$val;
			}
			$i ++;
		}
		
		return $this->q_success($return);
	}
}