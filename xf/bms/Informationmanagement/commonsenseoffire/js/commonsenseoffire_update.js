$("#btn_history").bind("click", function(){window.location.href="commonsenseoffire_detail.php?id="+id;});

$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	}); 
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
                $("#commonname").val(resultobj["data"]["name"]);
                $("#createUser").val(resultobj["data"]["createUser"]);
                $("#content").html(resultobj["data"]["content"]);
            }else{
                var message=resultobj.message;
                alert("错误码："+code+message);
            }
        })
    };

//保存信息
$("#btn_save").bind("click", function(){
    //验证信息
    var commonname              =$("#commonname").val();
    var createUser              = $("#createUser").val();
    var content                 = $("#content").val();
    if(!Mibile_Validation.notEmpty(commonname,"常识名称不能为空"))return;
    if(!Mibile_Validation.notEmpty(createUser,"输入人姓名不能为空"))return;
    if(!Mibile_Validation.notEmpty(content,"文章内容不能为空"))return;

    //保存信息
    var obj=new Object();
    obj.name                     = commonname;
    obj.createUser               = createUser;
    obj.content                  = content;
    var str = JSON.stringify(obj);
    var params={uri:"common_senses",commitData:str};
    var url=rootPath+"/com/base/InterfacePostAction.php";
    $.post(url,params,function(responseText){
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        if(success){
            alert("成功");
            window.location.href="commonsenseoffire_detail.php?id="+id

        }else{
            var message=resultobj.message;
            alert("错误码："+code+message);
        }
    })
});
