<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/CodeUtil.class.php");
include_once(dirname(__FILE__)."/../../../com/base/InterfaceUtil.class.php");
include_once(dirname(__FILE__)."/../../../authen/include/page/session_manage.php");
?>
<?php 

$uri="building_storages";
$data=InterfaceUtil::getInstance()->getList($manageuseraccount, $manageuserpwd,$manageapptype, $uri);


$jsonObj=json_decode($data);

$list=array();
if($jsonObj->success){
	$list=$jsonObj->data;
}else{
	echo $jsonObj->message;
}

$dataResult = array();      //todo:导出数据（自行设置）
$ids=Fun::request("ids");
$idsarray = explode(',',$ids);
$num = count($idsarray);
foreach ($list as $obj){
	for($index=0;$index<$num;$index++){
  			if($obj->id==$idsarray[$index]){
	$objx=array();
	$objx["buildingName"]=$obj->buildingName;
	$objx["name"]=$obj->name;
	$objx["number"]=$obj->number;
	$objx["nature"]=$obj->nature;
	$objx["shape"]=$obj->shape;
	$objx["cubage"]=$obj->cubage;
	$objx["mainMaterial"]=$obj->mainMaterial;
	$objx["mainMaterial"]=$obj->mainMaterial;
	$objx["mainProduct"]=$obj->mainProduct;
	$dataResult[]=$objx;
			}
		}
}
$headTitle = "单位信息";
$title = "储存物管理".date("Ymd");
$headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>";
$titlename = "<tr>
		<th>建筑名称</th>
		<th>储存物名称</th>
		<th>储存物数量</th>
		<th>储存物性质</th>
		<th>储存物形态</th>
		<th>储存容积</th>
		<th>主要原料</th>
		<th>主要产品</th>
           </tr>";
$filename = $title.".xls";
$filename=iconv("utf-8","gb2312", $filename);
excelData($dataResult,$titlename,$headtitle,$filename);

?>

<?php 
/*
 *处理Excel导出
 *@param $datas array 设置表格数据
 *@param $titlename string 设置head
 *@param $title string 设置表头
 */
function excelData($datas,$titlename,$title,$filename){
	$str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">";
	$str .="\r\n<head>";
	$str .="\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">";
	$str .="\r\n</head>";
	$str .="\r\n<body>";
	$str .="<table border=1>";
	$str .=$titlename;
	//$str .= $title;
	foreach ($datas  as $key=> $rt ){
		$str .= "<tr>";
		foreach ( $rt as $k => $v ){
			$str .= "<td>{$v}</td>";
		}
		$str .= "</tr>\n";
	}
    $str .= "</table>";
    $str .= "</body></html>";
    header( "Content-Type: application/vnd.ms-excel; name='excel'" );
    header( "Content-type: application/octet-stream" );
    header( "Content-Disposition: attachment; filename=".$filename );
    header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
    header( "Pragma: no-cache" );
    header( "Expires: 0" );
    exit( $str );
}

?>