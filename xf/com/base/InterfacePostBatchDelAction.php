<?php
error_reporting ( 0 );
include_once (dirname ( __FILE__ ) . "/../../com/base/util/DB.class.php");
include_once (dirname ( __FILE__ ) . "/../../com/base/util/Fun.class.php");
include_once (dirname ( __FILE__ ) . "/../../com/base/util/ParaUtil.class.php");
include_once (dirname ( __FILE__ ) . "/../../authen/include/page/session_manage_info.php");
?>
<?php
// $loginName="13938503678";
// $pwd="123456";
// $rooturl="http://39.107.33.59:8080";
$loginName = $manageuseraccount;
$pwd = $manageuserpwd;
$appCode = $manageapptype;
$rooturl = ParaUtil::getInstance ()->getContent ( "XFURL" );
header ( "Content-type: text/html; charset=utf-8" );

$postParams = array ();
$uri = $_POST ["uri"];
$commitData = $_POST ["commitData"];
$randVal = Fun::getUUID ();
$pwdHash = base64_encode ( sha1 ( $pwd . $randVal ) );
$ursl = $rooturl . "/" . $uri;
$postParams ["loginName"] = $loginName;
$postParams ["appCode"] = $appCode;
$postParams ["randVal"] = $randVal;
$postParams ["pwdHash"] = $pwdHash;

$paramobj=array();

$paramobj["batchMethod"]= "batchDelete";
$paramobj=json_encode($paramobj);

$postParams["params"] =$paramobj;
$postParams["commitData"] ="[".$commitData."]";
 
$data = Fun::http_request ( $ursl, $postParams );
 
echo $data;