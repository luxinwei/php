<?php

class TaskJoinAction extends QAction {
	
	function __construct() {
		parent::__construct();		
		$UserModel = D ( 'User' );
		$UserModel->isRealNameAudit ();
	}
	
	public function _empty($name) {
		$taskJoinModel = D ( "TaskJoin" );
		
		$actionName = ACTION_NAME;
		$id = I ( "taskid" );
		if (empty ( $id )) {
			$id = I ( "joinid" );
		}
		if (empty ( $id )) {
			
			return $this->q_error ( "参数有误" );
		}
		$ret = $taskJoinModel->$actionName ( $id );
		
		return $this->q_mret ( $ret );
	}
	
	function getListByTask() {
		$id = I ( 'tid' );
		if (empty ( $id )) {
			return $this->error ( "参数有误!" );
		}
		$TaskModel = D ( "Task" );
		$taskData = $TaskModel->q_get ( $id );
		if (empty ( $taskData )) {
			return $this->error ( "任务不存在" );
		}
		$taskJoinModel = D ( "TaskJoin" );
		$list = $taskJoinModel->getListByTask ( $id );
		$UserModel = D ( 'User' );
		foreach ( $list ['rows'] as &$row ) {
			$row=$taskJoinModel->warpRow($row);
		}
		
		return $this->q_success ( array ('list' => $list ) );
	}

}