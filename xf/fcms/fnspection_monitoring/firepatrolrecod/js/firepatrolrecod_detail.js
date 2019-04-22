 $("#btn_history").bind("click", function(){window.location.href="firepatrolrecod_list.php"});

//查询信息==========================================
  initDetail();
  function initDetail(){
      var params={uri:"patrol_records/"+id};
      var url=rootPath+"/com/base/InterfaceGetAction.php";
      $.post(url,params,function(responseText){
         // //$("#detail").parent().after(responseText);
          var resultobj=eval("("+responseText+")");
          var success=resultobj.success;
          var code=resultobj.code;
          var content="";
          if(success){
 	    	 $("#patrolTypeCode").html(fnChangeName(resultobj["data"]["patrolTypeCode"],patrolTypeCode_jsarry));
 	    	 $("#checkResultCode").html(fnChangeName(resultobj["data"]["checkResultCode"],checkResultCode_jsarry));

              $("#depName").html(resultobj["data"]["depName"]);
              $("#content").html(resultobj["data"]["content"]);
              $("#patrolPointId").html(resultobj["data"]["patrolPointId"]);
               $("#patrolName").html(resultobj["data"]["patrolName"]);
              $("#custodian").html(resultobj["data"]["custodian"]);
               $("#content").html(resultobj["data"]["content"]);
              $("#patrolTime").html(resultobj["data"]["patrolTime"]);
          }else{
              var message=resultobj.message;
              alert("错误码："+code+message);
          }
      })
  }