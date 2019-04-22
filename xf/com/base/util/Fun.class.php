<?php
class Fun {
	public static function getRootDir(){
		$rootdir=str_ireplace("/com/base/util/Fun.class.php","",strtr(__FILE__,"\\","/"));
		return $rootdir;
	}
	public static function request($name){
 		$temp = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") $temp=$_POST[$name];
		if ($_SERVER["REQUEST_METHOD"] == "GET")  $temp=iconv('gb2312', 'UTF-8', $_GET[$name]);		
		$temp=self::CheckReplace(trim($temp));
		
 		return $temp;
	}
	public static function requestInt($name,$def){
		$temp = $def;
		if ($_SERVER["REQUEST_METHOD"] == "POST") $temp=$_POST[$name];
		if ($_SERVER["REQUEST_METHOD"] == "GET")  $temp=$_GET[$name];
		$temp=self::CheckReplace(trim($temp));
		$temp=intval($temp);
		if(!is_int($temp))$temp=$def;
		return $temp;
	}

	public static function requestFloat($name){
		$temp = 0.00;
		if ($_SERVER["REQUEST_METHOD"] == "POST") $temp=$_POST[$name];
		if ($_SERVER["REQUEST_METHOD"] == "GET")  $temp=$_GET[$name];
		$temp=self::CheckReplace(trim($temp));
		if(is_float($temp)) return $temp;
		if(is_int($temp))return $temp;
		return $temp;
	}
	//==========================================================================================
	//整形
	public static function getInt($name,$def){
		$temp = $name;
		if($temp=="")$temp=$def;
		$temp=intval($temp);
		if(!is_int($temp))$temp=$def;
		//if($temp=="")$temp=$def;
		return $temp;
	}
	
	//浮点数
	public static function getFloat($name){
		$temp = (float)$name;
		if(!is_float($temp))$temp=0.00;
		return $temp;
	}
	//元转化为分，不四舍五入
	public static function getIntFenByYuan($yuan){
		$fen=self::getFloat($yuan)*100;
		if(substr_count($fen,".")>0)$fen=floor($fen);
		return $fen;
	}
	//分转化为元
	public static function getFloatYuanByFen($fen){
		$yuan=self::getInt($fen)/100;
		$yuan=sprintf("%.2f", $yuan);
		return $yuan;
	}
	//==========================================================================================
	public static function getUUID(){
		$uuid=uniqid(mt_rand(), true);
		$uuid=str_replace(".","",$uuid);
		return $uuid;
	}
	public static function getDateTimekey(){
		$result = date("YmdHis") . rand(10000, 99999);
		return $result;
	}
	public static function CheckReplace($str){
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
	//	$str = str_replace("and","",$str);
		$str = str_replace("execute","",$str);
		$str = str_replace("update","",$str);
		//$str = str_replace("count","",$str);
		$str = str_replace("chr","",$str);
		$str = str_replace("mid","",$str);
		$str = str_replace("master","",$str);
		$str = str_replace("truncate","",$str);
		$str = str_replace("char","",$str);
		$str = str_replace("declare","",$str);
		$str = str_replace("select","",$str);
		$str = str_replace("create","",$str);
		$str = str_replace("delete","",$str);
		$str = str_replace("insert","",$str);
		//$str = str_replace("or","",$str);
		//$str = str_replace("=","",$str);
		
		$str = str_replace("%20","",$str);
		$str = str_replace("'","",$str);
		$str = str_replace("\"","",$str);
		//$str = str_replace(" ","",$str);
		$str = str_replace(">","",$str);
		$str = str_replace("<","",$str);
		$str = str_replace("&","",$str);
		return $str;
	}
	public static function getMarksStrByComma($strList){
		$idlist1="";
		$idArray=explode(",",$strList);
		foreach($idArray as $id) {
			if($idlist1!="")$idlist1.=",";
			$idlist1.="'".$id."'";
		}
		$idlist=$idlist1;
		return $idlist;
	}
	/*
	 Utf-8、gb2312都支持的汉字截取函数
	 cut_str(字符串, 截取长度, 开始长度, 编码);
	 编码默认为 utf-8
	 开始长度默认为 0
	 */
	
	public static function sub_str($string,  $start = 0,$sublen=10, $code = 'UTF-8') {
		if($code == 'UTF-8') {
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all($pa, $string, $t_string);
			//if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
			return join('', array_slice($t_string[0], $start, $sublen));
		} else {
			$start = $start*2;
			$sublen = $sublen*2;
			$strlen = strlen($string);
			$tmpstr = '';
	
			for($i=0; $i< $strlen; $i++) {
				if($i>=$start && $i< ($start+$sublen)) {
					if(ord(substr($string, $i, 1))>129) {
						$tmpstr.= substr($string, $i, 2);
					} else {
						$tmpstr.= substr($string, $i, 1);
					}
				}
				if(ord(substr($string, $i, 1))>129) $i++;
			}
			if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
			return $tmpstr;
		}
	}
//==========================================================================================
	/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
 public static function encode($string = '') {
	$skey = date("Y-m-d")."hmsoft";
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
 }
 /**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
  public static function decode($string = '') {
	$skey = date("Y-m-d")."hmsoft";
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
 }
 /*
  * 二维数组排序
  * $direction 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
  * $field  排序字段
  * $curArray 排序数组
  * */
 function towArraySort($direction,$field,$curArray){
 	$sort = array(
 			'direction' => $direction, //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
 			'field'     => $field,       //排序字段
 	);
 	$arrSort = array();
 	foreach($curArray AS $uniqid => $row){
 		foreach($row AS $key=>$value){
 			$arrSort[$key][$uniqid] = $value;
 		}
 	}
 	if($sort['direction']){
 		array_multisort($arrSort[$sort['field']], constant($sort['direction']), $curArray);
 	}
 	return $curArray;
 }
 /*
 例如：
   echo '<pre>';
$str = '111';
$enstring = Fun::encode($str);
$decode=Fun::decode($enstring);
echo "string : " . $str . " <br />";
echo "encode : " . $enstring . "<br />";
echo "decode : " .$decode ;
 die();
 */
 /**
  * 求两个日期之间相差的天数
  * (针对1970年1月1日之后，求之前可以采用泰勒公式)
  * @param string $day1
  * @param string $day2
  * @return number
  */
 public static function diffBetweenTwoDays ($day1, $day2)
 {
 	$second1 = strtotime($day1);
 	$second2 = strtotime($day2);
 
 	if ($second1 < $second2) {
 		$tmp = $second2;
 		$second2 = $second1;
 		$second1 = $tmp;
 	}
 	return ($second1 - $second2) / 86400;
 }
// $day1 = "2013-07-27";
// $day2 = "2013-08-04";
// $diff = diffBetweenTwoDays($day1, $day2);
// echo $diff."\n";
	//==========================================================================================
	//设置缓存
	public static function setCache($key, $obj) {
		$cache_dir=self::getRootDir()."/cachedata";
		if(!file_exists($cache_dir))mkdir($cache_dir);
		$file = $cache_dir."/".$key.".txt";
		$msg = serialize($obj);
		$fp = fopen($file,"w");
		fputs($fp,$msg);
		fclose($fp);
	}
	//读取缓存
	public static function getCache($key){
		$file = self::getRootDir()."/cachedata/".$key.".txt";
		$msg = file_get_contents($file);
		$result = unserialize($msg);
		return $result;

	}
	//清除缓存
	public static function clearCache(){
		$cachepath = self::getRootDir()."/cachedata";
		self::delDir($cachepath);
		return true;

	}
	function _SERVER($n) { return isset($_SERVER[$n]) ? $_SERVER[$n] : '[undefine]'; }
	//======================================================================================================
	public static function  delDir($delDir) {
		self::log($delDir);
		if ($handle = opendir($delDir) ) {
			while ( false!==( $item = readdir( $handle ) ) ) {
				if ( $item != "." && $item != ".." ) {
					if ( is_dir( $delDir."/".$item) ) {
						self::delDir( $delDir."/".$item );
					} else {
						unlink($delDir."/".$item);
					}
	
				}
			}
			closedir( $handle );
			rmdir( $delDir );
		}
	}
	public static function http_requestGet($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: token 4e56266f2502936e0378ea6a985dc74a5bec4280'));
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	public static function http_request($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	public static function httpRequestPost($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	public static function httpRequestPUT($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	public static function httpRequestPATCH($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	

	public static function httpRequestDelete($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl, CURLOPT_POSTFIELDS,$data);;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	
	
	/**
	 * @param $URL 请求链接
	 * @param null $data 数据 array() string
	 * @param string $type 请求类型 POST GET PUT DELETE
	 * @param string $headers 头部信息
	 * @param string $data_type 返回数据类型 默认为json
	 * @return mixed
	 */
	public static function callRequest($URL,$data=null,$type='POST',$headers="",$data_type='json'){
	
		$ch = curl_init();
		//判断ssl连接方式
		if(stripos($URL, 'https://') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		}
		$connttime=300; //连接等待时间500毫秒
		$timeout = 15000;//超时时间15秒
	
		$querystring = "";
		if (is_array($data)) {
			// Change data in to postable data
			foreach ($data as $key => $val) {
				if (is_array($val)) {
					foreach ($val as $val2) {
						$querystring .= urlencode($key).'='.urlencode($val2).'&';
					}
				} else {
					$querystring .= urlencode($key).'='.urlencode($val).'&';
				}
			}
			$querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
		} else {
			$querystring = $data;
		}
	
		// echo $querystring;
		curl_setopt ($ch, CURLOPT_URL, $URL); //发贴地址
		//设置HEADER头部信息
		/*
		        if($headers!=""){
		            curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
		        }else {
		            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
		        }
		*/
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);//反馈信息
		curl_setopt ($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); //http 1.1版本
	
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT_MS, $connttime);//连接等待时间
		curl_setopt ($ch, CURLOPT_TIMEOUT_MS, $timeout);//超时时间
	
		switch ($type){
			case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
			case "POST": curl_setopt($ch, CURLOPT_POST,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
			case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
			case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
			case "PATCH": curl_setopt($ch,  CULROPT_CUSTOMREQUEST, 'PATCH');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);break;
		}
		$file_contents = curl_exec($ch);//获得返回值

		$status = curl_getinfo($ch);

		curl_close($ch);
		if($data_type=="json"||$data_type=="JSON"){
			return json_encode($file_contents);
		}else{
			return $file_contents;
		}
	}

	
	//调试使用
	public static function log($msg){
		include_once 'FileUtil.class.php';
		$file_path=self::getRootDir()."/alog/log_".date('Y-m-d').".txt";
		//FileUtil::getInstance()->writetofile($file_path, $msg);
		$msg="\n[".date("Y-m-d H:i:s")."][debug] ".$msg;
		FileUtil::getInstance()->writetofileAdd($file_path, $msg);
	}
}
?>
