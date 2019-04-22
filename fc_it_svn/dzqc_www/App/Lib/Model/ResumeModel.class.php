<?php

class ResumeModel extends QModel {
	
	function getByUser($uid) {
		$where = "uid={$uid}";
		$resumeData=$this->q_get('',$where);
		$UserModel=D("User");
		$userData=$UserModel->q_get($uid);
		//$resumeData=array_merge($resumeData,$userData);
		//$resumeData['student_and_photo'] = C ( "QINIU_IMG_DOMAIN" ) . $userData['student_and_photo'];
		$userData['student_and_photo']=C ( "QINIU_IMG_DOMAIN" ) . $userData['student_and_photo'];
		$userData['personal_note']=$resumeData['personal_note'];
		return $userData;
	}
}