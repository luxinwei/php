
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
   <script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<style>
.hmui-grid{ background-color:#FFFFFF;width:100%;white-space: nowrap;overflow:hidden;}
.hmui-grid caption{font-size:12px;font-weight: 400;line-height:25px;margin:2px 0px -1px 0px;padding: 10px;}
.hmui-grid tr{height:30px;line-height:30px}
.hmui-grid tr:nth-child(odd){background:#f6f7fa}
.hmui-grid th{font-size: 12px;padding: 5px;background: #e0e5ef;color:#636a7a;font-family:"Microsoft YaHei";text-align:center;font-weight: 600}
.hmui-grid td{padding:5px;font-size:13px; color:#626c81;text-align: center;text-overflow:ellipsis;}
.hmui-btn{background-color:#5b8cff;display: inline-block;line-height:32px;padding: 0 10px;color: #fff;white-space: nowrap;text-align: center;border: none;border-radius: 2px;cursor: pointer;}
.box_btn{line-height: 40px;margin-bottom: 5px}
.title{font-size: 17px;}
.treebox{padding-left: 20px;padding-right: 20px;padding-top: 5px;}
.hmui-input{width:143px;height:30px;line-height: 25px; border: 1px solid #cadaff; background-color:#f0f3fa; border-radius: 2px;margin:2px;color:#626c81;padding-left:10px}
.alert_info{font-size:12px;font-weight: 400;background-color: #FFFFFF;line-height:20px;padding: 3px;}
</style>
<div class="mt10 hmui-shadow">
<!-- 树形图 -->
	<div class="fl treebox" style="width:20%;background:#FFFFFF;"  id="lefttree_con">
			<div class="box_btn">
			<caption class="caption"> 
				<div class="title"> 字典类型</div>
				<div>
					<form id="myform" class="alert_info" >
					  	<input name="code" placeholder="编码" class="hmui-input mr10"/>
						<input name="name" placeholder="名称" class="hmui-input mr10"/>
					</form>
				</div>
				<span class="">
						<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
					<input type="button" value="增加" class="hmui-btn ml5" id="btn_add"/>
					<input type="button" value="编辑" class="hmui-btn ml5" id="btn_edit"/>
					<input type="button" value="删除" class="hmui-btn ml5" id="btn_del"/>
					<input type="button" value="字典项" class="hmui-btn ml5" id="btn_code"/>
				</span>
				</caption>  
			</div>
	 		<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
				<tr>
					<th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
					<th>编码</th>
					<th>字典类型名称</th>
				</tr>
				<tbody id="tbody_content"></tbody>                                                                  
			</table>
		<div id="pageNav" class="mt10"></div>
		<div class="h50"></div>
 	</div>

	<div class="fr" style="width:calc(90% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:760px" id="main_con">
		
		 <iframe id="menumanagement_iframe" name="menumanagement_iframe" frameborder=0   style="width:100%;min-height:760px;" src="" ></iframe>
	

 	 
 </div>
 <div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">
	$(document).ready(function(){
		var left_height=$("#main_con").height();
		$("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
	})
var bodyheight=$(document).height();
$(".iframe_content").height(bodyheight);
 
var id="<?php echo $id?>";
 </script> 
<script type="text/javascript" src="js/dictionarytype_list.js"></script>
 