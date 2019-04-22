<?php

class TaskCommentModel extends QModel {
	function getMyByTask($task) {
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$where = "taskid={$task} and uid={$myUser[id]}";
		
		return $this->q_get ( "", $where );
	}
	function getListByTask($task) {
		$where = "taskid={$task} ";
		
		return $this->q_getList ( $where, 'id desc' );
	}
	function getMy($id) {
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$where = "id={$id} and uid={$myUser[id]}";
		
		return $this->q_get ( "", $where );
	}
	
	function publisherAddComment($joinId, $data) {
		$taskModel = D ( 'Task' );
		$taskJoinModel = D ( "TaskJoin" );
		
		$join_data = $taskJoinModel->q_get ( $joinId );
		if (empty ( $join_data )) {
			return $this->q_error ( "参数有误！" );
		}
		$taskModel = D ( "Task" );
		$taskData = $taskModel->getMy ( $join_data ['taskid'] );
		if (empty ( $taskData )) {
			return $this->q_error ( "参数有误！" );
		}
		
		if ($join_data ['publisher_comment_state'] == 1) {
			return $this->q_error ( "不能重复评论！" );
		}
		
		if ($join_data ['state'] != 70) {
			return $this->q_error ( "当前任务不允许评论" );
		}
		
		
		
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$data ['addtime'] = time ();
		$data ['uid'] = $myUser [id];
		$data ['taskid'] = $taskData['id'];
		$data ['type'] = 2;
		$data ['joinid'] =$join_data[id];
		$this->q_add ( $data );
		
		$taskJoinModel->q_edit(array('publisher_comment_state'=>1),$joinId);
		
		return $this->q_success ( '发表评论成功' );
	}
	function joinerAddComment($task, $data) {
		$taskModel = D ( 'Task' );
		$taskData = $taskModel->q_get ( $task );
		if (empty ( $taskData )) {
			return $this->q_error ( "任务不存在" );
		}
		$TaskJoinModel = D ( 'TaskJoin' );
		$joinData = $TaskJoinModel->getMyJoinByTask ( $task );
		if (empty ( $joinData )) {
			return $this->q_error ( "您没有权限评论" );
		}
		if ($joinData ['state'] != 70) {
			return $this->q_error ( "当前任务不允许评论" );
		}
		
		if ($taskData ['state'] != 30) {
			return $this->q_error ( "当前任务不允许评论" );
		}
		
		$temp = $this->getMyByTask ( $task );
		if (! empty ( $temp )) {
			return $this->q_error ( "不能重复评论" );
		}
		
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$data ['addtime'] = time ();
		$data ['uid'] = $myUser [id];
		$data ['taskid'] = $task;
		$data ['type'] = 1;
		$data ['joinid'] =$joinData[id];
		$this->add ( $data );
		
		return $this->q_success ( '发表评论成功' );
	}
}