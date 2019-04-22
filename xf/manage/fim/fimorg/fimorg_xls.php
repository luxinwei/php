<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/CodeUtil.class.php");
include_once dirname(__FILE__)."/../../../com/core/fim/FimOrg.class.php";
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php 
$list_export=array();
$root=FimOrg::getInstance()->getRoot();
$list_export[]=$root;
$list1 = DB::getInstance()->execQuery("select * from fim_org where parentid='".$root["ID"]."'");
foreach ($list1 as $obj1){
	$obj1["SPACE"]="|__";
	$list_export[]=$obj1;
	$list2 = DB::getInstance()->execQuery("select * from fim_org where parentid='".$obj1["ID"]."'");
	foreach ($list2 as $obj2){
		$obj2["SPACE"]="|__|__";
		$list_export[]=$obj2;
		$list3 = DB::getInstance()->execQuery("select * from fim_org where parentid='".$obj2["ID"]."'");
		foreach ($list3 as $obj3){
			$obj3["SPACE"]="|__|__|__";
			$list_export[]=$obj3;
			$list4 = DB::getInstance()->execQuery("select * from fim_org where parentid='".$obj3["ID"]."'");
			foreach ($list4 as $obj4){
				$obj4["SPACE"]="|__|__|__|__";
				$list_export[]=$obj4;
			}
		}
	}
}
$dataResult = array();      //todo:导出数据（自行设置）
$j=1;
foreach ($list_export as $obj){
	$objx=array();
	$objx["XH"]=$j;
	$objx["ID"]=$obj["ID"];
	$objx["TITLE"]=$obj["SPACE"].$obj["TITLE"];
	$objx["TYPE"]=CodeUtil::getInstance()->getTitle("FIM_ORGTYPE", $obj["TYPE"]);
	$objx["ORGKIND"]=CodeUtil::getInstance()->getTitle("FIM_ORGKIND", $obj["ORGKIND"]);
	$objx["INTERAL"]=$obj["INTERAL"];
	$objx["INTERALORDER"]=$obj["INTERALORDER"];
	$objx["MEMBERNUM"]=$obj["MEMBERNUM"];
	$dataResult[]=$objx;
	$j++;
}



$headTitle = "组织管理";
$title = "组织管理".date("Ymd");
$headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>";
$titlename = "<tr>
			   <th>序号</th>
               <th>组织编号</th>
			   <th>组织名称</th>
               <th>类型</th>
			   <th>种类</th>
			   <th>积分</th>
			   <th>排名</th>
			   <th>党员数量</th>
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