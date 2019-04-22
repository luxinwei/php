
<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<style>
#myform {
    font-size: 14px;
    font-weight: 400;
    background-color: #FFFFFF;
    line-height: 25px;
}
</style>
    <div class="hmui-tabu hmui-shadow mt10">
    <!-- 树形图 -->
          <div class="fl w250 p15 treebox" style="background:#FFFFFF;"id="lefttree_con">
        <form  id="myform" >
			<input name="name" id="name" placeholder="请输入单位名称" class="hmui-input w200"/>
		</form>
            <div id="demo1"></div>
         </div>
        <div class="fr" style="width:calc(100% - 340px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:770px" id="main_con">
  			<div id="tbody_content" style="width:200px;height: 100px">
		
	
			</div>
        </div>
        <div class="cb"></div>
     </div>
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">
    $(document).ready(function(){
        var left_height=$("#main_con").height();
        $("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
    });
var bodyheight=$(document).height();
$(".iframe_content").height(bodyheight);
</script> 
<script type="text/javascript" src="js/firefightwatermonitor_list.js"></script>