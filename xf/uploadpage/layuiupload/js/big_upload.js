layui.use('upload', function(){
	layui.upload({
	    url: "upload.php?uploadparam="+uploadparam //上传接口
	    ,unwrap: false 
	    ,ext: allowType//,ext: 'jpg|png|gif' //那么，就只会支持这三种格式的上传。注意是用|分割。
	    ,before: function(input){
		    //返回的参数item，即为当前的input DOM对象
		   console.log('文件上传中');
		  }
	    ,success: function(res){ //上传成功后的回调
	    	if(res.success==1){
	    		$("#"+containerId, window.parent.document).val(res.virurl);
	    	}else{
	    		alert(res.msg);
	    		//console.log(res.msg)
	    	}
	    	
	    
	    }
});
});