<?php include '../../../authen/include/page/top.php';?>
<?php $b='0';$b = $_GET['b']; ?>
  <input type="hidden" value="<?echo $b ?>" id="haha">
<div class="hmui-shadow mt10">
      <div class="fl w200 p15" style="background:#FFFFFF;"id="lefttree_con">
				<ul>
					<li><input name="fire" type="checkbox" class="hmui-checkbox" value="1"><span>火灾报警信息</span></li>
					<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="2"><span>可燃气体探测报警信息</span></li>
					<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="3"><span>电气火灾监控报警信息</span></li>
					<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="4"><span>屏蔽信息</span></li>
					<li><input name="fire" type="checkbox" class="hmui-checkbox"  value="5"><span>故障信息</span></li>
				</ul>
	</div>
     <div class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;" id="main_con">
			 <iframe id="automaticfirealarm_iframe" name="automaticfirealarm_iframe" frameborder=0   style="width:100%;min-height:500px;" src="automaticfirealarm_list_content1.php" ></iframe>
	  </div>
</div>
<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
$(document).ready(function(){
    var left_height=$("#main_con").height();
    $("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
});
var bodyheight=$(document).height();

$("#automaticfirealarm_iframe").height(bodyheight-70);
</script>
<script type="text/javascript" src="js/automaticfirealarm_list.js"></script>
 