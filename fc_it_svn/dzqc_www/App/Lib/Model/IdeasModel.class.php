<?php

class IdeasModel extends QModel {
	public function getMyList(){
    	
    	$IdeasMsgPushModel=D('IdeasMsgPush');
    	$CompanyModel = D ( 'Company' );
    	$user=$CompanyModel->loginUser();
    	
    	$T_IdeasMsgPushModel=$IdeasMsgPushModel->getTableName();
    	$T_IdeasModel=$this->getTableName();
    	$user[industry]||$user[industry]=1;
    	$where=" a.id=b.ideasid and company_type='{$user[industry]}'";
    	$from="{$T_IdeasModel} a,{$T_IdeasMsgPushModel} b where {$where}";
    	$fields="a.*";
    	$list=$this->q_pageList($from, $fields);
		return $list;
    }
    
	public function updateAgree($id,$uid){
		$info = $this->q_get($id);
		$agree_user = explode(",", $info['agree_uid']);
		
		if (in_array($uid, $agree_user)){
			return false;
		}else{
			$data['agree'] = $info['agree']+1;
			if (empty($info['agree_uid'])){
				$data['agree_uid'] = $uid;
			}else{
				$data['agree_uid'] = $info['agree_uid'].",".$uid;
			}
			$ret = $this->q_save($data,$id);
			//echo $this->getLastSql();exit;
			return true;
		}
	}
}