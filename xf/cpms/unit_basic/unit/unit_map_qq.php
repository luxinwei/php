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
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
var position=window.opener.document.getElementById("position").value;

var position_array=position.split(",");

var shopmapy=position_array[1];
var shopmapx=position_array[0];
var isPointer=false;
if(shopmapx!=""&&shopmapy!=""){isPointer=true;}
var center=new qq.maps.LatLng(39.916527,116.397128);		
if(isPointer){
		center=new qq.maps.LatLng(shopmapy,shopmapx);
}
var init = function() {
    var map = new qq.maps.Map(document.getElementById("container"),{
        center: center,
        zoom: 13
    });

    if(isPointer){
    	 initPointer(center);
        
    }else{

    	 //获取城市列表接口设置中心点
        citylocation = new qq.maps.CityService({
            complete : function(result){
                map.setCenter(result.detail.latLng);
                initPointer(result.detail.latLng);
                
            }
        });
        //调用searchLocalCity();方法    根据用户IP查询城市信息。
        citylocation.searchLocalCity();
    }
    
 




  //添加监听事件   获取鼠标单击事件
    qq.maps.event.addListener(map, 'click', function(event) {
     var pointer=event.latLng;
     initPointer(pointer);
    });

function initPointer(pointer){
	  var marker=new qq.maps.Marker({
          position:pointer, 
          draggable: true,
          map:map
    });   
 qq.maps.event.addListener(map, 'click', function(event) {
     marker.setMap(null);      
}); 
 qq.maps.event.addListener(marker,"click",function(){
	   var lat=marker.getPosition().getLat();
	   var lng=marker.getPosition().getLng();
	   window.opener.document.getElementById("position").value=lng+","+lat;

     window.close();
});
 
}


    
/*
    
    qq.maps.event.addListener(map,'mousemove',function(event) {
        var latLng = event.latLng,
            lat = latLng.getLat().toFixed(5),
            lng = latLng.getLng().toFixed(5);
        document.getElementById("latLng").innerHTML = lat+','+lng;
    });
    qq.maps.event.addListener(map,'click',function(event) {
        var latLng = event.latLng,
            lat = latLng.getLat().toFixed(5),
            lng = latLng.getLng().toFixed(5);
        window.opener.document.getElementById("shopmapy").value=lat;
        window.opener.document.getElementById("shopmapx").value=lng;
        window.close();

      
    
    });
    */
    //===添加标记============================================================
    

    
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
