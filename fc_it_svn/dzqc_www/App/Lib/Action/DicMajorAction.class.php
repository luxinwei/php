<?php 
class DicMajorAction extends QAction{
	
	function __construct() {
		parent::__construct("DicMajor");
	}
	public function getListBySchool(){
		$cid=I('school_ids');
		$list=$this->q_model->q_getList();
		return $this->q_success(array("list"=>$list));
	}
	
	
	public function getListByIDS(){
		$id=I('ids');
		$list=$this->q_model->getListByIDS($id);
		return $this->q_success(array("list"=>$list));
	}
	
function bath_add() {
		$str="理论物理
粒子物理与原子核物理
原子与分子物理
等离子体物理
凝聚态物理
声学
光学
无线电物理
化学
无机化学
分析化学
有机化学
物理化学(含：化学物理)
高分子化学与物理
天文学
天体物理
天体测量与天体力学
地理学
自然地理学
人文地理学
地图学与地理信息系统
大气科学
气象学
大气物理学与大气环境
海洋科学
物理海洋学
海洋化学
海洋生物学
海洋地质
地球物理学
固体地球物理学
空间物理学
地质学
矿物学、岩石学、矿床学
地球化学
古生物学与地层学(含：古人类学)
构造地质学
第四纪地质学
生物学
植物学
动物学
生理学
水生生物学
微生物学
神经生物学
遗传学
发育生物学
细胞生物学
生物化学与分子生物学
生物物理学
生态学
系统科学
系统理论
系统分析与集成
科学技术史";
		
		$arr=explode("\r\n", $str);
		foreach ($arr as $name) {
			$data=array();
			$data['name']=$name;
			$this->q_model->add($data);
		}
	}
}
?>