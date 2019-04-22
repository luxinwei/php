<?php
error_reporting(0);
include_once(dirname(__FILE__)."/../../../com/base/util/DB.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/Fun.class.php");
include_once(dirname(__FILE__)."/../../../com/base/util/phpexcel/PHPExcel.php");
include_once(dirname(__FILE__)."/../../../com/base/util/phpexcel/PHPExcel/IOFactory.php");
include_once(dirname(__FILE__)."/../../../manage/include/page/session_manage.php");
?>
<?php
header("Content-type: text/html; charset=utf-8");
$action=$_GET["action"];
if($action=="savexls"){
	$xlspath=Fun::request("xlspath");


	$curtime=date("Y-m-d H:i:s");
	$xlspath=ParaUtil::getInstance()->getFileUploadFolder()."/".$xlspath;

	$resultArray=processXls($xlspath);
	
	$success=$resultArray["SUCCESS"];
	if($success=="1"){
		$json="{success:1,msg:'成功'}";
		processComkind();
		echo $json;
		exit();
	}else{
		$json="{success:0,msg:'".$resultArray["MSG"]."'}";
		
		echo $json;
		exit();
	}
}

//===============================================================================================================
function processXls($filename){
	$resultArray[]=array();
	$resultArray=array("SUCCESS"=> "0","MSG"=> "失败!");
	
	if(!file_exists($filename)){
		$resultArray=array("SUCCESS"=> "0","MSG"=> "对不起，文件不存在!");
		return $resultArray;
	}
	


	$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
	$objPHPExcel = $objReader->load($filename);
	$currentSheet = $objPHPExcel->getSheet(0);
	$allColumn = $currentSheet->getHighestColumn();/**取得一共有多少列*/
	$allRow = $currentSheet->getHighestRow();/**取得一共有多少行*/

	
	$onlyvalueArray=array();
	$dataArray=array();
	$all = array();
	for( $i = 1 ; $i <= $allRow ; $i++){
		//企业名称	企业法人	所属行业	经营范围	经营地址	公司电话
		$comkindtitle               = $currentSheet->getCell("A$i")->getValue();//所属行业
		$company_title              = $currentSheet->getCell("B$i")->getValue();//企业名称
		$company_code               = $currentSheet->getCell("C$i")->getValue();//注册号
		
		$company_workaddress        = $currentSheet->getCell("D$i")->getValue();//经营地址
		$company_linktel            = $currentSheet->getCell("E$i")->getValue();//公司电话
		$company_faren              = "";//企业法人
		$company_farearea           = "";//经营范围
		$onlyvalue              = $company_title;
		$onlyvalueArray[]=$onlyvalue;
		$rowArray  = array();
		$rowArray["COMKINDTITLE"]          = $comkindtitle;
		$rowArray["COMPANY_TITLE"]         = $company_title;
		$rowArray["COMPANY_CODE"]          = $company_code;
		$rowArray["COMPANY_FAREN"]         = $company_faren;
		$rowArray["COMPANY_FAREAREA"]      = $company_farearea;
		$rowArray["COMPANY_WORKADDRESS"]   = $company_workaddress;
		$rowArray["COMPANY_LINKTEL"]       =$company_linktel;
		$dataArray[]=$rowArray;
	}
	//========
	if(count($dataArray)==0){
		$resultArray=array("SUCCESS"=> "0","MSG"=> "对不起，导入模板不正确!");
		return $resultArray;

	}
	if(count($dataArray)==1){
		$resultArray=array("SUCCESS"=> "0","MSG"=> "对不起，没有要导入的数据!");
		return $resultArray;

	}
	if (count($onlyvalueArray) != count(array_unique($onlyvalueArray))) {
		$resultArray=array("SUCCESS"=> "0","MSG"=> "存在企业名称重复的值,请检查!");
		return $resultArray;
	}
	
//=================================================================================================
	$onlyvalue_db_array=array();
	$list_members=DB::getInstance()->execQuery("select * from gsms_com_unit");
	foreach ($list_members as $obj){
		$onlyvalue_db_array[]=$obj["COMPANY_TITLE"];
	}

  
    $inccomid=ComIncMaxID();
    $curtime=date("Y-m-d H:i:s");
	$sql_array=array();
	for ($i=1;$i<count($dataArray);$i++){
		$company_title              = $dataArray[$i]["COMPANY_TITLE"];//企业名称
		$company_code               = $dataArray[$i]["COMPANY_CODE"];//注册号
		$company_faren              = $dataArray[$i]["COMPANY_FAREN"];//企业法人
		$comkindtitle               = $dataArray[$i]["COMKINDTITLE"];//所属行业
		$company_farearea           = $dataArray[$i]["COMPANY_FAREAREA"];//经营范围
		$company_workaddress        = $dataArray[$i]["COMPANY_WORKADDRESS"];//经营地址
		$company_linktel            =$dataArray[$i]["COMPANY_LINKTEL"];//公司电话
		
		
		if($company_title==""){
			$resultArray=array("SUCCESS"=> "0","MSG"=> "第".($i+1)."行存在企业为空的值!");
			return $resultArray;
		}
		
		
		if(in_array($company_title, $onlyvalue_db_array)){
				$resultArray=array("SUCCESS"=> "0","MSG"=> "第".($i+1)."行企业在数据库中已经存在!");
				return $resultArray;
		}
		$comid = $inccomid+$i;
		$colArray=array();
		$colArray["COMID"]                 = $comid;
		$colArray["COMPANY_CODE"]         = $company_code;
		$colArray["COMPANY_TITLE"]         = $company_title;
		$colArray["COMPANY_FAREN"]         = $company_faren;
		$colArray["COMKINDTITLE"]          = $comkindtitle;
		$colArray["COMPANY_FAREAREA"]      = $company_farearea;
		$colArray["COMPANY_WORKADDRESS"]   = $company_workaddress;
		$colArray["COMPANY_LINKTEL"]       = $company_linktel;

		$sql_array[]=DB::getInstance()->getInsertSql("gsms_com_unit", $colArray);
	}

	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
	if($isok)$resultArray=array("SUCCESS"=> "1","MSG"=> "成功");
	return $resultArray;
}

function processComkind(){
	$curtime=date("Y-m-d H:i:s");
	$sql_array=array();
	$onlyvalue_db_array=array();
	$list_members=DB::getInstance()->execQuery("select * from gsms_com_kind");
	foreach ($list_members as $obj){
		$onlyvalue_db_array[]=$obj["COMKINDTITLE"];
	}
	$incmaxid=ComKindIncMaxID();
	$sql_select="select COMKINDTITLE from gsms_com_unit group by COMKINDTITLE";
	$list=DB::getInstance()->execQuery($sql_select);
	for ($i=0;$i<count($list);$i++){
	    $obj                 = $list[$i];
		$comkindtitle        = $obj["COMKINDTITLE"];
		if(in_array($comkindtitle, $onlyvalue_db_array)){
			continue;
		}
		$id = $incmaxid+$i;
		$colArray=array();
		$colArray["COMKINDID"]       = $id;
		$colArray["COMKINDTITLE"]    = $comkindtitle;
		$colArray["README"]          = "";
		$colArray["DESCRIPTION"]     = "";
		$sql_array[]=DB::getInstance()->getInsertSql("gsms_com_kind", $colArray);
	}
	$isok=DB::getInstance()->InsertOrUpdateArray($sql_array);
}

function ComIncMaxID(){
	$maxobj=DB::getInstance()->getOneObjBySql("select max(COMID) MAXID from gsms_com_unit");
	$maxid=Fun::getInt($maxobj["MAXID"], 0);
	$newmaxid=$maxid+1;
	return $newmaxid;
}

function ComKindIncMaxID(){
	$maxobj=DB::getInstance()->getOneObjBySql("select max(COMKINDID) MAXID from gsms_com_kind");
	$maxid=Fun::getInt($maxobj["MAXID"], 0);
	$newmaxid=$maxid+1;
	return $newmaxid;
}


?>