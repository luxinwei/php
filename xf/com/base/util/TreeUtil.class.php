<?php
class TreeUtil{
	public  $root;//TreeInfo对象
	public  $listAll;//TreeInfo对象数组
	function __construct($root,$listAll) {
		$this->root = $root;
		$this->listAll = $listAll;
	}
	//子编码列表
	function getSubCodeList($code){
		$codeList="'".$code."'";
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			$codeList.=",'".$tree["code"]."'";
			if(self::isExitSub($tree)){
				$codeList.=",".self::getSubCodeList($tree["code"]);
			}else{
				continue;
			}
		}
	
		return $codeList;
	
	}
	//所有子编码列表
	function getSubCodeListAll($code){
		$codeList="'".$code."'";
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			if(self::isExitSub($tree)){
				$codeList.=",".self::getSubCodeListAll($tree["code"]);
			}else{
				$codeList.=",'".$tree["code"]."'";
				continue;
			}
		}
	  
		return $codeList;
	
	}
	//所有子编码列表包含单引号
	function getSubCodeListAllIncludeSymbol($code){
		$codeList="'".$code."'";
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			if(self::isExitSub($tree)){
				$codeList.=",".self::getSubCodeListAllIncludeSymbol($tree["code"]);
			}else{
				$codeList.=",'".$tree["code"]."'";
				continue;
			}
		}

		return $codeList;
	
	}
	//所有子编码列表不包含单引号
	function getSubCodeListAllNoIncludeSymbol($code){
		$codeList=$code;
	
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			if(self::isExitSub($tree)){
				$codeList.=",".self::getSubCodeListAllNoIncludeSymbol($tree["code"]);
			}else{
				$codeList.=",".$tree["code"];
				continue;
			}
		}
	
		return $codeList;
	
	}
	
	//得到下拉列表不包含根<option></option>
	function findSelectOptionNoRootStr($value) {
		$optionStr = "";
		$optionStr.=self::findNextOptionStr($this->root["code"],$value,0);
		return $optionStr;
	}
	//得到下拉列表包含根<option></option>
	function findSelectOptionStr($value) {
		$optionStr = "";
		$optionStr.="\n<option value=\"".$this->root["code"]."\" parentvalue=\"".$this->root["parentCode"]."\">".$this->root["title"]."</option>";
		$optionStr.=self::findNextOptionStr($this->root["code"],$value,0);
		return $optionStr;
	}
	
	function findNextOptionStr($code,$value, $isIncludeRoot) {
		$optionStr = "";
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			$selectedValue="";
			if($tree["code"]==$value)$selectedValue="selected";
			$level_str="";
			$k=1;
			if($isIncludeRoot==1)$k=0;
			$level=self::treeLevel($tree);
			for(;$k<$level;$k++)$level_str.="|___";
			$optionStr.="\n<option value=\"".$tree["code"]."\" parentvalue=\"".$tree["parentCode"]."\" ".$selectedValue.">".$level_str.$tree["title"]."</option>";
			$optionStr.=self::findNextOptionStr($tree["code"],$value, $isIncludeRoot);
		}
		return $optionStr;
	}
	
	//得到下拉列表不包含根<option></option>只能选择叶子节点
	function findSelectOptionLastNodeNoRootStr($value) {
		$optionStr = "";
		$optionStr.=self::findNextOptionLastNodeStr($this->root["code"],$value,0);
		return $optionStr;
	}
	function findNextOptionLastNodeStr($code,$value, $isIncludeRoot) {
		$optionStr = "";
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			$selectedValue="";
			if($tree["code"]==$value)$selectedValue="selected";
			$level_str="";
			$k=1;
			if($isIncludeRoot==1)$k=0;
			for(;$k<self::treeLevel($tree);$k++)$level_str.="|___";
			if(self::isExitSub($tree)){
				$optionStr.="\n<optgroup label=\"".$level_str.$tree["title"]."\">".$level_str.$tree["title"]."</optgroup>";
			}else{
				$optionStr.="\n<option value=\"".$tree["title"]."\" parentvalue=\"".$tree["title"]."\" ".$selectedValue.">".$level_str.$tree["title"]."</option>";
			}
			  $optionStr.=self::findNextOptionLastNodeStr($tree["code"],$value, $isIncludeRoot);
		}
		return $optionStr;
	}
	//得到下拉列表select></select>过滤当前分类以及子分类下拉控件选项
	function findSelectOptionStrFilterCurrentCode($currentCode,$value) {
		$optionStr = "";
		$optionStr.="\n<option value=\"".$this->root["code"]."\" parentvalue=\"".$this->root["parentCode"]."\">".$this->root["title"]."</option>";
		$optionStr.=self::findNextOptionStrFilterCurrentCode($currentCode,$this->root["code"],$value);
		return $optionStr;
	}
	function findNextOptionStrFilterCurrentCode($currentCode,$code,$value) {
		$currentSubCodeListAll=self::getSubCodeListAllNoIncludeSymbol($currentCode);
		$currentSubCodeArray=explode(',',$currentSubCodeListAll);
		$listNext=self::findNext($code);
		foreach ($listNext as $tree){
			$selectedValue="";
			if($tree["code"]==$value)$selectedValue="selected";
			$level_str="";
			$level=self::treeLevel($tree);
			for($k=0;$k<$level;$k++)$level_str.="|___";
			$isExitCurrentSubCode=in_array(trim($tree["code"]),$currentSubCodeArray);
			if(!$isExitCurrentSubCode){
				$optionStr.="\n<option value=\"".$tree["code"]."\" parentvalue=\"".$tree["parentCode"]."\" ".$selectedValue.">".$level_str.$tree["title"]."</option>";
			}
			$optionStr.=self::findNextOptionStrFilterCurrentCode($currentCode,$tree["code"],$value);
		}
		
		return $optionStr;
	}
	//-------------------------------------------------------------------------
	//得到级别
	function treeLevel($currentTree){
		$level=1;
		foreach ($this->listAll as $tree){
			if($currentTree["parentCode"]==$tree["code"]){
				if(self::isExitPartent($tree)){
					$level+=self::treeLevel($tree);
				}else{
					break;
				}
			}
		}
	
		return $level;
	
	}
	//是否存在父对象
	function isExitPartent($currentTree){
		$isExit=false;
		foreach ($this->listAll as $tree){
			if($currentTree["parentCode"]==$tree["code"]){
				$isExit=true;
				break;
			}
		}
		return $isExit;
	}
	//是否存在子对象
	function isExitSub($currentTree){
		$isExit=false;
		foreach ($this->listAll as $tree){
			if(trim($currentTree["code"])==trim($tree["parentCode"])){
				$isExit=true;
				break;
			}
		}
		return $isExit;
	}
	//-------------------------------------------------------------------------
	function getInitlistAll(){
		$list=Array();
		$this->root["position"]="001";
		$list[]=$this->root;
		$listNext=self::getSublistAll($this->root);
		foreach ($listNext as $tree){
			$list[]=$tree;
		}
		
		return $list;
	}
	function getInitlistAllJsArray(){
		$list=Array();
		$this->root->$position="001";
		$list[]=$this->root;
		$jsArray_mid="";
		$listNext=self::getSublistAll($this->root);
		foreach ($listNext as $tree){
			if($jsArray_mid!="")$jsArray_mid.=",";
			$itemno=trim($tree["code"]);
			$itemname=trim($tree["title"]);
			$position=trim($tree["position"]);
			$levelstr="";
			$level=strlen($position)/3;
			for($i=1;$i<level;$i++)$levelstr.="|____";
				
			$jsArray_mid.="['".itemno."','".levelstr.itemname."']";
		}
		    $jsArray="[".jsArray_mid."]";
		return $jsArray;
	}
	
	
	function getSublistAll($currentTree) {
		$list=Array();
		$listNext=self::initNextPosition($currentTree);
		foreach ($listNext as $tree){
			$list[]=$tree;
			foreach (self::getSublistAll($tree) as $tree1){
				$list[]=$tree1;
			}
		}
		return $list;
	}
	//得到下一级列表
	function initNextPosition($currentTree){
		$list=Array();
		$currentPosition=$currentTree["position"];
		$listNext=self::findNext($currentTree["code"]);
		$i=1;
		foreach ($listNext as $tree){
			$maxIncCode="";
			if(strlen($i)==1){
				$maxIncCode=$currentPosition."00".$i;
			}else if(strlen($i)==2){
				$maxIncCode=$currentPosition."0".$i;
			}else{
				$maxIncCode=$currentPosition.$i;
			}
			$tree["position"]=$maxIncCode;
			$list[]=$tree;
			$i++;
		}
		return $list;
	}
	//-------------------------------------------------------------------------
	//得到一个对象
	function getOneTree($code){
		$treeInfo=array();
		foreach ($this->listAll as $tree){
			if($code==$tree["code"]){
				$treeInfo=$tree;
				break;
			}
		}
		return $treeInfo;
	}
	//得到下一级列表
	function findNext($code){
		$listNext=Array();
		foreach ($this->listAll as $tree){
		  if(trim($code)==trim($tree["parentCode"])){
				$listNext[]=$tree;
			}
		}
		return $listNext;
	}
}
?>