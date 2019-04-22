<?php
	
class Tree{
	static public $treeList = array();  // 存放无限极分类结果
	public function create($data,$pid=0){
		foreach($data as $key=>$val){
			if($val['pid']==$pid){
				self::$treeList[]=$val;
				unset($data[$key]);
				self::create($data,$val['id']);
			}
		}
		return self::$treeList;
	}
}
?>