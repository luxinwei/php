<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Forms | Amanda Admin Template</title><?php  common_css(); common_js(); ?></head><body class=""><div class="">    <div class="pageheader">            <h1 class="pagetitle">                         <a href="javascript:void(0)" class="btn btn4 btn_orange btn_bulb"></a>                           编辑节点</h1>            <span class="pagedesc"></span>           <ul class="toolbar">                   		<li><a href="<?php echo U('Rbac/nodeList');?>" class="btn btn_blue   btn_archive"><span>返回列表</span></a></li>                    </ul>        </div>                <div id="contentwrapper" class="contentwrapper">        	        	<form class="stdform stdform2" method="post" action="<?php echo U('Rbac/saveNodeHandle');?>">                    	<p>                        	<label>节点名</label>                            <span class="field">                             <input type="hidden" name="id" id="id" class="longinput" value="<?php echo ($info["id"]); ?>" />                            <input type="text" name="name" id="name" class="longinput" value="<?php echo ($info["name"]); ?>" />                            </span>                        </p>                                                <p>                        	<label>中文名</label>                            <span class="field"><input type="text" name="title" id="title" class="longinput" value="<?php echo ($info["title"]); ?>" /></span>                        </p>                                               <p>                        	<label>状态</label>                            <span class="field">	                            <select name="status" id="status">	                                <option value="0" <?php if($info["status"] == 0): ?>selected="selected"<?php endif; ?> >禁用</option>	                                <option value="1" <?php if($info["status"] == 1): ?>selected="selected"<?php endif; ?>>启用</option>	                            </select>                            </span>                        </p>                                                 <p>                        	<label>排序</label>                            <span class="field"><input type="text" name="sort" id="sort" class="longinput" value="<?php echo ($info["sort"]); ?>" /></span>                        </p>                                                 <p>                        	<label>父节点</label>                            <span class="field">                            	<select name="pid" id="pid">	                                <option value="0" <?php if($info['pid'] == 0): ?>selected="selected"<?php endif; ?>>根节点</option>	                                <?php if(is_array($node)): $k = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($vo["level"] == 1): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($info['pid'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["title"]); ?></option>	                                		<?php else: ?>
	                                		<option value="<?php echo ($vo["id"]); ?>" <?php if($info['pid'] == $vo['id']): ?>selected="selected"<?php endif; ?>>&nbsp;&nbsp;--<?php echo ($vo["title"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	                            </select>                            </span>                        </p>                                                <p>                        	<label>级别</label>                            <span class="field">                            	<select name="level" id="level">	                                <option value="1" <?php if($info["level"] == 1): ?>selected="selected"<?php endif; ?>>项目</option>	                                <option value="2" <?php if($info["level"] == 2): ?>selected="selected"<?php endif; ?>>模块</option>	                                <option value="3" <?php if($info["level"] == 3): ?>selected="selected"<?php endif; ?>>操作</option>	                            </select>                            </span>                        </p>                                                  <p>                        	<label>是否自动显示</label>                            <span class="field">	                            <select name="isshow" id="status">	                                <option value="1" <?php if($info["isshow"] == 1): ?>selected="selected"<?php endif; ?> >显示</option>	                                <option value="2" <?php if($info["isshow"] == 2): ?>selected="selected"<?php endif; ?>>不显示</option>	                            </select>                            </span>                        </p>                                                                        <p class="stdformbutton">                        	<button class="submit radius2">保存</button>                            <input type="reset" class="reset radius2" value="重置" />                        </p>                    </form>        </div><!--contentwrapper-->        	</div></body></html>