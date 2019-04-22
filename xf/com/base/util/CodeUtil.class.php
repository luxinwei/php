<?php
include_once (dirname(__FILE__)."/DB.class.php");
include_once (dirname(__FILE__)."/../common/BaseDataLib.class.php");
class CodeUtil {
	private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	/*
	 * array("1"=> "首页广告","3"=> "二级页面广告")
	 */
	public function getLibsTitle($itemno,$libsArray){
		foreach ($libsArray as $key => $value) {
			if(trim($key)==trim($itemno)){
				$title=$value;
				break;
			}
		}
		return $title;
	}
	public function getLibsSelectOption($itemno,$libsArray){
		foreach ($libsArray as $key => $value) {
			$selected="";
			if(strcmp($itemno,$key)==0)$selected="selected";
			$content.="\n<option ".$selected." value=\"".$key."\">".$value."</option>";
	
		}
		return $content;
	}
	public function getLibsRadioBox($name,$value,$libsArray){
		$content="";
		foreach ($libsArray as $itemno => $itemname) {
			$checkstr="";
			if($itemno==trim($value))$checkstr="checked=\"checked\"";
			$content.="<span class=\"crediobox_name\"><input name=\"".$name."\"  type=\"radio\" ".$checkstr."  value=\"".$itemno."\" />".trim($itemname)."</span>";
		}
		return $content;
	}
	public function getLibsCheckBox($name,$valueList,$libsArray){
		$content="";
		foreach ($libsArray as $itemno => $itemname) {
			$checkstr="";
			if(substr_count($valueList,$itemno)>0)$checkstr="checked=\"checked\"";
			$content.="<input name=\"".$name."\"  type=\"checkbox\" ".$checkstr."  value=\"".$itemno."\" \\/>".trim($itemname);
		}
		return $content;
	}

	//编码名称
	public function getTitle($codeno,$itemno){
		$codeArray=self::getCodeArray();
		$title=trim($codeArray[$codeno]["LIBS"][$itemno]);
		return $title;
	}
	public function isExitItemno($codeno,$itemno){
		$codeArray=self::getCodeArray();
		$isExit=false;
		$list=$codeArray[$codeno]["LIBS"];
		if (array_key_exists($itemno,$list))$isExit=true;
		return $isExit;
	}
	public function getSelectOptionCodeStr($codeno,$value){
		$codeArray=self::getCodeArray();
		$content="";
		$list=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=$mapkey;
			$itemname=$list[$itemno];
			$selected="";
			if(strcmp($itemno,$value)==0)$selected="selected";
			$content.="\n<option ".$selected." value=\"".$itemno."\">".$itemname."</option>";
			
		}
		return $content;
	}
	/**
	 * 获得下拉列表数据 （可以排除某个值）
	 * @param codeno 下拉数据类型值
	 * @param value  默认值
	 * @param value2 排除值
	 * @return
	 */
	public function getSelectOptionCodeStrFiter($codeno,$value,$filterValueList){
		$codeArray=self::getCodeArray();
		$content="";
		$list=$codeArray[$codeno]["LIBS"];
		$filterValueArray = explode ( ",", $filterValueList );
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=$mapkey;
			$itemname=$list[$itemno];
			$isExit=false;
			foreach($filterValueArray as $filterValue){
				if(strcmp($itemno,$filterValue)==0){
					$isExit=true;
					break;
				}
			}
			if($isExit)continue;
			$selected="";
			if(strcmp($itemno,$value)==0)$selected="selected";
			$content.="\n<option ".$selected." value=\"".$itemno."\">".$itemname."</option>";
				
		}
		return $content;
	}
	public function getCodeJsArray($codeno){
		$codeArray=self::getCodeArray();
		$jsArray_mid="";
		$jsArray_mid.="['','']";
		$list=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=$mapkey;
			$itemname=$list[$itemno];
			if(strcmp(jsArray_mid,"")!=0)$jsArray_mid.=",";
			$jsArray_mid.="['".$itemno."','".$itemname."']";
				
		}
		$jsArray="[".$jsArray_mid."]";
		return $jsArray;
	}
	/**
	 * 获得下拉列表数组 （可以排除某些个值）
	 * @param codeno
	 * @param filterValueList
	 * @return
	 */
	public function getCodeJsArrayFilter($codeno,$filterValueList){
		$codeArray=self::getCodeArray();
		$jsArray_mid="";
		$jsArray_mid.="['','']";
		$filterValueArray = explode ( ",", $filterValueList );
		$list=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=$mapkey;
			$itemname=$list[$itemno];
			$isExit=false;
			foreach($filterValueArray as $filterValue){
				if(strcmp($itemno,$filterValue)==0){
					$isExit=true;
					break;
				}
			}
			if($isExit)continue;
			if(strcmp(jsArray_mid,"")!=0)$jsArray_mid.=",";
			$jsArray_mid.="['".$itemno."','".$itemname."']";
		
		}
		$jsArray="[".$jsArray_mid."]";
		
		return $jsArray;
	}
	
	
	//字典表复选框
	public function getCodeCheckBox($codeno,$name,$valueList,$excludeList){
		$codeArray=self::getCodeArray();
		$content="";
		$list=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=$mapkey;
			$itemname=$list[$itemno];
			if(substr_count($excludeList,$itemno)>0)continue;
			$checkstr="";
			if(substr_count($valueList,$itemno)>0)$checkstr="checked=\"checked\"";
			$content.="<input name=\"".$name."\"  type=\"checkbox\" ".$checkstr."  value=\"".$itemno."\" \\/>".trim($itemname);	
		}
		return $content;
	}
	//字典表单选框
	public function getCodeRadioBox($codeno,$name,$value,$excludeList){
		$codeArray=self::getCodeArray();
		$content="";
		$list=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($list);
		foreach ($key_array as $mapkey){
			$itemno=trim($mapkey);
			$itemname=$list[$itemno];
			if(substr_count($excludeList,$itemno)>0)continue;
			$checkstr="";
			if($itemno==trim($value))$checkstr="checked=\"checked\"";
			$content.="<input name=\"".$name."\"  type=\"radio\" ".$checkstr."  value=\"".$itemno."\" />".trim($itemname);
		}
		return $content;
	}
 
	//-----------------------------------------------------------------------------------------
	public function getCodeLibraryList($codeno){
		$list=array();
		$codeArray=self::getCodeArray();
		$dataArray=$codeArray[$codeno]["LIBS"];
		$key_array=array_keys($dataArray);
		foreach ($key_array as $mapkey){
			$list[]=array("ITEMNO"=>$mapkey,"ITEMNAME"=>$dataArray[$mapkey]);
		}
		return $list;
	}
	private function getCodeArray(){
		return BaseDataLib::$baseDataFimcode;
	}
}
?>