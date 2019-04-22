<?php
class RecruitListAction extends QAction{
	function __construct() {
		parent::__construct ( "Recruit" );
	}
	//招聘列表
	function listRecruit(){
		$remuneration = I('remuneration');
		$industry_id = I('industry_id');
		$state = I('state');
		$search_key = I('search_key');
		
		$industryModel = D('DicIndustry');
		$industry_list = $industryModel->q_gets();
		//查询所有的招聘
		$recruitModel = D('Recruit');
		$recruit_list = $recruitModel->getMyRecommendList($remuneration,$industry_id,$state,$search_key);
		$this->q_pageList($recruit_list);
		
		$this->assign('industry_list', $industry_list);
		$this->assign('recruit_list', $recruit_list);
		$this->display('list_recruit');
	}
	//招聘详情
	function detailRecruit(){
		$id = I('id');
		$recruitModel = D('Recruit');
		$recruit_info = $recruitModel->getCurrentRecruit($id);
		$recruitModel->where("id={$id}")->setInc('hits',1);
		$this->assign('info', $recruit_info);
		$this->display('detail_recruit');
	}
	
}