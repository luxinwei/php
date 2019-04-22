<?php
class Chker {
	# 是否是邮件格式
	public static function isEmail($str) {
		return preg_match ( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str );
	}
	public static function isUrl($str) {
		return (preg_match ( "/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/", $str )) ? true : false;
	}
	# 是否全部由数字组成 （科学计数法匹配不成功）
	public static function isInt($str) {
		return preg_match ( "/^[0-9]+$/", $str );
	}
	public static function isNum($str) {
		Return (preg_match ( "/^[.0-9-]+$/", $str )) ? true : false;
	}
	public static function isStr($str) {
		Return (preg_match ( "/^[|,_@a-zA-Z0-9-]+$/", $str )) ? true : false;
	}
	# 检查字符串 必须以字母或者下划线开头 只能包含字母 数字 下划线 上划线
	public static function isName($str) {
		return preg_match ( "/^[@_a-zA-Z0-9-]+$/i", $str );
	}
	//-----------------------------------------------------------------------------------
	// 函数名：CheckUser($C_user)
	// 作 用：判断是否为合法用户名
	// 参 数：$C_user（待检测的用户名）
	// 返回值：布尔值
	// 备 注：无
	//-----------------------------------------------------------------------------------
	static function isUsername($username, $min = 1, $max = 15) {
		if (! self::len ( $username, $min, $max ))
			return false; //宽度检验
		if (! ereg ( "^[_a-zA-Z0-9]*$", $username ))
			return false; //特殊字符检验
		return true;
	}
	# 全部是中文
	public static function isFont($str) {
		return (! eregi ( "[^\x80-\xff]", $str ));
	}
	# 包含中文
	public static function inFont($str) {
		return preg_match ( "/[\x80-\xff]./", $str );
	}
	# 全是英文字母
	public static function isChar($str) {
		return preg_match ( "/^[A-Za-z]+$/", $str );
	}
	# 检查手机号码
	public static function isMobile($mobile) {
		if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
	}
	# 匹配电话号码 （可以加区号）
	public static function isPhone($str) {
		return (preg_match ( "/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $str )) ? true : false;
	}
	# 匹配邮编
	public static function isZip($str) {
		if (strlen ( $str ) != 6) {
			return false;
		}
		if (substr ( $str, 0, 1 ) == 0) {
			return false;
		}
		return true;
	}
	# 身份证
	function isCard($str) {
		return (preg_match ( '/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/', $str )) ? true : false;
	}
	# 匹配 QQ 号码
	public static function isQQ($str) {
		if (ereg ( "^[1-9][0-9]{4,}$", $str )) {
			return true;
		}
		return false;
	}
	# 匹配日期
	public static function isDate($str) {
		$dateArr = explode ( "-", $str );
		if (is_numeric ( $dateArr [0] ) && is_numeric ( $dateArr [1] ) && is_numeric ( $dateArr [2] )) {
			if (($dateArr [0] >= 1000 && $timeArr [0] <= 10000) && ($dateArr [1] >= 0 && $dateArr [1] <= 12) && ($dateArr [2] >= 0 && $dateArr [2] <= 31))
				return true;
			else
				return false;
		}
		return false;
	}
	# 匹配时间
	public static function isTime($str) {
		$timeArr = explode ( ":", $str );
		if (is_numeric ( $timeArr [0] ) && is_numeric ( $timeArr [1] ) && is_numeric ( $timeArr [2] )) {
			if (($timeArr [0] >= 0 && $timeArr [0] <= 23) && ($timeArr [1] >= 0 && $timeArr [1] <= 59) && ($timeArr [2] >= 0 && $timeArr [2] <= 59))
				return true;
			else
				return false;
		}
		return false;
	}
	# 匹配IP地址
	public static function isIP($str) {
		$exp = array ();
		if ($exp = explode ( '.', $str )) {
			foreach ( $exp as $val ) {
				if ($val > 255) {
					return FALSE;
					exit ();
				}
			}
		}
		return preg_match ( "/^[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}$/", $str );
	}
	# 匹配长度 ，第二个参数是最小长度 ，第三个参数 是最大长度
	public static function len($str, $min = 1, $max = 0) {
		$len = mb_strlen ( $str, 'UTF-8' );
		if ($max === 0) {
			$flag = $len >= $min ? true : false;
			return $flag;
		}
		$flag = ($len >= $min && $len <= $max) ? true : false;
		return $flag;
	}
	# 自定义正则  进行匹配
	public static function match($str, $reg) {
		return preg_match ( $reg, $str );
	}
	# 滤掉JS脚本
	public static function clearJs($str) {
		$text = trim ( $text );
		$text = stripslashes ( $text );
		$text = preg_replace ( '/<\?|\?>/', '', $text );
		$text = preg_replace ( '/<script?.*\/script>/', '', $text );
		$text = preg_replace ( '/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/i', '', $text );
		while ( preg_match ( '/(<[^><]+)(lang|onfinish||onerror|||onfocus|onblur)[^><]+/i', $text, $mat ) ) {
			$text = str_replace ( $mat [0], $mat [1], $text );
		}
		while ( preg_match ( '/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat ) ) {
			$text = str_replace ( $mat [0], $mat [1] . $mat [3], $text );
		}
		return $text;
	}
}
?>