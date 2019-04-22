<?php 
include dirname(__FILE__)."/../com/base/util/Fun.class.php";
include dirname(__FILE__)."/../com/base/util/ParaUtil.class.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
</head>
<body>
<script>
var fileServerUrl="<?php echo(ParaUtil::getInstance()->getFileServerUrl());?>";
var rootPath="<?php echo ParaUtil::getInstance()->getRoot();?>";

</script>

<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/css/base.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/common/function.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/jquery.SuperSlide.2.1.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/common/jquery.mypagination.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/formvalidation/js/formvalidation.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/jquery.validator.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/validator/local/zh_CN.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/lay/dest/layui.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/layui/css/layui.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/getmembers.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo ParaUtil::getInstance()->getRoot()?>/manage/etc/css/main.css" />


<?php


Test::getInstance()->login();
Test::getInstance()->jiankongadd();
//Test::getInstance()->logout();
class Test{
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
function login(){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/users/login";
	//$ursl.="?loginName=".$loginName;
	//$ursl.="&appCode=app";
	//$ursl.="&randVal=".$randVal;
	//$ursl.="&pwdHash=".$pwdHash;
	$params=array();
	$params["loginName"]=$loginName;
	$params["appCode"]="ownerDepartment";
	$params["randVal"]=$randVal;
	$params["pwdHash"]=$pwdHash;
	$res=self::http_request($ursl,$params);
	
	var_dump($res);
	//return $ursl;
}
function logout(){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/users/logout";
	//$ursl.="?loginName=".$loginName;
	//$ursl.="&appCode=app";
	//$ursl.="&randVal=".$randVal;
	//$ursl.="&pwdHash=".$pwdHash;
	$params=array();
	$params["loginName"]=$loginName;
	$params["appCode"]="ownerDepartment";
	$params["randVal"]=$randVal;
	$params["pwdHash"]=$pwdHash;
	$res=self::http_request($ursl,$params);
	var_dump("xxxx");
	var_dump($res);
}
//监控中心列表
function jiankonglist(){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers";
	$ursl.="?loginName=".$loginName;
	$ursl.="&appCode=ownerDepartment";
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
	return $ursl;
}
//监控中心列表详情
function jiankongdetail(){
	$loginName="13938503678";
	$pwd="123456";
	$id='8';
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers/".$id;
	$ursl.="?loginName=".$loginName;
	$ursl.="&appCode=ownerDepartment";
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
	return $ursl;
}
//监控中心列表新增
function jiankongadd(){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
/* 	$commitDat=array();
	$commitDat["address"]="郑州";
	$commitDat["area_id"]="1";
	$commitDat["charge_person"]="user1";
	$commitDat["charge_phone"]="15987485842";
	$commitDat["monitor_center_rank_code"]="2";
	$commitDat["name"]="Aaaaa监控中心";
	$commitDat["position"]="113.574443,34.813479";
	$commitDat["telephone"]="15987485842"; */
	$commitDat="{";
	$commitDat.="'address':'郑',";
	$commitDat.="'area_id':'1',";
	$commitDat.="'charge_person':'user1',";
	$commitDat.="'charge_phone':'15987485842',";
	$commitDat.="'monitor_center_rank_code':'2',";
	$commitDat.="'name':'AB监控中心',";
	$commitDat.="'position':'113.574443,34.813479',";
	$commitDat.="'telephone':'15987485842'";
	$commitDat.="}";
	$params=array();
	$params["loginName"]=$loginName;
	$params["appCode"]="ownerDepartment";
	$params["randVal"]=$randVal;
	$params["pwdHash"]=$pwdHash;
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers?commitDat=".$commitDat;
	var_dump($ursl);
	$res=self::http_request($ursl,$params);
	var_dump($res);
}
//监控中心列表修改
function jiankongupdate(){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));

	$ursl="http://39.107.33.59:8080/dpi/monitor_centers?commitDat=".$commitDat;
	$params=array();
	$params["loginName"]=$loginName;
	$params["appCode"]="ownerDepartment";
	$params["randVal"]=$randVal;
	$params["pwdHash"]=$pwdHash;
	$res=self::http_request($ursl,$params);
	var_dump($res);
}
function jiankongdel($id){
	$loginName="13938503678";
	$pwd="123456";
	$randVal=Fun::getUUID();
	$pwdHash=base64_encode(sha1($pwd.$randVal));
	$ursl="http://39.107.33.59:8080/dpi/monitor_centers/".$id;
	$ursl.="?loginName=".$loginName;
	$ursl.="&appCode=ownerDepartment";
	$ursl.="&randVal=".$randVal;
	$ursl.="&pwdHash=".$pwdHash;
	return $ursl;
 
}
//HTTP请求（支持HTTP/HTTPS，支持GET/POST）
	 function http_request($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
		var_dump($curl);
		$output = curl_exec($curl);
		
		curl_close($curl);
		return $output;
	}
 
 


}





?>
<a  id="btn_login">登录</a>
<br/>
<a target="_blank"  id="btn_logout">退出</a>
<a target="_blank" href="<?php echo Test::getInstance()->jiankongdel(5)?>">当时的时代删除</a>
<br/>
<a target="_blank" href="<?php echo Test::getInstance()->jiankonglist()?>">监控中心列表</a>
<br/>
<a target="_blank" href="<?php echo Test::getInstance()->jiankongdetail()?>">详情</a>
<br/>


 
</body>
</html>
<script>

$("#btn_login").bind("click", function(){
	var params=null;
	var url=<?php echo loginurl()?>;
	alert(url);
	$.post(url,params,function(responseText){
		alert(responseText);
    
    })	
});


</script>