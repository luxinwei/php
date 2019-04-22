<?php
import ( "ORG.Util.Session" );
class QAction extends Action {
	protected $q_model;
	protected $token;
	function __construct($modle_name = '') {
		if (! empty ( $modle_name )) {
			$this->q_model = D ( $modle_name );
		}
		parent::__construct ();
//		$this->hand_miyao ();
		
		$token = I ( 'token' );
		
		if (empty ( $token )) {
			session_regenerate_id ();
			session_start ();
			$this->token = session_id ();
		} else {
			if (! $this->chkToken ( $token )) {
				return $this->q_error ( "非法请求" );
				
			}
			session_id ( $token );
			session_start ();
			
			$this->token = $token;
		}
	
	}
	
	function chkToken($token) {
		
		$session_hash = ini_get ( "session.hash_function" );
//		if ($session_hash == '0') {
//			if (strlen ( $token ) != 32) {
//				return false;
//			}
//		
//		}
		return true;
	}
	
	function q_success($mix_data, $jump_url = '',$is_ajax=0) {
		$ret = array ('status' => 1, "info" => '', 'token' => $this->token );
		if (is_string ( $mix_data )) {
			$ret ['info'] = $mix_data;
		} elseif (is_array ( $mix_data )) {
			$ret = array_merge ( $ret, $mix_data );
		}
		$is_ajax=IS_AJAX;
		if ($is_ajax) {
			if (! empty ( $jump_url )) {
				$ret ['jump_url'] = $jump_url;
			}
			return $this->q_jsonReturn ( $ret );
		
		} else {
			if (is_array ( $mix_data )) {
				foreach ( $mix_data as $k => $v ) {
					$this->assign ( $k, $v );
				}
			}
			return $this->success ( $ret ['info'], $jump_url );
		}
	
	}
	
	function q_error($mix_data, $jump_url = '',$is_ajax=0) {
		$ret = array ('status' => 0, "info" => '', 'token' => $this->token );
		if (is_string ( $mix_data )) {
			$ret ['info'] = $mix_data;
		} elseif (is_array ( $mix_data )) {
			$ret = array_merge ( $ret, $mix_data );
		}
		$is_ajax=IS_AJAX;
		if ($is_ajax) {
			if (! empty ( $jump_url )) {
				$ret ['jump_url'] = $jump_url;
			}
			return $this->q_jsonReturn ( $ret );
		
		} else {
			if (is_array ( $mix_data )) {
				foreach ( $mix_data as $k => $v ) {
					$this->assign ( $k, $v );
				}
			}
			return $this->error ( $ret ['info'], $jump_url );
		}
	
	}
	
	function q_text($msg) {
		header ( "Content-Type:text/html; charset=utf-8" );
		exit ( $msg );
	}
	
	function q_display($templateFile = '', $charset = '', $contentType = '') {
		$this->display ( $templateFile, $charset, $contentType );
	}
	
	function q_jsonReturn($data) {
		header ( "Content-Type:text/html; charset=utf-8" );
		exit ( json_encode ( $data ) );
	}
	
	function q_bathAssign($mix_data) {
		foreach ( $mix_data as $k => $v ) {
			$this->assign ( $k, $v );
		}
	}
	function q_assign($k, $v) {
		$this->assign ( $k, $v );
	}
	function q_param($name, $default = '', $filter = '') {
		return I ( $name, $default, $filter );
	}
	function q_pageList($list) {
		$this->assign ( "list", $list );
		$Page = new QPage ( $list ['total'] ); // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show (); // 分页显示输出
		$this->assign ( 'page', $show ); // 赋值分页输出
	}
	function q_pageSet($nowPage, $apageNum = '') {
		$Page = new QPage ( 1 );
		
		if (! empty ( $nowPage )) {
			$_GET [$Page->varPage] = $_POST [$Page->varPage] = $nowPage;
		
		}
		if (! empty ( $apageNum )) {
			
			$_GET [$Page->varOnePage] = $_POST [$Page->varOnePage] = $apageNum;
		}
	}
	
	public function q_mret($ret, $successinfo = '', $errorinfo = '', $jump_url = '') {
		if (empty ( $ret )) {
			return $this->q_success ( $successinfo, $jump_url );
		}
		//		foreach ( $ret as $k => $v ) {
		//			if ($k != 'status' && $k != 'info') {
		//				$this->addPageData ( $k, $v );
		//			}
		//		}
		if ($ret ['status'] == 1) {
			if (empty ( $successinfo ) && ! empty ( $ret ['info'] )) {
				$successinfo = $ret ['info'];
			}
			return $this->q_success ( $successinfo, $jump_url );
		} elseif ($ret ['status'] == 0) {
			if (empty ( $errorinfo ) && ! empty ( $ret ['info'] )) {
				$errorinfo = $ret ['info'];
			}
			return $this->q_error ( $errorinfo, $jump_url );
		} else {
			$ret ['info'] || $ret ['info'] = $successinfo;
			return $this->q_success ( array ('status' => $ret ['status'], 'info' => $ret ['info'] ), $jump_url );
		}
	}
	
	function hand_miyao() {
		$arg = array ();
		if (IS_POST) {
			$arg = $_POST;
		} else {
			
			$arg = $_GET;
		}
		$arg = $this->argSort ( $arg );
		
		$miyao = "dzqc2016yui" . ACTION_NAME;
		$param_str = "";
		foreach ( $arg as $name => $val ) {
			if ($name == "secret_key" || $name == '_URL_') {
				continue;
			}
			$param_str .= $name;
		}
		if (empty ( $param_str )) {
			return true;
		
		}
		$hash = md5 ( $param_str . $miyao );
		if ($hash != $arg ["secret_key"]) {
			$this->q_error ( array ('info' => "非法请求，数据校验失败", 'status' => 401 ) );
			die ();
		}
	
	}
	
	function argSort($para) {
		ksort ( $para );
		reset ( $para );
		return $para;
	}
}

?>