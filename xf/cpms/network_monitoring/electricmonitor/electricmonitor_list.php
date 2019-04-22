<?php include '../../../authen/include/page/top.php';?>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<div class="hmui-tabu hmui-shadow mt10">
    <!-- 树形图 -->
        <div class="fl w200 p15 treebox" style="background:#FFFFFF;"id="lefttree_con">
           <!--  <div id="demo1"></div> -->
           <ul id="treeDemo" class="ztree"></ul>
         </div>
        <div class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;" id="main_con">
          <iframe id="electricmonitor_main_iframe" name="electricmonitor_main_iframe" frameborder=0   style="width:100%;min-height:500px;" src="electricmonitor_main.php" ></iframe>
        </div>
        <div class="cb"></div>
</div>
<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
$(document).ready(function(){
    var left_height=$("#main_con").height();
    $("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
});

var bodyheight=$(document).height();

$("#electricmonitor_main_iframe").height(bodyheight-70);
</script>           
<script type="text/javascript" src="js/electricmonitor_list.js"></script>