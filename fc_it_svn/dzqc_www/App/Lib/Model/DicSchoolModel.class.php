<?php

class DicSchoolModel extends QModel {
	function getListByCity($city) {
		$where = "city={$city}";
		$list = $this->q_getList ( $where );
		foreach ( $list ['rows'] as &$row ) {
			$row = $this->warpRow ( $row );
		}
		
		return $list;
	}
	function getListByIDS($ids) {
		$where = "id in ({$ids})";
		$list = $this->q_getList ( $where );
		foreach ( $list ['rows'] as &$row ) {
			$row = $this->warpRow ( $row );
		}
		return $list;
	}
	
	function getNameById($id){
		$info = $this->q_get('',"id={$id}",array('name'));
		return $info['name'];
	}
	
	function warpRow($row) {
		
		$DicAreaModel = D ( 'DicArea' );
		$provinceData = $DicAreaModel->q_get ( $row ['province'] );
		$cityData = $DicAreaModel->q_get ( $row ['city'] );
		$areaData = $DicAreaModel->q_get ( $row ['area'] );
		$row ['full_address'] = $provinceData ['title'] . " " . $cityData ['title'] . " " . $areaData ['title'] . " " . $row ['address'];
		$row ['province'] = $provinceData ['title'];
		$row ['city'] = $cityData ['title'];
		$row ['area'] = $areaData ['title'];
		$row ['logo']= C ( "QINIU_IMG_DOMAIN" ) .$row ['logo'];
		$row['logo']="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2086640645,1668288328&fm=58";
		return $row;
	}
}