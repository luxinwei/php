<?php

class FilesModel extends QModel {
	function getByMid($type,$mid) {
		$where="type={$type} and mid={$mid}";
		$list=$this->q_getList($where);
		foreach ($list['rows'] as &$row) {
			$row['download_url']=C("QINIU_IMG_DOMAIN").$row['fkey'];
		}
		
		return $list;
	}

	function addCompanyFiles($fname,$file_key,$uid,$mid,$type){
			
			$arr['fkey'] = $file_key;
			$arr['fname'] = $fname;
			$arr['uid'] = $uid;
			$arr['createtime'] = time();
			$arr['type'] = $type;
			$arr['usertype'] = 2;
			$arr['mid'] = $mid;
			$ret = $this->q_add($arr);
	}
	
}