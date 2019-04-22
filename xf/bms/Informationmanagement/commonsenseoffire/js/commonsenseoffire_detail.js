$("#btn_history").bind("click", function(){window.location.href="commonsenseoffire_list.php"});

    $("#btn_edit").bind("click", function(){window.location.href="commonsenseoffire_update.php?id="+id;});

//查询信息==========================================
    initDetail();
    function initDetail(){
        var params={uri:"common_senses/"+id};
        var url=rootPath+"/com/base/InterfaceGetAction.php";
        $.post(url,params,function(responseText){
            //////$("#detail").parent().after(responseText);
            var resultobj=eval("("+responseText+")");
            var success=resultobj.success;
            var code=resultobj.code;
            var content="";
            if(success){
                $("#commonname").html(resultobj["data"]["name"]);
                $("#createUser").html(resultobj["data"]["createUser"]);
                $("#content").html(resultobj["data"]["content"]);
            }else{
                var message=resultobj.message;
                alert("错误码："+code+message);
            }
        })
    }