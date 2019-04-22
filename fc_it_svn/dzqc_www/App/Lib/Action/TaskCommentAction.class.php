<?php

class TaskCommentAction extends QAction {
	function __construct() {
		parent::__construct ();
		$UserModel = D ( 'User' );
		$UserModel->isRealNameAudit ();
	}
	
	public function getListByTask() {
		$TaskCommentModel = D ( "TaskComment" );
		$task = I ( 'taskid' );
		if (empty ( $task )) {
			return $this->q_error ( "参数有误!" );
		}
		$list = $TaskCommentModel->getListByTask ( $task );
		$UserModel = D ( 'User' );
		foreach ( $list ['rows'] as &$row ) {
			$row ['user_data'] = $UserModel->q_get ( $row ['uid'], "", array ('username', 'id', 'student_and_photo', 'sex', 'realname' ) );
			$row ['user_data'] ['student_and_photo'] = C ( "QINIU_IMG_DOMAIN" ) . $row ['user_data'] ['student_and_photo'];
		
		}
		return $this->q_success ( array ('list' => $list ) );
	
	}
	
	function publisherCommentIndex() {
		$joinId = I ( 'joinid' );
		if (empty ( $joinId )) {
			return $this->q_error ( "参数有误!" );
		}
		$taskJoinModel = D ( "TaskJoin" );
		
		$join_data = $taskJoinModel->q_get ( $joinId );
		if (empty ( $join_data )) {
			return $this->q_error ( "参数有误！" );
		}
		$join_data = $taskJoinModel->warpRow ( $join_data );
		
		$taskModel = D ( "Task" );
		$taskData = $taskModel->getMy ( $join_data ['taskid'] );
		if (empty ( $taskData )) {
			return $this->q_error ( "参数有误！" );
		}
		
		if ($join_data ['publisher_comment_state'] == 1) {
			return $this->q_error ( "不能重复评论！" );
		}
		$this->assign('join_data',$join_data);
		$this->assign('task_data',$taskData);
		return $this->display ( "task/publish_comment" );
	}
	
	public function publisherAddComment() {
		$TaskCommentModel = D ( "TaskComment" );
		$joinId = I ( 'joinid' );
		$data ['content'] = I ( 'content' );
		$data ['star'] = I ( 'star' );
		$data ['content']=trim($data ['content']);
		if(empty($data ['content'])){
		
			return $this->q_error("请输入评语");
		}
		$ret = $TaskCommentModel->publisherAddComment ( $joinId, $data );
		return $this->q_mret ( $ret, "发表评论成功" );
	}

}