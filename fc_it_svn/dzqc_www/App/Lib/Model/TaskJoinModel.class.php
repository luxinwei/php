<?php

class TaskJoinModel extends QModel {
	//0:等待审核,10:已同意,20:已拒绝，30:准备开始,40：进行中，50:申请退出,60:已退出,70:已完成
	public static $JOIN_STATE = array ("0" => "等待审核", "10" => "已同意", "20" => "已拒绝", "30" => "准备开始", "40" => "进行中", "50" => "申请退出", "60" => "已退出", "70" => "已完成" );
	function applayJoin($taskid) {
		
		$taskModel = D ( 'Task' );
		$taskData = $taskModel->q_get ( $taskid );
		$join_count = $this->q_count("taskid={$taskid} and state in(0,10,30) ");  //得到报名人数（0、10、30）
		$xuqiu_count = $taskData['join_number'];  //得到参与人数
		$agree_count = $this->q_count("taskid={$taskid} and state=10 ");  //得到同意人数
		if (empty ( $taskData )) {
			
			return $this->q_error ( "任务不存在" );
		}
		if ($taskData ['state'] != 10) {
			return $this->q_error ( "此任务当前不允许报名" );
		}
		$myJoinData = $this->getMyJoinByTask ( $taskid );
		if (! empty ( $myJoinData )) {
			return $this->q_error ( "你已经报名，不能重复报名" );
		}
		if ($join_count>$xuqiu_count*3 || $agree_count>$xuqiu_count){
			return $this->q_error ( "报名人数已超员" );
		}
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$sql_data = array ();
		$sql_data ['taskid'] = $taskid;
		$sql_data ['addtime'] = time ();
		$sql_data ['uid'] = $myUser ['id'];
		$sql_data ['state'] = 0;
		$sql_data ['isdel'] = 0;
		$this->q_add ( $sql_data );
		return $this->q_success ( "报名成功!" );
	}
	
	function getMyJoinByTask($tid) {
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$where = "taskid={$tid} and uid={$myUser[id]}";
		
		return $this->q_get ( '', $where );
	}
	
	function getMy($id) {
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$where = "id={$id} and uid={$myUser[id]}";
		
		return $this->q_get ( '', $where );
	}
	
	function applayExitJoin($joinId) {
		$data = $this->getMy ( $joinId );
		if (empty ( $data )) {
			return $this->q_error ( "参数有误!" );
		}
		
		if ($data ['state'] != 0&&$data ['state'] != 10) {
			return $this->q_error ( "当前不允许操作!" );
		}
		
		$sql_data = array ("state" => 50 );
		$this->q_edit ( $sql_data, $joinId );
		return $this->q_success ( "申请成功，请等待发布者审核!" );
	}
	function waitStartTask($joinId) {
		$data = $this->getMy ( $joinId );
		if (empty ( $data )) {
			return $this->q_error ( "参数有误!" );
		}
		
		if ($data ['state'] != 10) {
			return $this->q_error ( "当前不允许此操作!" );
		}
		
		$sql_data = array ("state" => 30 );
		$this->q_edit ( $sql_data, $joinId );
		return $this->q_success ( "操作成功!" );
	}
	
	function packTaskJoin($joinId) {
		$data = $this->getMy ( $joinId );
		if (empty ( $data )) {
			return $this->q_error ( "参数有误!" );
		}
		
		if (! in_array ( $data ['state'], array (20, 60, 70 ) )) {
			return $this->q_error ( "当前不允许此操作!" );
		}
		
		$sql_data = array ("isdel" => 1 );
		$this->q_edit ( $sql_data, $joinId );
		return $this->q_success ( "操作成功!" );
	}
	
	function getListByTask($tid) {
		$UserModel = D ( 'User' );
		$myUser = $UserModel->loginUser ();
		$where = "taskid={$tid}";
		
		return $this->q_getList ( $where, 'id desc' );
	}
	function warpRow($row) {
		$UserModel = D ( 'User' );
		$row ['user_data'] = $UserModel->q_get ( $row ['uid'] );
		$row ['user_data'] ['student_and_photo'] = C ( "QINIU_IMG_DOMAIN" ) . $row ['user_data'] ['student_and_photo'];
		$row ['state_text'] = self::$JOIN_STATE [$row ['state']];
		
		return $row;
	}
	function addArbitrate($id,$arbitrate){
		$data['arbitrate'] = $arbitrate;
		$this->q_edit($data,'',"taskid=".$id);
		return $this->q_success();
	}

}