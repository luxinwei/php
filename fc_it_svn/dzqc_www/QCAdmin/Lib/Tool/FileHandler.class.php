<?php
class FileHandler {
	private static $allowType = array (".jpg", ".jpeg", ".gif", ".png", ".bmp", ".zip", ".rar", ".txt", ".ogg", ".mp3", ".wma" );
	static function upload($filename = 'upfile', $dir = '', $old = '', $islocal = false) {
		$result = array ('code' => '1', 'msg' => '', 'path' => array (), 'url' => array () );
		if (! isset ( $_FILES [$filename] )) {
			$result ['code'] = '001';
			$result ['msg'] = '上传文件不存在o';
			return $result;
		}
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
			if ($islocal) {
				$uploadp=(C( 'UPLOAD_PATH' ));
				$uploadp=realpath($uploadp);
				$uploadp=str_replace('\\', '/', $uploadp);
				$uploadPath = $uploadp . "/{$dir}/";
				foreach ( $_FILES [$filename] ['name'] as $key => $val ) {
					$current_type = $filetype ? $filetype : strtolower ( strrchr ( $val, '.' ) );
					if (! in_array ( $current_type, self::$allowType )) {
						$result ['code'] = '002';
						$result ['msg'] = '文件类型不允许上传1';
						return $result;
					}
					
					$new_filename = microtime ( 1 ) . 'dgw' . $i . $current_type;
					$uploadPath = rtrim ( $uploadPath, '/' );
					$filepath = date ( 'Y-m-d' ) . '/' . $new_filename;
					Common::mkdirs ( $uploadPath . '/' . date ( 'Y-m-d' ) );
					$ret = move_uploaded_file ( $_FILES [$filename] ["tmp_name"] [$key], $uploadPath . '/' . $filepath );
					if ($ret === false) {
						$result ['code'] = '003';
						$result ['msg'] = '上传意外中断';
						return $result;
					}
					$t_path = $uploadPath . '/' . $filepath;
					$t_path = str_replace ( '\\', '/', $t_path );
					$ROOT = str_replace ( '\\', '/', ROOT );
					$result ['path'] [] = cfg('upfileDir').str_replace ( $uploadp, '', $t_path );
					$result ['url'] [] = cfg ( 'imgServer' ) .cfg('upfileDir').str_replace ( $uploadp, '', $t_path );
					$i ++;
				}
			} else {
				$arr ['fileToUpload'] = '@' . $_FILES [$filename] ["tmp_name"] [$key];
				$arr ['ftype'] = $current_type;
				$arr ['dir'] = $dir;
				$arr ['old'] = $old;
				$ret = Common::curl_upload ( cfg ( 'imgServer' ) . 'upload.php', $arr );
				$ret = json_decode ( $ret, 1 );
				
				
				
				
				
				if ($ret ['flag'] !== '1') {
					$result ['code'] = $ret ['flag'];
					$result ['msg'] = $ret ['data'];
					return $result;
				} else {
					$result ['path'] [] = $ret ['data'];
					$result ['url'] [] = cfg ( 'imgServer' ) . $ret ['data'];
				}
				$i ++;
			}
		
		}
		return $result;
	}
	static function delete($path) {
		try {
			$url = cfg('imgServer')."del.php?path=$path";
			$ret = Common::curl_get ( $url );
			@unlink (ROOT. $path );
		} catch ( Exception $e ) {
			return false;
		}
		return true;
	}
	/**
	 * 打包上传
	 */
	public static function packSave($filename = 'upfile', $dirname = '.') {
		$uploadPath = ROOT . '/' . Config::$upfilePath;
		if (! file_exists ( $uploadPath )) {
			Common::mkdirs ( $uploadPath, 0700 );
		}
		$result = array ('code' => 1, 'msg' => '', 'path' => array () );
		if (! isset ( $_FILES [$filename] )) {
			$result ['code'] == '001';
			$result ['msg'] == '上传文件不存在';
			return $result;
		}
		$arrData = self::extractPack ( $_FILES ["filename"] ["tmp_name"], $uploadPath . '/' . $dirname . '/' );
		$result ['path'] = $arrData;
		return $result;
	}
	public static function extractPack($path, $newPath, $allowType = null, $isThum = false) {
		$allowType || $allowType = array (".jpg", ".jpeg", ".gif", ".png", ".bmp" );
		$arrData = array ();
		$zip = zip_open ( $path );
		if ($zip) {
			$i = 1;
			while ( $file = zip_read ( $zip ) ) {
				if (zip_entry_open ( $zip, $file )) {
					$size = zip_entry_filesize ( $file );
					$name = zip_entry_name ( $file );
					$name = iconv ( 'gb2312', 'utf-8', $name );
					$current_type = strrchr ( $name, '.' );
					if (strpos ( $name, '.' ) === false || ! in_array ( $current_type, $allowType )) {
						//文件夹
						continue;
					}
					$name = end ( explode ( '/', $name ) );
					$contens = zip_entry_read ( $file, $size );
					$filename = TIME . 'dgw_pack' . $i . $current_type;
					file_put_contents ( $newPath . '/' . $filename, $contens );
					$P = array ();
					if ($isThum) {
						//							$P['thum']=self::thum(ROOT.$fileNewPath);
					}
					$arrData [] = $newPath . '/' . $filename;
				}
				$i ++;
			}
			zip_close ( $zip );
		} else {
		
		}
		@unlink ( $path );
		return $arrData;
	}
}