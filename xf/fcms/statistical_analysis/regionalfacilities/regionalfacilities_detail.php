<?php include '../../../authen/include/page/top.php';?>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

<div class="hmui-tabu hmui-shadow mt10">
    <!-- 树形图 -->
    <div class="fl w200 p15 treebox" style="background:#FFFFFF;"id="lefttree_con">
        <div id="demo1"></div>
    </div>
    <div class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:750px" id="main_con">
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
                <li class="layui-this">特级</li>
                <li>一级</li>
                <li>二级</li>
                <li>三级</li>
            </ul>
            <div style="background:#FFFFFF;" class="p20" align="center">
                <div style="width:1300px;margin:0 auto">
                    <div class="fl mb50 p20">
                        <div id="pie_part" style="width:600px;height:400px;"></div>
                    </div>
                    <div class="fl mb50 ml20 p20">
                        <div id="pie_call" style="width:600px;height:400px;"></div>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="100%">
                <caption class="m10">负责人信息</caption>
                <tr>
                    <th>单位名称</th>
                    <th>上级主管单位</th>
                    <th>设备总数</th>
                </tr>
                <tr>
                    <td>同多弘装修公司</td>
                    <td>一级单位</td>
                    <td>66</td>

                </tr>
                <tr>
                    <td>赛斐莱装修公司</td>
                    <td>二级单位</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>海通食品公司</td>
                    <td>三级单位</td>
                    <td>11</td>
                </tr>
                <tr>
                    <td>美宜家家政公司</td>
                    <td>特级单位</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>同多弘装修公司</td>
                    <td>一级单位</td>
                    <td>66</td>

                </tr>
                <tr>
                    <td>赛斐莱装修公司</td>
                    <td>二级单位</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>海通食品公司</td>
                    <td>三级单位</td>
                    <td>11</td>
                </tr>
                <tr>
                    <td>美宜家家政公司</td>
                    <td>特级单位</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>同多弘装修公司</td>
                    <td>一级单位</td>
                    <td>66</td>

                </tr>
                <tr>
                    <td>赛斐莱装修公司</td>
                    <td>二级单位</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>海通食品公司</td>
                    <td>三级单位</td>
                    <td>11</td>
                </tr>
                <tr>
                    <td>美宜家家政公司</td>
                    <td>特级单位</td>
                    <td>10</td>
                </tr>

            </table>
            <div id="pageNav">
                <div class="pagerb1">
                    <ul>
                        <li> <a class="page-first">第一页</a></li>
                        <li> <a class="page-prev">上一页</a></li>
                        <li> <a href="javascript:void(0);" class="page-next">下一页</a></li>
                        <li> <a href="javascript:void(0);" class="page-last">最后页</a></li>
                    </ul>
                    第<input type="text" class="page-num">页/共3页 <span style="padding-left:10px;">共5条记录</span></div></div>
        </div>
        <div class="cb"></div>
           <!-- <div class="layui-tab-content " style="width:100%;background:#FFFFFF;">
                <div class="layui-tab-item layui-show" ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail1.php"></iframe></div>
                <div class="layui-tab-item " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail2.php"></iframe></div>
                <div class="layui-tab-item " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail3.php"></iframe></div>
                <div class="layui-tab-item " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail4.php"></iframe></div>
                <div class="layui-tab-item  " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail5.php"></iframe></div>
                <div class="layui-tab-item  " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail6.php"></iframe></div>
                <div class="layui-tab-item  " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail7.php"></iframe></div>
                <div class="layui-tab-item  " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail8.php"></iframe></div>
                <div class="layui-tab-item  " ><iframe frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricfiremonitor_detail9.php"></iframe></div>
            </div>-->
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
<script type="text/javascript" src="js/regionalfacilities_detail.js"></script>
<script type="text/javascript" src="js/regionalfacilities_pie_call.js"></script>
<script type="text/javascript" src="js/regionalfacilitiesl_pie_part.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>