<?php
class ResumeAction extends QAction {
	function __construct() {
		parent::__construct ( "Resume" );
	}
	
	function detail() {
		$uid = I ( 'uid' );
		
		if (empty ( $uid )) {
			return $this->error ( "参数有误!" );
		}
		$resumeData=$this->q_model->getByUser($uid);
		$this->assign('resumeData',$resumeData);
		//var_dump($resumeData);
		return $this->display ( "resume_detail" );
	
	}

}