
$("#container").css("height",$(window).height()-100);
var map = new BMap.Map("container");    // 创建Map实例
map.addControl(new BMap.NavigationControl());//添加方法缩小控件
//----------------------------------------------------------------------------------------------------------------------------
map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

if(rmapx!=""&&rmapy!=""){
	var rpoint = new BMap.Point(rmapx,rmapy);
	map.centerAndZoom(rpoint, 15);
}else{
	//var point = new BMap.Point(116.404, 39.915);
	//map.centerAndZoom(point, 15);
	initCurPosition();
}

$("#btn_his").bind("click", function(){window.location.href="fimorg_gridlist.php?&m="+m;  });	
$("#btn_find").bind("click", function(){ 
	var type=$("#type").val();
	var orgkind=$("#orgkind").val();
	var title=$("#title").val();
	window.location.href="fimorg_map_list.php?title="+title+"&type="+type+"&orgkind="+orgkind+"&m="+m;
	
});
search();
function search(){
//	map.clear();
	var points = [];
	var params=decodeURI($("#myform").serialize());
	var url="fimorgAction.php?action=mappoint";
	$.post(url,params,function(responseText){
	     var ds=eval("("+responseText+")"); 
	     if(ds.totalProperty>0){ 
	    	 for(var j=0;j<ds.root.length;j++){
	    		 var point=new BMap.Point(ds.root[j]["MAPX"], ds.root[j]["MAPY"]);
	    		 point.title=ds.root[j]["TITLE"];
	    		 point.address=ds.root[j]["ADDRESS"];
	    		 point.membernum=ds.root[j]["MEMBERNUM"];
	    		 point.interal=ds.root[j]["INTERAL"];
	    		 point.interalorder=ds.root[j]["INTERALORDER"];
	    		 points.push(point);
	     	}
	    	 // addMorePoint(points);
	    	  addMarker(points);
	    	 map.setViewport(points); //调整视野  
	     }
	     
	})   

}


//批量加点，不能自定义图标
function addMorePoint(points){
	var options = {
		       // size: BMAP_POINT_SIZE_HUGE,
				size:BMAP_POINT_SIZE_BIGGER,
		        shape: BMAP_POINT_SHAPE_STAR,
		        color: '#f00'
		    }
		    var pointCollection = new BMap.PointCollection(points, options);  // 初始化PointCollection
		    pointCollection.addEventListener('mouseover', function (e) {
		    	var point = new BMap.Point(e.point.lng, e.point.lat);
                var opts = {
                    width: 300,     // 信息窗口宽度
                    height: 150,     // 信息窗口高度
                    title: "信息标题", // 信息窗口标题
                    enableMessage: false//设置允许信息窗发送短息
                };
                var content="";
                content+="名称："+e.point.title;
                content+="<br/>党员数量："+e.point.membernum;
                content+="<br/>组织积分："+e.point.interal;
                content+="<br/>组织排名："+e.point.interalorder;
                content+="<br/>地址："+e.point.address;
                content+="<br/>坐标："+e.point.lng + ',' + e.point.lat;
                var infowindow = new BMap.InfoWindow( content, opts);
                map.openInfoWindow(infowindow, point);
		
		    });
		    map.addOverlay(pointCollection);  // 添加Overlay

}

//编写自定义函数,创建标注
function addMarker(points){

for(var j=0;j<points.length;j++){ 	
	  var point=points[j];
	  var myIcon = new BMap.Icon("js/img/dang_ico.png", new BMap.Size(25, 25), {    //小车图片
		  //offset: new BMap.Size(0, -5),    //相当于CSS精灵
		  imageOffset: new BMap.Size(0, 0)    //图片的偏移量。为了是图片底部中心对准坐标点。
	     });

	  
	  
      var marker = new BMap.Marker(point,{icon:myIcon});
	//marker.setLabel(new BMap.Label(point.title,{offset:new BMap.Size(20,-10)}));
      map.addOverlay(marker);
      addClickHandler(marker,point);
	 }
}
//添加信息窗口
function addClickHandler(marker,point){
	marker.addEventListener("mouseover",function(e){
		//var p=e.target;
		//var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
		var opts = {
                width: 300,     // 信息窗口宽度
                height: 150,     // 信息窗口高度
                title: "信息标题", // 信息窗口标题
                enableMessage: false//设置允许信息窗发送短息
            };
            var content="";
            content+=point.title;
            content+="<br/>党员数量："+point.membernum;
            content+="<br/>组织积分："+point.interal;
            content+="<br/>组织排名："+point.interalorder;
            content+="<br/>地址："+point.address;
            content+="<br/>坐标："+point.lng + ',' + point.lat;
            var infowindow = new BMap.InfoWindow( content, opts);
            map.openInfoWindow(infowindow, point);
		
		
	});
}


function initCurPosition(){
	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r){
		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			map.centerAndZoom(r.point,12);
			
			var iconpath="js/img/cur.png";
			var myIcon = new BMap.Icon(iconpath, new BMap.Size(30, 36), {    //小车图片
				//offset: new BMap.Size(0, -5),    //相当于CSS精灵
				imageOffset: new BMap.Size(0, 0)    //图片的偏移量。为了是图片底部中心对准坐标点。
			  });
			 var mk = new BMap.Marker(r.point,{icon:myIcon});
			
			//var mk = new BMap.Marker(r.point);
			map.addOverlay(mk);
			map.panTo(r.point);
		
			map.centerAndZoom(point, 15);
		}
		else {
			alert('failed'+this.getStatus());
		}        
	},{enableHighAccuracy: true})
	
}

getBoundary();
function getBoundary(){       
	var bdary = new BMap.Boundary();
	bdary.get("驻马店市正阳县", function(rs){       //获取行政区域
	//	map.clearOverlays();        //清除地图覆盖物       
		var count = rs.boundaries.length; //行政区域的点有多少个
		if (count === 0) {
			alert('未能获取当前输入行政区域');
			return ;
		}
      	var pointArray = [];
		for (var i = 0; i < count; i++) {
			var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 5,strokeStyle:"dashed", strokeColor: "#ff0000",fillColor:"#FFFFFF",fillOpacity:0.3}); //建立多边形覆盖物
			map.addOverlay(ply);  //添加覆盖物
			pointArray = pointArray.concat(ply.getPath());
		}    
		map.setViewport(pointArray);    //调整视野  
		//addlabel();               
	});   
}