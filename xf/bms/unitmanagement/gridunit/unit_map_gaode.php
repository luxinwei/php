<?php include '../../../authen/include/page/top.php';?>
<?php 
 
?>
<?php 

$obj=array();
$shopmapy=$obj["SHOP_MAPY"];
$shopmapx=$obj["SHOP_MAPX"];

?>

<style type="text/css">
*{
    margin:0px;
    padding:0px;
}
body, button, input, select, textarea {
    font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
}
#container{
	min-width:600px;
	min-height:767px;
}
</style>

<script src="http://webapi.amap.com/maps?v=1.4.3&key=<?php echo ParaUtil::getInstance()->getContent("GAODE_MAP_KEY")?>"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>

<script>
var position=window.opener.document.getElementById("position").value;
var position_array=position.split(",");

var shopmapy=position_array[1];
var shopmapx=position_array[0];
var isPointer=false;
if(shopmapx!=""&&shopmapy!=""){isPointer=true;}
//var center=[116.397428, 39.90923];	
var center=new AMap.LngLat(116.397428,39.90923);
if(isPointer){
		//center=[shopmapx,shopmapy];
		center=new AMap.LngLat(shopmapx,shopmapy);
}
 function init() {

			var map = new AMap.Map("container", {
			    resizeEnable: true,
			    center: center,
			    zoom: 13
			});
		 
		    //在地图中添加MouseTool插件
		    map.plugin(["AMap.MouseTool"], function() {
		        var mouseTool = new AMap.MouseTool(map);
		        //鼠标工具插件添加draw事件监听
		        AMap.event.addListener(mouseTool, "draw", function callback(e) {
		            var eObject = e.obj;//obj属性就是鼠标事件完成所绘制的覆盖物对象。
		            console.log(eObject);
		        });
		        mouseTool.measureArea();  //调用鼠标工具的面积量测功能
		    });

		        
		     
}









</script>

<div id="container"></div>
<div style="width:603px;" id="latLng"></div>
<script>
init();
</script>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 
</script>   
