 $("#btn_history").bind("click", function(){window.location.href="filecode_list.php"});

//查询信息==========================================
    initDetail();
    function initDetail(){
        var params={uri:"common_senses/"+id};
        var url=rootPath+"/com/base/InterfaceGetAction.php";
        $.post(url,params,function(responseText){
           //  $("#detail").parent().after(responseText);
            var resultobj=eval("("+responseText+")");
            var success=resultobj.success;
            var code=resultobj.code;
            var content="";
            if(success){
                $("#codename").html(resultobj["data"]["name"]);
                $("#fireLawCode").html(fnChangeName(resultobj["data"]["fireLawCode"],fireLawCode_jsarry));
                $("#promulgateOffice").html(resultobj["data"]["promulgateOffice"]);
                $("#approveOffice").html(resultobj["data"]["approveOffice"]);
                $("#promulgateNo").html(resultobj["data"]["promupromulgateNolgateOffice"]);
                
     		 	var createTime=timeFormat
(resultobj["data"]["createTime"]);
     		 	createTime=createTime.substring(0,10);
     		 	var implementDate=resultobj["data"]["implementDate"];
     		 	if(implementDate!=null){
     		 	implementDate=timeFormat
(implementDate);
     		 	implementDate=implementDate.substring(0,10);
     		 	}
                $("#createTime").html(createTime);
                $("#implementDate").html(implementDate);
                 $("#createUser").html(resultobj["data"]["createUser"]);
                 $("#content").html(resultobj["data"]["content"]);
            }else{
                var message=resultobj.message;
                alert("错误码："+code+message);
            }
        })
    }
    function timeFormat
(timestamp) {
        var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + '';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return Y+M+D+h+m+s;
    }