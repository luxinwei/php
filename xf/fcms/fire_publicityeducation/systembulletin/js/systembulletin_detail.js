 $("#btn_history").bind("click", function(){window.location.href="systembulletin_list.php"});
 $("#btn_edit").bind("click", function(){window.location.href="systembulletin_update.php?id="+id});

//查询信息==========================================
  initDetail();
  function initDetail(){
      var params={uri:"system_notices/"+id};
      var url=rootPath+"/com/base/InterfaceGetAction.php";
      $.post(url,params,function(responseText){
          ////$("#detail").parent().after(responseText);
          var resultobj=eval("("+responseText+")");
          var success=resultobj.success;
          var code=resultobj.code;
          var content="";
          if(success){
              $("#content").html(resultobj["data"]["content"]);
   			 $("#bulletinAreaCode").html(resultobj["data"]["bulletinAreaCode"]);

              $("#scopeValue").html(resultobj["data"]["scopeValue"]);
              $("#dataStateCode").html(resultobj["data"]["dataStateCode"]);
              $("#createUser").html(resultobj["data"]["createUser"]);
   		 	
              var createTime=timestampToTime(resultobj["data"]["createTime"]);
              createTime=createTime.substring(0,10);
              $("#createTime").html(createTime);
          }else{
              var message=resultobj.message;
              alert("错误码："+code+message);
          }
      })
  }
  function timestampToTime(timestamp) {
	    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
	    Y = date.getFullYear() + '-';
	    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	    D = date.getDate() + '';
	    h = date.getHours() + ':';
	    m = date.getMinutes() + ':';
	    s = date.getSeconds();
	    return Y+M+D+h+m+s;
	}
  
  