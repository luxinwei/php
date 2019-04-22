<?php
class CommonAction extends QAction {
 	function _initialize(){
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->redirect('Login/index');
        }
 
        $notAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, C('NOT_AUTH_ACTION'));
 
        //权限验证
        if(C('USER_AUTH_ON') && !$notAuth) {
            import('ORG.Util.RBAC');
            //使用了项目分组，则必须引入GROUP_NAME
            RBAC::AccessDecision() || $this->error("你没有对应的权限");
        }
    }
}