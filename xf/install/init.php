<?php 

error_reporting(0);
header("Content-type: text/html; charset=utf-8");
include_once(dirname(__FILE__)."/../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../com/base/util/ParaUtil.class.php");
include_once(dirname(__FILE__)."/../com/base/util/FileUtil.class.php");

include_once(dirname(__FILE__)."/../com/core/csm/CsmMember.class.php");
$xingArray=array();
$mingArray=array();
$xingArray[]="张";
$xingArray[]="赵";
$xingArray[]="钱";
$xingArray[]="孙";
$xingArray[]="李";
$xingArray[]="周";
$xingArray[]="吴";
$xingArray[]="郑";
$xingArray[]="李";



$mingArray[]="庞";
$mingArray[]="庞";
$mingArray[]="宣";
$mingArray[]="亭";
$mingArray[]="杨";
$mingArray[]="本";
$mingArray[]="勐";
$mingArray[]="罗";
$mingArray[]="浩";
$mingArray[]="松";
$mingArray[]="刘";
$mingArray[]="彦";
$mingArray[]="鑫";
$mingArray[]="蒋";
$mingArray[]="圣";
$mingArray[]="文";
$mingArray[]="张";
$mingArray[]="道";
$mingArray[]="源";
$mingArray[]="冯";
$mingArray[]="海";









$list_org=DB::getInstance()->execQuery("select * from fim_org");
$xxxxxxxx=0;
foreach ($list_org as $orgObj){
	$num=rand(15, 30);
	for ($i=0;$i<$num;$i++){
		$birthday_year=rand(1965, 2000);
		$birthday_month=rand(10, 12);
		$birthday_day=rand(10, 28);
		$birthday=$birthday_year."-".$birthday_month."-".$birthday_day;
		
		$mobile="";
		$username=$xingArray[rand(1, 8)].$mingArray[rand(1, 20)].$mingArray[rand(1, 20)];
		$sex=rand(0, 1);
		$cardid="411322".$birthday.rand(1000, 9999);
	
		$pwd="123456";
		$orgid=$orgObj["ID"];
		$usercode         = CsmMember::getInstance()->getNewCode();

		$colArr=array();
		$colArr["USERCODE"]         = $usercode;
		$colArr["USERACCOUNT"]      = "";
		$colArr["MOBILE"]           = $mobile;
		$colArr["EMAIL"]            = "";
		$colArr["NICKNAME"]         = $username;
		$colArr["USERNAME"]         = $username;
		$colArr["SEX"]              = $sex;
		$colArr["CARDID"]           = $cardid;
		$colArr["BIRTHDAY"]         = $birthday;
		$colArr["MOBILE_IS_VERTIFY"]= 0;
		$colArr["EMAIL_IS_VERTIFY"] = 0;
		$colArr["PWD"]              = md5($pwd);
		$colArr["REGTIME"]          = date("Y-m-d H:i:s");
		$colArr["USERTYPE"]         = 2;
		$colArr["USERLEVEL"]        = 1;
		$colArr["LOGINCOUNT"]       = 0;
		
		$colArr["ORGID"]            =$orgid;
		$colArr["NATION"]           ="汉族";
		$colArr["BIRTHDAY"]         =$birthday;
		$colArr["CARDID"]           =$cardid;
		$colArr["EDUCATION"]        =4;
		$colArr["WORKADDRESS"]      ="河南驻马店正阳";
		$colArr["WORKUNIT"]         =$orgObj["TITLE"];
		$colArr["WORKUNITJOB"]      ="职员";
		$colArr["ORIGINADDRESS"]    ="河南驻马店正阳";
		$colArr["POLITICALSTATUS"]  ="1";
		$colArr["JOINPARTYTIME"]     =rand(1980, 2017)."-".rand(10, 12)."-".rand(10, 28);
		$colArr["LIVEADDRESS"]       ="河南驻马店正阳";
		$colArr["PERMANENTADDRESS"]  ="河南驻马店正阳";
		$colArr["AUDITSTATE"]         =0;
		
		$xxxxxxxx++;
		//$isok=DB::getInstance()->saveByArray("csm_member", $colArr);
		//if($isok)echo "<br/>".$xxxxxxxx;
		
		
		
	}
}





?>
dddddddddddddddddddddddddddd