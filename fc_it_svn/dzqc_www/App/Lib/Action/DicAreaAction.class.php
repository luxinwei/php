<?php 
class DicAreaAction extends QAction{
	
	function __construct() {
		parent::__construct("DicArea");
	}
	public function henanCity(){
		$list=$this->q_model->getListByPid(41);
		return $this->q_success(array("list"=>$list));
	}
}
?>