var map = new BMap.Map("container");    // 创建Map实例

//----------------------------------------------------------------------------------------------------------------------------
map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
// 添加带有定位的导航控件
  var navigationControl = new BMap.NavigationControl({
    anchor: BMAP_ANCHOR_TOP_LEFT, // 靠左上角位置
    type: BMAP_NAVIGATION_CONTROL_LARGE, // LARGE类型
    enableGeolocation: true // 启用显示定位
  });
  map.addControl(navigationControl);
//----------------------------------------------------------------------------------------------------------------------------
  if(rmapx!=""&&rmapy!=""){
		var rpoint = new BMap.Point(rmapx,rmapy);
		map.centerAndZoom(rpoint, 15);
	}else{
		//确定搜索对象
		var local=new BMap.LocalSearch(map,{renderOptions:{map:map}});
		if(mapx!=""){
			map.centerAndZoom(new BMap.Point(mapx, mapy), 11);  // 初始化地图,设置中心点坐标和地图级别
		}else{
			//根据IP定位当前位置
			var myCity = new BMap.LocalCity();
			myCity.get(function(result){
			    var cityName = result.name;//当前定位城市
				map.setCenter(cityName);
				local.search(cityName);
			})
		}
	}
  


//----------------------------------------------------------------------------------------------------------------------------
//获取坐标下的搜索
function getPint(){
	var address = document.getElementById("address").value;
	local.search(address);    
}

//----------------------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------------
//创建标注
var markered = false;
if(mapx!=""){
  displayPoint();
}else{
  map.addEventListener("click", addAndDisplayPoint);
}
//创建标记
function addAndDisplayPoint(e){
    var point = new BMap.Point(e.point.lng, e.point.lat);  
	var marker = new BMap.Marker(point,{ enableDragging: true });  // 创建标注
	document.getElementById("mapx").value = e.point.lng;
	document.getElementById("mapy").value = e.point.lat; 		
	marker.setTitle("拖动标注点至正确位置");
	if (!markered) {
	    markered = true;
		map.addOverlay(marker);  
		
		var opts = {
	  width : 200,     // 信息窗口宽度
	  height: 100,     // 信息窗口高度
	  title : shopname , // 信息窗口标题
	  enableMessage:true//设置允许信息窗发送短息
	  //,message:mapintro
	}
	var infoWindow = new BMap.InfoWindow(address, opts);  // 创建信息
		    marker.openInfoWindow(infoWindow, marker);
		    marker.addEventListener("dragend", function(e){
			document.getElementById("mapx").value = e.point.lng;
			document.getElementById("mapy").value = e.point.lat; 		
	    }); 
     }else {
          alert("只能添加一个标注点！");
    }
    
}
//初始化标记
function displayPoint(){
var point = new BMap.Point(mapx, mapy);  
var marker = new BMap.Marker(point,{ enableDragging: true });  // 创建标注
marker.setTitle("拖动标注点至正确位置");
map.addOverlay(marker);  
var opts = {
	  width : 200,     // 信息窗口宽度
	  height: 100,     // 信息窗口高度
	  title : shopname , // 信息窗口标题
	  enableMessage:false//设置允许信息窗发送短息
	  //,message:"555555"
	}
	 var infoWindow = new BMap.InfoWindow(address, opts);  // 创建信息
	 marker.openInfoWindow(infoWindow, marker);
	 marker.addEventListener("dragend", function(e){
	            marker.openInfoWindow(infoWindow, marker);
				document.getElementById("mapx").value = e.point.lng;
				document.getElementById("mapy").value = e.point.lat; 		
	}); 
	marker.addEventListener("click", function(e){
	            marker.openInfoWindow(infoWindow, marker);
					
	}); 
}
//----------------------------------------------------------------------------------------------------------------------------

	