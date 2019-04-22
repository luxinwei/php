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
/*
 * $getprams_str="";
 * foreach ($_REQUEST as $key => $value){
 * if(array_key_exists($key,$_POST)){
 * $postParams[$key]=$value;
 * }else{
 * $getprams_str.="&".$key."=".$value;
 * }
 * }
 */
$uri = $_POST ["uri"];
$commitData = $_POST ["commitData"];
$randVal = Fun::getUUID ();
$pwdHash = base64_encode ( sha1 ( $pwd . $randVal ) );
$ursl = $rooturl . "/" . $uri;
$postParams ["loginName"] = $loginName;
$postParams ["appCode"] = $appCode;
$postParams ["randVal"] = $randVal;
$postParams ["pwdHash"] = $pwdHash;
$postParams ["commitData"] = $commitData;

/*
 * if(substr_count($ursl,"?")==0){
 * $ursl.="?";
 * }else{
 * $ursl.="&";
 * }
 *
 * $ursl.="loginName=".$loginName;
 * $ursl.="&appCode=".$appCode;
 * $ursl.="&randVal=".$randVal;
 * $ursl.="&pwdHash=".$pwdHash;
 * $ursl.=$getprams_str;
 *
 */
$data = Fun::http_request ( $ursl, $postParams );
echo $data;