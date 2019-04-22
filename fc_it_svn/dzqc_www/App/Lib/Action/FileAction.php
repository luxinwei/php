<?php
class FileAction extends ActionSupport {
	function __construct() {
		parent::__construct ( __FILE__ );
		$this->model = new FileModel ();
	}
	function upload() {
		//不允许用户删除
		$old ='';
		$type = $this->getParam ( 'type', 1 );
		$isEditor = $this->g ( 'isEditor', 0 );
		$local = $this->g ( 'local', 1 );
		$filename = $this->g ( 'filename', 'fileToUpload' );
		$dir = $this->getParam ( 'dir','' );
		$allowDir=array('face','exchange','lou');
		if(!in_array($dir, $allowDir)){
//			return $this->error('参数有误');
		}
		$ret = FileHandler::upload ( $filename, $dir,$old ,1);
		if ($ret ['code'] !== '1') {
			return $this->error ( $ret ['msg'] );
		} else {
			foreach ( $ret ['path'] as &$pv ) {
				$pv = str_replace ( ROOT, '', $pv );
				$this->model->add ( array ('type' => $type, 'addtime' => TIME, 'path' => $pv ) );
			}
			if (count ( $ret ['path'] ) == 1) {
				$ret ['path'] = $ret ['path'] [0];
				$ret ['url'] = $ret ['url'] [0];
			}
			if ($isEditor) {
				$HOST=HOST;
				echo <<<LQP
<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(2, '{$HOST}{$ret ['path']}', '');</script>
LQP;
			} else {
				return $this->success ( array ('path' => $ret ['path'],'url' => $ret ['url'] ) );
			}
		
		}
	}
}