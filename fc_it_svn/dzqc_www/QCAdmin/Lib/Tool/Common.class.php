<?php
class Common{
	protected static $treeList = array();
	public static function create($data,$pid=0){
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