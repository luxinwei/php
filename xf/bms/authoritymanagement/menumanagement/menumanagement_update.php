<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<?php 
$id=Fun::request("id");
$detailid=Fun::request("detailid");
$pId=Fun::request("pId");
$appCode=Fun::request("appCode");
$name   =   Fun::request("name");
$levell  =   Fun::request("levell");
$libsArray=array("0"=> "0","1"=> "1","2"=>"2");
 
?>
<style>
.selector{border: 1px #c6c6c6 solid;}

 
</style>
<body style="background:#FFFFFF;width: 100%;height:100%" >
<span class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
</span>

		<div class="cb"></div>
			<table width="1200" class="hmui-form" align="center">
				 <tr>
					<th style="text-align: left" width="200"><font class="cred">*</font>菜单名称</th>
	 		  	    <td >
	 		  	    <input class="hmui-input w" id="name" />
	 		  	     <input type="hidden" id="parentId" value="<?php echo $id;?>"/>
	 		  	    <input type="hidden" id="appCode" value="<?php echo $appCode;?>"/>
	 		  	    <input type="hidden" id="menuIds" menuIdsValue="" />
 	 		  	    </td>
			    </tr>
			    <tr>
	  	 			<th style="text-align: left"><font class="cred">*</font>菜单排序编号</th>
	  				<td><input class="hmui-input w" id="sortNum" name="sortNum" maxlength=5 /></td>
		 		  </tr>
			      <tr>
	  	 			 <th style="text-align: left"><font class="cred">*</font>菜单等级</th>
	  				 <td>
	  				 <select class="hmui-select w" id="level" value="<?php echo $level;?>">
				    	 <option value="">请选择 </option>
				    	  <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>		    
				    </select>
	  			   </td>
	 		     </tr>
	 		     <tr>
					 <th style="text-align: left" width="100">对应功能</th>
						 <td>
							  <div id="leftSelector" multiple="multiple" name="SmsListOnLeft"  class="selector w pl10">
									  	<form  id="myform" class="alert_info">
											<input name="" id="key"  placeholder="请输入名称" class="hmui-input3 w300"/>
											<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
										</form>
										<ul id="treeDemo" class="ztree"></ul>
										<div class="tc">
											<input type="button"  onclick="aa()" id="btn_aa" value="确定" class="hmui-btn  ml10"/>
 										 </div>
 							  </div>
						 </td>  
					 </tr>
					<th width="100" style="text-align: left">一级菜单默认链接</th>
					<td>
						<select id="menuId" class="w hmui-select">
							<option value="" selected="selected">请选择</option>
						</select>
					</td>
				</tr>
		    </table>
			 
</body>
<div id="tbody_ss"></div>
<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
inputInt("sortNum"); //js验证

var detailid="<?php echo $detailid;?>"
var id="<?php echo $id;?>"
var appCode="<?php echo $appCode;?>"
var level="<?php echo $levell;?>"
$("#level").find("option[value='"+level+"']").attr("selected",true);
  </script> 
<script type="text/javascript" src="js/menumanagement_update.js"></script>

 