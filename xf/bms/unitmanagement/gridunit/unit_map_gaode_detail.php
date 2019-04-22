<?php include '../../../authen/include/page/top.php';?>
<?php 
 $scopeCoordinates=Fun::request("scopeCoordinates");
 echo $scopeCoordinates;
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

 

.button-group {
	position: absolute;
	bottom: 20px;
	right: 20px;
	font-size: 12px;
	padding: 10px;
}

.button-group .button {
	height: 28px;
	line-height: 28px;
	background-color: #0D9BF2;
	color: #FFF;
	border: 0;
	outline: none;
	padding-left: 5px;
	padding-right: 5px;
	border-radius: 3px;
	margin-bottom: 4px;
	cursor: pointer;
}
.button-group .inputtext {
	height: 26px;
	line-height: 26px;
	border: 1px;
	outline: none;
	padding-left: 5px;
	padding-right: 5px;
	border-radius: 3px;
	margin-bottom: 4px;
	cursor: pointer;
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
	 
	 var editorTool;
	  map = new AMap.Map("container", {
	        resizeEnable: true,
	  
	    });
	    //在地图上绘制折线
	    var editor={};
	    editor._polygon=(function(){
	    			 
	    //  var arr =[[113.541732,34.885726],[113.779747,34.8862],[113.783197,34.713569],[113.542307,34.709771]];
 	       var arr=<?php echo $scopeCoordinates?>;
 	        return new AMap.Polygon({
	            map: map,
	            path: arr,
	            strokeColor: "#0e81e5",
	            strokeOpacity: 4,
	            strokeWeight: 2,
	            fillColor: "#0e81e5",
	            fillOpacity: 0.30
	        });
	    })();
	    
	    map.setFitView();
	    editor._lineEditor= new AMap.PolyEditor(map, editor._line);
	    editor._polygonEditor= new AMap.PolyEditor(map, editor._polygon);
	    editor._circleEditor= new AMap.CircleEditor(map, editor._circle);
 
	 
	    editor.startEditPolygon=function(){
 	        editor._polygonEditor.open();
	    }
	    editor.closeEditPolygon=function(){
	        editor._polygonEditor.close();
	    }
		
	   
		     
}
 
</script>

<div id="container">
</div>
<div class="button-group">
     <input type="button" class="button" value="开始编辑" onClick="editor.startEditPolygon()"/>
    <input type="button" class="button" value="结束编辑" onClick="editor.closeEditPolygon()"/>
 </div>
<div style="width:603px;" id="latLng">

</div>
<script>
init();
</script>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 
</script>   
