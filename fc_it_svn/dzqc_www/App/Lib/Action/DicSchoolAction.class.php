<?php
class DicSchoolAction extends QAction {
	
	function __construct() {
		parent::__construct ( "DicSchool" );
	}
	public function getListByCity() {
		$cid = I ( 'city_id' );
		$list = $this->q_model->getListByCity ( $cid );
		return $this->q_success ( array ("list" => $list ) );
	}
	public function getListByIDS() {
		$id = I ( 'ids' );
		$list = $this->q_model->getListByIDS ( $id );
		return $this->q_success ( array ("list" => $list ) );
	}
	
	function bath_add() {
		$str="郑州轻工业学院轻工职业学院
河南工业大学化学工业职业学院
郑州航空工业管理学院信息统计职业学院
中原工学院广播影视职业学院
郑州轻工业学院民族职业学院
华北水利水电学院水利职业学院
铁道警官高等专科学校
郑州电力高等专科学校
河南公安高等专科学校
河南财政税务高等专科学校（郑州金水、中牟白沙）
河南商业高等专科学校
郑州牧业工程高等专科学校
河南职业技术学院
河南司法警官职业学院
郑州铁路职业技术学院
河南检察职业学院（新郑龙湖）
河南质量工程职业学院（新郑）
郑州信息科技职业学院
河南经贸职业学院
河南农业职业学院（中牟）
河南交通职业技术学院
郑州旅游职业学院
郑州职业技术学院
河南工业贸易职业学院（新郑龙湖）
郑州科技职业学院
郑州华信职业技术学院（新郑）
郑州电力职业技术学院（中牟）
郑州澍青医学高等专科学校
郑州交通职业学院
郑州经贸职业学院
郑州电子信息职业技术学院（中牟）
河南职工医学院（新郑龙湖）
河南省建筑职工大学";
		
		$arr=explode("\r\n", $str);
		foreach ($arr as $name) {
			$data=array();
			$data['name']=$name;
			$data['province']=41;
			$data['city']=4101;
			$data['area']=410105;
			$data['address']="大学路化工路";
			$this->q_model->add($data);
		}
	}
}
?>