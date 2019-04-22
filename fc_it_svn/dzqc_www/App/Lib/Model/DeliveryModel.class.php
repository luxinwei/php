<?php

class DeliveryModel extends QModel {
	
	function getListByRecruit($tid) {
		$where = "rid={$tid}";
		
		return $this->q_getList ( $where, 'id desc' );
	}
function warpRow($row) {
		$UserModel = D ( 'User' );
		$row ['user_data'] = $UserModel->q_get ( $row ['uid'] );
		$row ['user_data'] ['student_and_photo'] = C ( "QINIU_IMG_DOMAIN" ) . $row ['user_data'] ['student_and_photo'];
		
		return $row;
	}
}