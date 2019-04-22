<?php
class CompanyTaskAction extends QAction {
	function __construct() {
		parent::__construct ();
		//检查实名认证
		$companyModel = D ( 'Company' );
		$companyModel->isRealNameAudit ();
	}
	/*发布任务*/
	/**
	 * 同意学生申请
	 * **/
	public function agreeJoin() {
		$id = $this->q_param ( 'id' );
		$companyModel = D ( 'Company' );
		$userinfo = $companyModel->isRealNameAudit ();
		if (empty ( $id )) {
			return $this->q_error ( '参数不能为空' );
		}
		$taskjoinModel = D ( 'TaskJoin' );
		$list = $taskjoinModel->q_get ( $id, '', array ('state' ) );
		if ($list) {
			if ($list ['state'] == 0) {
				$data ['state'] = 10;
				$res = $taskjoinModel->q_save ( $data, $id );
				if ($res) {
					return $this->q_success ( '已同意 ! !' );
				} else {
					return $this->q_error ( '操作失败！' );
				}
			} else {
				return $this->q_error ( '参数有误！' );
			}
		} else {
			return $this->q_error ( '出现异常' );
		}
	}
	/**
	 * 拒绝申请
	 * */
	public function refuseJoin() {
		$id = $this->q_param ( 'id' );
		if (empty ( $id )) {
			return $this->q_error ( '参数不能为空' );
		}
		$companyModel = D ( 'Company' );
		$list = $companyModel->isRealNameAudit ();
		$taskjoinModel = D ( 'TaskJoin' );
		$list = $taskjoinModel->q_get ( $id, '', array ('state' ) );
		if ($list) {
			if ($list ['state'] == 0) {
				$data ['state'] = 20;
				$res = $taskjoinModel->q_save ( $data, $id );
				if ($res) {
					return $this->q_success ( '已拒绝' );
				} else {
					return $this->q_error ( '操作失败！' );
				}
			} else {
				return $this->q_error ( '参数异常' );
			}
		} else {
			return $this->q_error ( '用户信息不存在' );
		}
	}
	
	/**
	 * 准备开始任务
	 * **/
	public function startTask() {
		$taskid = $this->q_param ( 'taskid' );//任务id
		if (empty ( $taskid )) {
			return $this->q_error ( '参数不能为空' );
		}
		$companyModel = D ( 'Company' );
		$list = $companyModel->isRealNameAudit (); //获得登录者的详细信息
		$taskModel = D ( 'Task' );
		$taskjoinModel = D ( 'TaskJoin' );
		$info = $taskModel->q_get ( $taskid, '', array ('state' ) );
		if ($info) {
			if ($info ['state'] == 10) {
				$data ['state'] = 20;
				$map['state']=40;
				$res = $taskModel->q_save ( $data,$taskid );
				$taskjoinModel->q_save($map,null,array(state=>30,taskid=>$taskid));
				if ($res) {
					return $this->q_success ( '开始任务' );
				} else {
					return $this->q_error ( '操作失败' );
				}
			} else {
				return $this->q_error ( '参数异常' );
			}
		} else {
			return $this->q_error ( '用户信息不存在' );
		}
	}
	/**
	 * 结束任务
	 * */
	public function endTask() {
		$taskid = $this->q_param ( 'taskid' );
		if (empty ( $taskid )) {
			return $this->q_error ( '参数错误' );
		}
		$companyModel = D ( 'Company' );
		$list = $companyModel->isRealNameAudit (); //获得登录者的详细信息
		$taskModel = D ( 'Task' );
		$taskjoinModel = D ( 'TaskJoin' );
		$info = $taskModel->q_get ( $taskid, '', array ('state' ) );
		if ($info) {
			if ($info ['state'] == 20) {//进行中
				$data ['state'] = 30;
				$map['state']=70;//已结束
				$res = $taskModel->q_save ( $data, $taskid );
				$taskjoinModel->q_save($map,null,array('state'=>40,taskid=>$taskid));
				if ($res) {
					return $this->q_success ( '已结束成功' );
				} else {
					return $this->q_error ( '操作失败！' );
				}
			} else {
				return $this->q_error ( '参数异常' );
			}
		}
	
	}
	
	/**
	 * 同意学生申请退出
	 * **/
	public function withdrawal() {
		$id = $this->q_param ( 'id' );
		if (empty ( $id )) {
			return $this->q_error ( '参数不能为空' );
		}
		$companyModel = D ( 'Company' );
		$list = $companyModel->isRealNameAudit ();
		$taskjoinModel = D ( 'TaskJoin' );
		$list = $taskjoinModel->q_get ( $id, '', array ('state' ) );
		if ($list) {
			if ($list ['state'] == 50) {
				$data ['state'] = 60;
				$res = $taskjoinModel->q_save ( $data, $id );
				if ($res) {
					return $this->q_success ( '已同意申请' );
				} else {
					return $this->q_error ( '操作失败！' );
				}
			} else {
				
				return $this->q_error ( '参数有异常' );
			}
		}
	}
	
	function myPublishList() {
		$taskModel = D ( 'Task' );
		$list = $taskModel->getPublishListByCompany ();
		return $this->q_success ( array ('list' => $list ) );
	}

}