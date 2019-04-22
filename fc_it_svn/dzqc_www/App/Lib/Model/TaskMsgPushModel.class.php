<?php

class TaskMsgPushModel extends QModel {
	public function addTaskPush($university,$major,$grade,$number,$mid){
		
		$university = explode("#", $university);
		$major = explode("#", $major);
		$university=array_filter($university);
		$major=array_filter($major);
		foreach ($university as $key=>$val){
			
			foreach ($major as $k=>$v){
				$data['university'] = $val;
				$data['major'] =$v;
				$data['taskid'] = $mid;
				$data['grade'] = $grade;
				$data['number'] = $number;
				$data['addtime'] = time();
				$data['state'] = 0;
				$res = $this->q_add($data);
				//echo $this->getLastSql();exit;
			}
		}
		return $res;
	}
}