<?php
class Method {
	public static function php_encode($arr) {
		if (is_array ( $arr )) {
			foreach ( $arr as $key => $val ) {
				$arr [$key] = self::php_encode ( $val );
			}
		} else {
			$arr = addslashes ( $arr );
		}
		return $arr;
	}
	public static function php_decode($arr) {
		if (is_array ( $arr )) {
			foreach ( $arr as $key => $val ) {
				$arr [$key] = self::php_decode ( $val );
			}
		} else {
			$arr = stripslashes ( $arr );
		}
		return $arr;
	}
	public static function html_encode($str) {
		if (is_array ( $str )) {
			foreach ( $str as $key => $val ) {
				$str [$key] = self::html_encode ( $val );
			}
		} else {
			$str = htmlspecialchars ( $str, ENT_QUOTES );
		}
		return $str;
	}
	public static function text_encode($string) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = self::text_encode ( $val );
			}
		} else {
			$string = htmlspecialchars ( $string, ENT_QUOTES );
			$string = nl2br ( $string );
		}
		return $string;
	}
	public static function text_decode($str) {
		//HTML TO TEXT
		$str = preg_replace ( "'<head[^>]*?>.*?</head>'si", '', $str );
		$str = preg_replace ( "'<script[^>]*?>.*?</script>'si", '', $str );
		$str = preg_replace ( "'<style[^>]*?>.*?</style>'si", '', $str );
		
		$str = str_replace ( array ("\r\n\t", "\r\n", "\n\t", "\n", "\t", "\0" ), "", $str );
		$str = str_replace ( array ('<br>', '<br >', '<br/>', '<br />', '<BR>', '<BR >', '<BR/>', '<BR />', '<Br>', '<Br >', '<Br />' ), "\n", $str );
		$str = preg_replace ( "/<\/[^>]*>/i", "\n", $str );
		$str = str_replace ( array ("\r\n", " \r\n", "\r\n ", " \r \n", "\r \n ", "\r \n", "\n \r", "\n ", " \n" ), "\n", $str );
		$str = str_replace ( "\n\n", "\n", $str );
		$str = strip_tags ( $str );
		$str = str_replace ( '&nbsp;', ' ', $str );
		$str = str_replace ( '&quot;', '"', $str );
		$str = str_replace ( '&amp;', '&', $str );
		$str = str_replace ( '&lt;', '<', $str );
		$str = str_replace ( '&gt;', '>', $str );
		$str = str_replace ( '&raquo;', '?', $str );
		return $str;
	}
	public static function sql_arr($arr, $split = ',') {
		if (! is_array ( $arr ))
			$arr = explode ( $split, $arr );
		$ret = array ();
		foreach ( $arr as $var ) {
			if ($var === '' || $var === null || strtoupper ( $var ) === 'NULL')
				continue;
			$var = trim ( $var, "'" );
			$ret [] = "'" . $var . "'";
		}
		return implode ( ',', $ret );
	}
	public static function join_url($sfilename) {
		if ($sfilename == "") {
			return "?";
		}
		if (! strpos ( $sfilename, '?' )) {
			return $sfilename . "?";
		} else {
			if (substr ( $sfilename, strlen ( $sfilename ) - 1, 1 ) == "&") {
				return $sfilename;
			} else {
				return $sfilename . "&";
			}
		}
	}
	public static function byte_format($input, $dec = 2) {
		$prefix_arr = array ("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB" );
		$value = round ( $input, $dec );
		$i = 0;
		while ( $value >= 1024 ) {
			$value /= 1024;
			$i ++;
		}
		$return_str = round ( $value, $dec ) . $prefix_arr [$i];
		return $return_str;
	}
	public static function date_format($t, $f = 'Y-m-d H:i:s') {
		return date ( $f, $t );
	}
	public static function time_format($t) {
		//NULL
	}
	public static function randNum($len) {
		$ret = '';
		$arr = array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
		for($i = 0; $i < $len; $i ++) {
			if ($i == 0) {
				$ret .= $arr [rand ( 1, 9 )];
			} else {
				$ret .= $arr [rand ( 0, 9 )];
			}
		}
		return $ret;
	}
	public static function random($length = 4) {
		$ret = '';
		$arr = array (1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );
		for($i = 0; $i < $length; $i ++) {
			$ret .= $arr [rand ( 0, 19 )];
		}
		return $ret;
	}
	public static function randChar($length = 4) {
		$ret = '';
		$arr = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );
		for($i = 0; $i < $length; $i ++) {
			$ret .= $arr [rand ( 0, count ( $arr ) - 1 )];
		}
		return $ret;
	}
	public static function rand($md = true, $str = '') {
		$ret = '';
		if ($md) {
			$ret = microtime ();
			$ret .= "" . rand ( 100000000, 999999999 );
			$ret .= "" . rand ( 100000000, 999999999 );
			$ret .= $str;
			$ret = md5 ( $ret );
		} else {
			$ret = date ( "YmdHis" );
			$ret .= "" . rand ( 1000, 9999 );
		}
		
		return $ret;
	}
	public static function chk_fname($name) {
		$bad_str = array ('/', '\\', ':', '*', '?', '"', '<', '>', '|', ' ', '\'', '"', '-' );
		return str_replace ( $bad_str, '_', $name );
	}
	public static function chk_path($path, $root) {
		if (empty ( $root ))
			throw new Exception ( 'Method::chk_path 参数  $root 不能为空' );
		if (! is_dir ( $root ))
			throw new Exception ( "Method::chk_path 参数 $root 不存在" );
		self::mkdirs ( $root . $path );
	}
	public static function mkdirs($dir) {
		$dir = str_replace ( "\\", "/", $dir );
		$pdir = dirname ( $dir );
		while ( ! file_exists ( $pdir ) ) {
			self::mkdirs ( $pdir );
		}
		if (! file_exists ( $dir )) {
			mkdir ( $dir );
		}
	}
	public static function get_file($dir, $cdir = true, $ext = '*') {
		$arr_file = array ();
		$arr_ext = explode ( ',', $ext );
		if (! is_dir ( $dir ))
			return $arr_file;
		if ($handle = opendir ( $dir )) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if ($file != '.' && $file != '..') {
					$curr_file = str_replace ( '//', '/', $dir . '/' . $file );
					if (is_file ( $curr_file )) {
						$my_ext = end ( explode ( '.', $curr_file ) );
						if ($ext == '*' || in_array ( $my_ext, $arr_ext ))
							$arr_file [] = $curr_file;
					} elseif (is_dir ( $curr_file ))
						if ($cdir)
							$arr_file = array_merge ( $arr_file, self::get_flist ( $curr_file, $cdir, $ext ) );
				}
			}
			closedir ( $handle );
		}
		return $arr_file;
	}
	public static function get_folder($dir, $cdir = true) {
		$ret = array ();
		if (! is_dir ( $dir ))
			return $arr_file;
		if ($handle = opendir ( $dir )) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if ($file != '.' && $file != '..') {
					$curr_file = str_replace ( '//', '/', $dir . '/' . $file );
					if (is_dir ( $curr_file )) {
						$ret [] = $curr_file;
						if ($cdir)
							$ret = array_merge ( $ret, self::get_folders ( $curr_file, $cdir ) );
					}
				}
			}
			closedir ( $handle );
		}
		return $ret;
	}
	public static function del_folder($dir) {
		if (! is_dir ( $dir ))
			return true;
		if ($handle = opendir ( $dir )) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if ($file == '.' || $file == '..')
					continue;
				$curr_file = $dir . '/' . $file;
				if (is_dir ( $curr_file )) {
					if (! self::del_folder ( $curr_file ))
						return FALSE;
				} elseif (is_file ( $curr_file )) {
					unlink ( $curr_file );
				}
			}
			closedir ( $handle );
		}
		return rmdir ( $dir );
	}
	public static function get_fsize($dir) {
		if (! is_dir ( $dir ))
			return 0;
		$fz = 0;
		$fl = self::get_flist ( $dir );
		for($i = 0; $i < count ( $fl ); $i ++) {
			$fz += filesize ( $fl [$i] );
		}
		return $fz;
	}
	public static function download($path = null, $name = '', $type = 'bytes') {
		if (! file_exists ( $path ))
			die ( '不存在此文件' );
		$data = file_get_contents ( $path );
		self::downdata ( $data, $name, $type );
	}
	public static function downdata($data, $name, $type) {
		if (empty ( $data ))
			die ( "文件为空" );
		if ($name == null)
			$name = '下载';
		$name = self::chk_fname ( $name );
		$AGENT = strtoupper ( $_SERVER ['HTTP_USER_AGENT'] );
		if (strpos ( $AGENT, 'MSIE' ) !== false)
			$name = urlencode ( $name );
		
		//die( $name );
		ob_clean ();
		header ( "Pragma:public" );
		header ( "Content-type: " . $type . ";charset=utf-8" );
		header ( "Accept-Ranges: bytes" );
		//header("Accept-Length: ".strlen($data));
		header ( "Content-Disposition: attachment;filename=$name" );
		//$FILE= fopen($path,"r");
		//echo fread($FILE,filesize($path));
		echo $data;
		die ();
	}
	public static function get_ip() {
		if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), 'unknown' )) {
			$onlineip = getenv ( 'HTTP_CLIENT_IP' );
		} elseif (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), 'unknown' )) {
			$onlineip = getenv ( 'HTTP_X_FORWARDED_FOR' );
		} elseif (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), 'unknown' )) {
			$onlineip = getenv ( 'REMOTE_ADDR' );
		} elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], 'unknown' )) {
			$onlineip = $_SERVER ['REMOTE_ADDR'];
		} else {
			$onlineip = 'unknown';
		}
		if (($onlineip == '127.0.0.1') && ($_SERVER ['SERVER_NAME'] != '127.0.0.1') && (strtolower ( $_SERVER ['SERVER_NAME'] ) != 'localhost')) {
			$onlineip = getenv ( 'HTTP_X_FORWARD_FOR' );
		}
		return $onlineip;
	}
	public static function referer() {
		return $_SERVER ['HTTP_REFERER'];
	}
	public static function params() {
		$arg = $_REQUEST;
		$HTTP = isset ( $_SERVER ['HTTPS'] ) ? 'https' : 'http';
		$HOST = $_SERVER ['HTTP_HOST'];
		$NAME = $_SERVER ['SCRIPT_NAME'];
		$PATH = $_SERVER ['REQUEST_URI'];
		$PATH = str_replace ( $NAME, '', $PATH );
		$PATH = trim ( $PATH, '/' );
		$T = explode ( '?', $PATH );
		$PATH = $T [0];
		$params = array ();
		unset ( $arg ['PHPSESSID'] );
		foreach ( $arg as $k => $v ) {
			if (! is_string ( $v ))
				continue;
			if (substr ( $k, 0, 5 ) == 'tXSC_')
				continue;
			$params [$k] = $v;
		}
		return $params;
	}
	//----------------------------------------------
	public static function thunder_encode($url) {
		$url = "AA{$url}ZZ";
		$url = base64_encode ( $url );
		$url = 'thunder://' . $url;
		return $url;
	}
	public static function thunder_decode($url) {
		$name = explode ( "://", $url );
		$str = base64_decode ( $name [1] );
		return htmlspecialchars ( substr ( $str, 2, strrpos ( $str, 'ZZ' ) - 2 ) );
	}
	public static function flashget_encode($url) {
		$url = "[FLASHGET]{$url}[FLASHGET]";
		$url = base64_encode ( $url );
		$url = 'flashget://' . $url;
		return $url;
	}
	public static function flashget_decode($url) {
		$name = explode ( "://", $url );
		$str = base64_decode ( $name [1] );
		return htmlspecialchars ( substr ( $strk, 10, strrpos ( $strk, '[FLASHGET]' ) - 10 ) );
	}
	public static function qqdl_encode($url) {
		$url = base64_encode ( $url );
		$url = 'qqdl://' . $url;
		return $url;
	}
	public static function qqdl_decode($url) {
		$name = explode ( "://", $url );
		$str = $name [1];
		returnhtmlspecialchars ( base64_decode ( $name [1] ) );
	}
	//----------------------------------------------
	/**
	 * 检查是否缺少协议
	 * @param object $string
	 * @return
	 */
	function chk_http($str) {
		$url = $str;
		if (chker::isUrl ( $url ))
			return $url;
		$url = 'http://' . $str;
		if (chker::isUrl ( $url ))
			return $url;
		return $str;
	}
	static function chkImgPath($path, $host = '', $default = '') {
		$host || $host = HOST;
		if (strpos ( $path, 'http://' ) !== 0) {
			$path = rtrim ( $host, '/' ) . '/' . $path;
		} else {
		}
		if (! file_exists ( $path )) {
			//			$path=$default;
		}
		return $path;
	}
	static function convertip($ip) {
		
		$return = '';
		
		if (preg_match ( "/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip )) {
			
			$iparray = explode ( '.', $ip );
			
			if ($iparray [0] == 10 || $iparray [0] == 127 || ($iparray [0] == 192 && $iparray [1] == 168) || ($iparray [0] == 172 && ($iparray [1] >= 16 && $iparray [1] <= 31))) {
				$return = '- LAN';
			} elseif ($iparray [0] > 255 || $iparray [1] > 255 || $iparray [2] > 255 || $iparray [3] > 255) {
				$return = '- Invalid IP Address';
			} else {
				$tinyipfile = ROOT . config::$include . '/dat/tinyipdata.dat';
				if (file_exists ( $tinyipfile )) {
					$return = self::convertip_tiny ( $ip, $tinyipfile );
				}
			}
		}
		
		return $return;
	
	}
	
	static function convertip_tiny($ip, $ipdatafile) {
		
		static $fp = NULL, $offset = array (), $index = NULL;
		
		$ipdot = explode ( '.', $ip );
		$ip = pack ( 'N', ip2long ( $ip ) );
		
		$ipdot [0] = ( int ) $ipdot [0];
		$ipdot [1] = ( int ) $ipdot [1];
		
		if ($fp === NULL && $fp = @fopen ( $ipdatafile, 'rb' )) {
			$offset = unpack ( 'Nlen', fread ( $fp, 4 ) );
			$index = fread ( $fp, $offset ['len'] - 4 );
		} elseif ($fp == FALSE) {
			return '- Invalid IP data file';
		}
		
		$length = $offset ['len'] - 1028;
		$start = unpack ( 'Vlen', $index [$ipdot [0] * 4] . $index [$ipdot [0] * 4 + 1] . $index [$ipdot [0] * 4 + 2] . $index [$ipdot [0] * 4 + 3] );
		
		for($start = $start ['len'] * 8 + 1024; $start < $length; $start += 8) {
			
			if ($index {$start} . $index {$start + 1} . $index {$start + 2} . $index {$start + 3} >= $ip) {
				$index_offset = unpack ( 'Vlen', $index {$start + 4} . $index {$start + 5} . $index {$start + 6} . "\x0" );
				$index_length = unpack ( 'Clen', $index {$start + 7} );
				break;
			}
		}
		
		fseek ( $fp, $offset ['len'] + $index_offset ['len'] - 1024 );
		if ($index_length ['len']) {
			return '- ' . fread ( $fp, $index_length ['len'] );
		} else {
			return '- Unknown';
		}
	
	}
	static function range($first = '', $arr, &$results = array()) {
		$len = count ( $arr );
		if ($len == 1) {
			$results [] = ltrim ( $first . ',' . $arr [0], ',' );
		} else {
			for($i = 0; $i < $len; $i ++) {
				$tmp = $arr [0];
				$arr [0] = $arr [$i];
				$arr [$i] = $tmp;
				self::range ( $first . ',' . $arr [0], array_slice ( $arr, 1 ), $results );
			}
		}
	}
	static function setCookie($name, $val, $time = null) {
		if ($val === null) {
			//清除cookie
			$old = $_COOKIE [$name];
			if ($old !== null) {
				if (is_array ( $old )) {
					foreach ( $old as $ok => $ov ) {
						$newName = "$name" . '[' . "$ok" . ']';
						self::setCookie ( $newName, null );
					}
				} else {
					setcookie ( $name, null, time () - 3600 * 24, '/' );
				}
			}
		} else {
			if ($time === null) {
				$time = time () + 3600 * 24 * 30;
			} else {
				$time = time () + $time;
			}
			if (is_array ( $val )) {
				foreach ( $val as $k => $v ) {
					$newName = "$name" . '[' . "$k" . ']';
					self::setCookie ( $newName, $v );
				}
			} else {
				setcookie ( $name, $val, $time, '/' );
			}
		}
	
	}
	static function getCookie($name) {
		return $_COOKIE [$name];
	}
	// 同理获取访问用户的操作系统的信息
	function getUserAgent() {
		$Agent = $_SERVER ['HTTP_USER_AGENT'];
		$browserplatform = '';
		if (eregi ( 'win', $Agent ) && strpos ( $Agent, '95' )) {
			$browserplatform = "Windows 95";
		} elseif (eregi ( 'win 9x', $Agent ) && strpos ( $Agent, '4.90' )) {
			$browserplatform = "Windows ME";
		} elseif (eregi ( 'win', $Agent ) && ereg ( '98', $Agent )) {
			$browserplatform = "Windows 98";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 5.0', $Agent )) {
			$browserplatform = "Windows 2000";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 5.1', $Agent )) {
			$browserplatform = "Windows XP";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 6.0', $Agent )) {
			$browserplatform = "Windows Vista";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 6.1', $Agent )) {
			$browserplatform = "Windows 7";
		} elseif (eregi ( 'win', $Agent ) && ereg ( '32', $Agent )) {
			$browserplatform = "Windows 32";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt', $Agent )) {
			$browserplatform = "Windows NT";
		} elseif (eregi ( 'Mac OS', $Agent )) {
			$browserplatform = "Mac OS";
		} elseif (eregi ( 'linux', $Agent )) {
			$browserplatform = "Linux";
		} elseif (eregi ( 'unix', $Agent )) {
			$browserplatform = "Unix";
		} elseif (eregi ( 'sun', $Agent ) && eregi ( 'os', $Agent )) {
			$browserplatform = "SunOS";
		} elseif (eregi ( 'ibm', $Agent ) && eregi ( 'os', $Agent )) {
			$browserplatform = "IBM OS/2";
		} elseif (eregi ( 'Mac', $Agent ) && eregi ( 'PC', $Agent )) {
			$browserplatform = "Macintosh";
		} elseif (eregi ( 'PowerPC', $Agent )) {
			$browserplatform = "PowerPC";
		} elseif (eregi ( 'AIX', $Agent )) {
			$browserplatform = "AIX";
		} elseif (eregi ( 'HPUX', $Agent )) {
			$browserplatform = "HPUX";
		} elseif (eregi ( 'NetBSD', $Agent )) {
			$browserplatform = "NetBSD";
		} elseif (eregi ( 'BSD', $Agent )) {
			$browserplatform = "BSD";
		} elseif (ereg ( 'OSF1', $Agent )) {
			$browserplatform = "OSF1";
		} elseif (ereg ( 'IRIX', $Agent )) {
			$browserplatform = "IRIX";
		} elseif (eregi ( 'FreeBSD', $Agent )) {
			$browserplatform = "FreeBSD";
		}
		if ($browserplatform == '') {
			$browserplatform = "Unknown";
		}
		return $browserplatform;
	}
	/**
	 * post提交数据
	 *
	 */
	static function curl_post($url, $arg = NULL, $getCookie = 0, $sendCookie = 0, $header = null, $ingore = false) {
		if (empty ( $arg ))
			$arg = array ();
		$ch = curl_init ();
		$ip = rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 );
		$ip = '125.41.178.17';
		$headers ['CLIENT-IP'] = $ip;
		$headers ['X-FORWARDED-FOR'] = $ip;
		
		$headerArr = array ();
		foreach ( $headers as $n => $v ) {
			$headerArr [] = $n . ':' . $v;
		}
		//		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headerArr ); //构造IP
		//		curl_setopt ( $ch, CURLOPT_REFERER, "http://www.sohu.com/ " ); //构造来路
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $arg ) );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
		if ($getCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEJAR,  C ( 'DATA_CACHE_PATH' ) . '/cookie.txt' );
		}
		if ($sendCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEFILE, C ( 'DATA_CACHE_PATH' ) . 'cookie.txt' );
		}
		if (is_array ( $header )) {
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		}
		curl_setopt ( $ch, CURLOPT_NOBODY, FALSE );
		if ($ingore) {
			curl_setopt ( $ch, CURLOPT_TIMEOUT, 1 );
			curl_exec ( $ch );
			curl_close ( $ch );
			return;
		}
		$output = curl_exec ( $ch );
		if ($output === FALSE) {
			echo "<p>curlException：" . curl_errno ( $ch );
			echo "<p>curlException：" . curl_error ( $ch );
			curl_close ( $ch );
			return '';
		
		//			throw new Exception ( curl_error ( $ch ) );
		}
		curl_close ( $ch );
		return $output;
	}
	/**
	 * get提交数据
	 *
	 */
	static function curl_get($url, $getCookie = 0, $sendCookie = 0, $header = null, $ingore = false, $headers = array(), $referer = '') {
		$ch = curl_init ();
		$ip = rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 ) . '.' . rand ( 10, 224 );
		$ip = '110.75.39.21';
		$headers ['CLIENT-IP'] = $ip;
		$headers ['X-FORWARDED-FOR'] = $ip;
		$headerArr = array ();
		foreach ( $headers as $n => $v ) {
			$headerArr [] = $n . ':' . $v;
		}
		//		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headerArr ); //构造IP
		curl_setopt ( $ch, CURLOPT_REFERER, $referer ); //构造来路
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; c8650 Build/GWK74) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1s' );
		
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
		if ($getCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEJAR, C ( 'DATA_CACHE_PATH' ) . '/cookie.txt' );
		}
		if ($sendCookie) {
			curl_setopt ( $ch, CURLOPT_COOKIEFILE, C ( 'DATA_CACHE_PATH' ) . '/cookie.txt' );
		}
		if (is_array ( $header )) {
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		}
		curl_setopt ( $ch, CURLOPT_NOBODY, FALSE );
		if ($ingore) {
			curl_setopt ( $ch, CURLOPT_TIMEOUT, 1 );
			curl_exec ( $ch );
			curl_close ( $ch );
			return;
		}
		$output = curl_exec ( $ch );
		if ($output === FALSE) {
			echo "<p>curlException：" . curl_errno ( $ch );
			echo "<p>curlException：" . curl_error ( $ch );
			curl_close ( $ch );
			return '';
		}
		curl_close ( $ch );
		return $output;
	}
}
?>
