<?php
class TaskListAction extends QAction{
	function __construct() {
		parent::__construct ( "Task" );
	}
	
	function listTask(){
		$task_money = I('task_money');
		$task_cycle = I('task_cycle');
		$task_time = I('task_time');
		$search_key = I('search_key');
		
		$arg['state'] = 10;
		
		//查询所有发布的任务
		$taskModel = D('Task');
		$task_list = $taskModel->getMyRecommendList($arg,$task_money,$task_cycle,$task_time,$search_key);
		$this->q_pageList ( $task_list );
		
		$this->assign('list',$task_list);
		$this->display('list_task');
	}
	
	function detailTask(){
		$id = I('id');
		$taskModel = D('Task');
		$info = $taskModel->getCurrentTask($id);
		$this->assign('info', $info);
		$this->display('detail_task');
	}
}