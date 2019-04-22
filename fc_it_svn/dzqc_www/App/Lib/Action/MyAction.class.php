<?php
class MyAction extends QAction{
	function __construct() {
		parent::__construct ( "Company" );
		
	}
	public function index(){
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
		$info = $companyModel->regetLoginUser();
		$industryModel =  D('DicIndustry');
		$industry = $industryModel->q_get($info['industry'],'',array('name'));
		$info['industry'] = $industry['name'];
		$this->assign('info', $info);
		$this->display('my_index');
	}
}