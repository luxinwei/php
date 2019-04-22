<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<?php 
$id=Fun::request("id");
$libsArray=array("0"=> "0","1"=> "1","2"=>"2");

 ?>
<style>
.selector{border: 1px #c6c6c6 solid;}

 
</style>
<body style="background:#FFFFFF;width: 100%;height:100%" >
<input type="button" value="保存" id="btn_save" class="hmui-btn ml10 fr"/>
<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10 fr"/>


		<div class="cb"></div>
			<table width="600" class="hmui-form" align="center">
				 <tr>
					<th style="text-align: left" width="100"><font class="cred">*</font>操作名称</th>
	 		  	    <td >
	 		  	    <input class="hmui-input w" id="name"/>
	 		  	    <input type="hidden" id="parentId" value="<?php echo $id;?>"/>
  	 		  	    </td>
			    </tr>
			    <tr>
	  	 			<th style="text-align: left"><font class="cred">*</font>请求方式</th>
	  				<td><input class="hmui-input w" id="requestMethod" name="requestMethod"  /></td>
		 		  </tr>
			      <tr>
	  	 			 <th style="text-align: left"><font class="cred">*</font>请求地址</th>
	  			  	 <td><input class="hmui-input w" id="url" name="url"  /></td>
	 		     </tr>
	 		     <tr>
	  	 			<th style="text-align: left"><font class="cred">*</font>菜单排序编号</th>
	  				<td><input class="hmui-input w" id="sortNum" name="sortNum" maxlength=5 /></td>
		 		  </tr>
		    </table>
	 	 
			 
</body>
<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 </script> 
<script type="text/javascript" src="js/operationmanagement_add.js"></script>

 