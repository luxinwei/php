<?php
class CodeAction extends QAction{
	public function getVerify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	public function chkVerify(){
		$verify = $this->q_param('verify');
		$codeModel = D('Code');
		$ret = $codeModel->chkVerify($verify);
		if ($ret) {
			return $this->q_success('图片验证码验证成功');
		}else{
			return $this->q_error('2次图片验证码不一致');
		}
	}
}