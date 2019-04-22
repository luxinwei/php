<?php
class DicIndustryAction extends QAction{
	function __construct() {
		parent::__construct("DicIndustry");
	}
	
	public function getListByIndustry(){
		$list = $this->q_model->q_getList();
		return $this->q_success(array("list"=>$list));
	}
}