<?php
include_once dirname(__FILE__)."/../DB.class.php";
include_once dirname(__FILE__)."/../Fun.class.php";
include_once dirname(__FILE__)."/../ParaUtil.class.php";
class MobileUtil {
	private $mobileStartTitle="";
	private $mobileUserid="112";
	private $mobileAccount="";
	private $mobilePassowrd="";
	private $mobileAddress="http://47.93.39.102:18002/send.do";

	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	function getMobileMask($mobile,$startcont){
		
		if($mobile==""){
			$json="{\"success\":\"0\",\"msg\":\"手机号不能为空!\"}";
			return $json;
			exit();
		}
		$mask=rand(100000, 999999);
		$maskavaildate=date('Y-m-d H:i:s',strtotime("+3 minute"));
		$str=base64_encode($mask."#".$maskavaildate."#".$mobile);
		$content=$this->mobileStartTitle."您的".$startcont."验证码是：".$mask."。请不要把验证码泄露给其他人。";
	
		//$content=iconv('UTF-8', 'GBK', $content);
		$tm=date('YmdHis');
		$pw=md5($this->mobilePassowrd.$tm);
		//$pw=$this->mobilePassowrd;
		$sendurl=$this->mobileAddress."?uid=".$this->mobileUserid."&pw=".$pw."&mb=".$mobile."&ms=".$content."&tm=".$tm."&dm=&ex=";

		
		$result =  file_get_contents($sendurl);
		$resultArray=explode(',', $result);
		if(count($resultArray)==2){
			$resultcode = $resultArray[0];
			$resultmsg  = $resultArray[1];
			if($resultcode=="0"){
				$json="{\"success\":\"1\",\"content\":\"".$str."\",\"msg\":\"成功!\"}";
			}else{
				$json="{\"success\":\"0\",\"msg\":\"验证码不能正确发出，原因是：".$resultmsg."\"}";
				
			}
		}
		return $json;
	}
	
	##########################################
	//http://sms.ihuyi.com/login.php?act=login&username=cf_lwsm&password=abc123
	function setMobileMask($memberObj,$mobile,$startcont){
		$mobile_isopen=Fun::getInt(ParaUtil::getInstance()->getContent("MOBILE_ISOPEN"), 0);
		if ($mobile_isopen!=1){
			$json="{success:0,msg:'对不起，手机号注册服务还没有打开，不能通过手机号注册'}";
			echo $json;
			exit();
		}
		$account=ParaUtil::getInstance()->getContent("MOBILE_ACCOUNT");
		$password=ParaUtil::getInstance()->getContent("MOBILE_PASSWORD");
		if($mobile=="")$mobile=trim($memberObj["MOBILE"]);
		if($mobile==""){
			$json="{\"success\":\"0\",\"msg\":\"失败!\"}";
			return $json;
			exit();
		}
		$mask=rand(100000, 999999);
		$maskavaildate=date('Y-m-d H:i:s',strtotime("+3 minute"));
		$colArr=array();
		$colArr["MASK"]=$mask;
		$colArr["MASKAVAILDATE"]=$maskavaildate;
		$isok=DB::getInstance()->updateByArray("csm_member", $colArr," and usercode='".$memberObj["USERCODE"]."'");
		$content=$this->mobileStartTitle."您的".$startcont."验证码是：".$mask."。请不要把验证码泄露给其他人。";
		$content=iconv('UTF-8', 'GBK', $content);
		$tm=date('YmdHis');
		$pw=md5($this->mobilePassowrd.$tm);
		$sendurl=$this->mobileAddress."?uid=".$this->mobileUserid."&pw=".$pw."&mb=".$mobile."&ms=".$content."&tm=".$tm."&dm=&ex=";
		$result =  file_get_contents($sendurl);
		$resultArray=explode(',', $result);
		if(count($resultArray)==2){
			$resultcode = $resultArray[0];
			$resultmsg  = $resultArray[1];
			if($resultcode=="0"){
					$json="{\"success\":\"1\",\"msg\":\"成功!\"}";
			}else{
				$json="{\"success\":\"0\",\"msg\":\"验证码不能正确发出，原因是：".$resultmsg."\"}";
		
			}
		}
		return $json;
	}
	
}
//header("Content-type: text/html; charset=utf-8");
//$mobile="18100325860";
//MobileUtil::getInstance()->getMobileMask($mobile);
?>	