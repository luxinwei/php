<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Forms | Amanda Admin Template</title><?php  common_css(); common_js(); ?></head><body class=""><div class="">    <div class="pageheader">            <h1 class="pagetitle">                         <a href="javascript:void(0)" class="btn btn4 btn_orange btn_bulb"></a>                            修改密码</h1>            <span class="pagedesc"></span>                  </div>                <div id="contentwrapper" class="contentwrapper">        	        	<form class="stdform stdform2" method="post" action="<?php echo U('Login/changePwd');?>">                                           	<p>                        	<label>新密码</label>                            <span class="field"><input type="password" name="password" id="password" class="longinput" value="<?php echo ($info["username"]); ?>" /></span>                        </p>												<p>                        	<label>确认密码</label>                            <span class="field"><input type="password" name="repassword" id="repassword" class="longinput" value="<?php echo ($info["email"]); ?>"/></span>                        </p>                                                <p class="stdformbutton">                        	<button class="submit radius2">保存</button>                            <input type="reset" class="reset radius2" value="重置" />                        </p>                    </form>        </div><!--contentwrapper-->        	</div></body></html>