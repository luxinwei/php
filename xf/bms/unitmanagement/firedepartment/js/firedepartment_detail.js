$("#btn_history").bind("click", function(){window.location.href="firedepartment_list.php?m="+m;});
$("#btn_edit").bind("click", function(){window.location.href="firedepartment_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){

    var params={uri:"fire_fighting_deps/"+id};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
        //////$("#detail").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        if(success){
            $("#firemanagename").html(resultobj["data"]["name"]);
            $("#areaId").html(resultobj["data"]["areaId"]);
            $("#address").html(resultobj["data"]["address"]);
            $("#telephone").html(resultobj["data"]["telephone"]);
            $("#liaisonOfficer").html(resultobj["data"]["liaisonOfficer"]);
            $("#liaisonOfficerPhone").html(resultobj["data"]["liaisonOfficerPhone"]);
            $("#precinct").html(resultobj["data"]["precinct"]);
            $("#parentCenter").html(resultobj["data"]["parentCenter"]);
            $("#fireServiceCode").html(fnChangeName(resultobj["data"]["fireServiceCode"],fireServiceCode_jsarry));
        }else{
            var message=resultobj.message;
            alert("错误码："+code+message);
        }
    })
}