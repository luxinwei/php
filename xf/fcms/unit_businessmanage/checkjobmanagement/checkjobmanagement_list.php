<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
 

 
<style>
	.s-center ul li{float:left;margin:20px}
	.pic-box{border:1px solid #b9c1d2;width:200px;height:200px;float:left}
	.pic-words{float:left;margin-left:20px}
	.pic-words p{line-height:150px}
	#myform {
    font-size: 14px;
    font-weight: 400;
    background-color: #FFFFFF;
    line-height: 25px;
}
</style>
<div class="mt10 hmui-shadow">
<div class="hmui-tabu">
	<!-- 树形图 -->
		<div class="fl w200 p15 treebox" style="background:#FFFFFF;" id="lefttree_con">
			<form class="myform">
				<input  placeholder="请输入关键字" id="name" name="name" class="hmui-input3 w150"/>
 			</form>
             <ul id="treeDemo" class="ztree"></ul>			
             <div id="tbody_content"></div>
		</div>
		<div id="t_content" class="s-center fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:705px">
			<ul>
				<li>
					<div class="pic-box"><img alt="" src="img/iconcamera.png"></div>
					<div class="pic-words">
						<p>名称</p>
						<input type="button" class="hmui-btn" value="查看">
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="pic-box"><img alt="" src="img/iconcamera.png"></div>
					<div class="pic-words">
						<p>名称</p>
						<input type="button" class="hmui-btn" value="查看">
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="pic-box"><img alt="" src="img/iconcamera.png"></div>
					<div class="pic-words">
						<p>名称</p>
						<input type="button" class="hmui-btn" value="查看">
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="pic-box"><img alt="" src="img/iconcamera.png"></div>
					<div class="pic-words">
						<p>名称</p>
						<input type="button" class="hmui-btn" value="查看">
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="pic-box"><img alt="" src="img/iconcamera.png"></div>
					<div class="pic-words">
						<p>名称</p>
						<input type="button" class="hmui-btn" value="查看">
					</div>
					<div class="clearfix"></div>
				</li>
			</ul>
		</div>
	<div class="cb"></div>
</div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
	$(document).ready(function(){
		var left_height=$("#t_content").height();
		$("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
	})
</script>           
<script type="text/javascript" src="js/checkjobmanagement_list.js"></script>