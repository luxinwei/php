<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends QAction {
	
    public function index(){
    	//最新职位
    	$recruitModel = D('Recruit');
    	$new_recruit = $recruitModel->getRecruit('time DESC');
    	//最热职位
    	$hot_recruit = $recruitModel->getRecruit('hits DESC');
    	//var_dump($hot_recruit);
    	$this->assign('new_recruit',$new_recruit);
    	$this->assign('hot_recruit',$hot_recruit);
		$this->display();
    }
    
}