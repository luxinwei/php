<?php
class RegionAction extends QAction{
	public function getArea(){
		//获取省级地区
		$pid = I('pid');
		$depth = I('depth');
        $province=D('DicArea')->getListByCondition($pid,$depth);
        echo json_encode($province);
	}
	
	
}