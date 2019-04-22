<?php
include_once dirname(__FILE__)."/../DB.class.php";
include_once dirname(__FILE__)."/../Fun.class.php";
include_once dirname(__FILE__)."/../ParaUtil.class.php";
include_once dirname(__FILE__)."/../FileUtil.class.php";
include_once dirname(__FILE__)."/email.class.php";
header("Content-type:text/html; charset=UTF-8");
class MailUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	/*
	 $smtpinfo["host"] = "smtp.exmail.qq.com";//SMTP服务器
	 $smtpinfo["port"] = "25"; //SMTP服务器端口
	 $smtpinfo["username"] = ""; //发件人邮箱
	 $smtpinfo["password"] = "";//发件人邮箱密码
	 */
	##########################################
	function getMailMask($email){
		if($email==""){
			$json="{\"success\":\"0\",\"msg\":\"邮箱不能为空!\"}";
			return $json;
			exit();
		}
		$mask=rand(100000, 999999);
		$maskavaildate=date('Y-m-d H:i:s',strtotime("+3 minute"));
		$str=base64_encode($mask."#".$maskavaildate);
		$title = "特赋云打印";//邮件主题
		$content = FileUtil::getInstance()->getFileContent(strtr(dirname(__FILE__),"\\","/")."/template/mail_mask.php");//邮件内容
		$content=str_ireplace("#title#",$title,$content);
		$content=str_ireplace("#mask#",$mask,$content);
		$content=str_ireplace("#date#",date("Y-m-d H:i:s"),$content);
		$subject=$title."注册验证码";
		$contentType = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		$smtpinfo = array();
		$smtpinfo["host"] = ParaUtil::getInstance()->getContent("MAILSERVER_HOST");//SMTP服务器
		$smtpinfo["port"] = ParaUtil::getInstance()->getContent("MAILSERVER_PORT"); //SMTP服务器端口
		$smtpinfo["username"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER"); //发件人邮箱
		$smtpinfo["password"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER_PWD");//发件人邮箱密码
		$smtp = new smtp($smtpinfo["host"],$smtpinfo["port"],true,$smtpinfo["username"],$smtpinfo["password"]);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = FALSE;//是否显示发送的调试信息
		$isok=$smtp->sendmail($email, $smtpinfo["username"], $subject, $content, $contentType);
		if($isok){
			$json="{\"success\":\"1\",\"content\":\"".$str."\",\"msg\":\"成功!\"}";
			return $json;
		}else{
			$msg=$gets['SubmitResult']['msg'];
			$json="{\"success\":\"0\",\"msg\":\"验证码不能正确发出，\"}";
			return $json;
		}
		return $json;
	}
	
	
	function sendMsg($email,$title,$content){
		$subject=$title;
		$contentType = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件	
		$smtpinfo = array();
		$smtpinfo["host"] = ParaUtil::getInstance()->getContent("MAILSERVER_HOST");//SMTP服务器
		$smtpinfo["port"] = ParaUtil::getInstance()->getContent("MAILSERVER_PORT"); //SMTP服务器端口
		$smtpinfo["username"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER"); //发件人邮箱
		$smtpinfo["password"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER_PWD");//发件人邮箱密码
		$smtp = new smtp($smtpinfo["host"],$smtpinfo["port"],true,$smtpinfo["username"],$smtpinfo["password"]);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = FALSE;//是否显示发送的调试信息
		$isok=$smtp->sendmail($email, $smtpinfo["username"], $subject, $content, $contentType);
		
		return $isok;
	}
	
	function setMailMask($memberObj,$email){
		if($email=="")$email=trim($memberObj["EMAIL"]);
		if($email==""){
			return false;
			exit();
		}
		$mask=rand(100000, 999999);
		$maskavaildate=date('Y-m-d H:i:s',strtotime("+3 minute"));
		$colArr=array();
		$colArr["MASK"]=$mask;
		$colArr["MASKAVAILDATE"]=$maskavaildate;
		$isok=DB::getInstance()->updateByArray("csm_member", $colArr," and usercode='".$memberObj["USERCODE"]."'");
	
		
		$title = "特赋云打印";//邮件主题
		$content = FileUtil::getInstance()->getFileContent(strtr(dirname(__FILE__),"\\","/")."/template/mail_mask.php");//邮件内容
		$content=str_ireplace("#title#",$title,$content);
		$content=str_ireplace("#mask#",$mask,$content);
		$content=str_ireplace("#date#",date("Y-m-d H:i:s"),$content);
		$subject=$title."校验码";
		$contentType = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		
		$smtpinfo = array();
		$smtpinfo["host"] = ParaUtil::getInstance()->getContent("MAILSERVER_HOST");//SMTP服务器
		$smtpinfo["port"] = ParaUtil::getInstance()->getContent("MAILSERVER_PORT"); //SMTP服务器端口
		$smtpinfo["username"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER"); //发件人邮箱
		$smtpinfo["password"] = ParaUtil::getInstance()->getContent("MAILSERVER_SENDER_PWD");//发件人邮箱密码
		$smtp = new smtp($smtpinfo["host"],$smtpinfo["port"],true,$smtpinfo["username"],$smtpinfo["password"]);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = FALSE;//是否显示发送的调试信息
		$isok=$smtp->sendmail($email, $smtpinfo["username"], $subject, $content, $contentType);
		return $isok;
	}
	
	
}
?>	