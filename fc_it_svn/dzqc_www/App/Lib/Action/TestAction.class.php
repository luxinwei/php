<?php
class TestAction extends QAction{
	public function index(){
		
		$this->display();
	}
	public function getProvinces(){
		//获取省级地区
		$pid = I('pid');
		$depth = I('depth');
		$where = " pid={$pid} and depth={$depth} ";
        $province=D('DicArea')->where($where)->select();
        echo json_encode($province);
	}
	public function getAll(){
		var_dump($_POST);
	}
}