<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	                                		<option value="<?php echo ($vo["id"]); ?>" <?php if($info['pid'] == $vo['id']): ?>selected="selected"<?php endif; ?>>&nbsp;&nbsp;--<?php echo ($vo["title"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>