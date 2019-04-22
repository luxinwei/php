$("#btn_history").bind("click", function(){window.location.href="firedepartment_detail.php?id="+id;});
$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//查询信息==========================================
initDetail();
function initDetail(){

    var params={uri:"fire_fighting_deps/"+id};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
        ////$("#detail").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        if(success){
            $("#firemanagename").val(resultobj["data"]["name"]);
            $("#areaId").val(resultobj["data"]["areaId"]);
            $("#address").val(resultobj["data"]["address"]);
            $("#position").val(resultobj["data"]["position"]);
            $("#telephone").val(resultobj["data"]["telephone"]);
            $("#liaisonOfficer").val(resultobj["data"]["liaisonOfficer"]);
            $("#liaisonOfficerPhone").val(resultobj["data"]["liaisonOfficerPhone"]);
            $("#fireServiceCode").val(resultobj["data"]["fireServiceCode"]);
            $("#precinct").val(resultobj["data"]["precinct"]);
            $("#parentCenter").val(resultobj["data"]["parentCenter"]);
         }else{
            var message=resultobj.message;
            alert("错误码："+code+message);
        }
    })
};
//地图查看==========================================
selectData({activeId:"areaId",width:600,height:600,url:"select_area_list.php",btntitle:"选择区域"});

$("#btn_map").bind("click", function(){
    var usercode          = $("#usercode").val();
    var tourl="unit_map_gaode.php?id="+id;
    var iWidth=1000;
    var iHeight=800;
    var iTop = (window.screen.availHeight-30-iHeight)/2;
    var iLeft = (window.screen.availWidth-10-iWidth)/2;
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();


});
$("#btn_save").bind("click", function(){
	
    var firemanagename            =$("#firemanagename").val();
    var areaId                    = $("#areaId").attr("areaIdValue");
    var address                   = $("#address").val();
    var position                  = $("#position").val();
    var telephone                 = $("#telephone").val();
    var liaisonOfficer            = $("#liaisonOfficer").val();
    var liaisonOfficerPhone       = $("#liaisonOfficerPhone").val();
    var fireServiceCode           = $("#fireServiceCode").val();
    var precinct                  = $("#precinct").val();
    var parentCenter              = $("#parentCenter").val();

    if(!Mibile_Validation.notEmpty(firemanagename,"消防部门名称不能为空"))return;
    if(!Mibile_Validation.notEmpty(areaId,"所属区域不能为空"))return;
    if(!Mibile_Validation.notEmpty(address,"部门祥址"))return;
    if(!Mibile_Validation.notEmpty(position,"地图祥址"))return;
    if(!Mibile_Validation.checkTelMobile(telephone,0,"联系电话格式不正确"))return;
    if(!Mibile_Validation.notEmpty(liaisonOfficer,"部门负责人姓名不能为空"))return;
    if(!Mibile_Validation.notEmpty(liaisonOfficerPhone,"部门负责人电话不能为空"))return;
    if(!Mibile_Validation.notEmpty(precinct,"部门级别不能为空"))return;
    if(!Mibile_Validation.notEmpty(parentCenter,"上级单位名称不能为空"))return;


    var obj=new Object();
    obj.id                       =id;
    obj.name                     = firemanagename;
    obj.areaId                   = areaId;
    obj.address                  = address;
    obj.position                 = position;
  //  obj.telephone                = telephone;
    obj.liaisonOfficer           = liaisonOfficer;
    obj.liaisonOfficerPhone      = liaisonOfficerPhone;
    obj.fireServiceCode          = fireServiceCode;
    obj.precinct                 = precinct;
   // obj.parentCenter             =parentCenter;
    var str = JSON.stringify(obj);
 
    var params={uri:"fire_fighting_deps",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
    $.post(url,params,function(responseText){
 
        //////$("#detail").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        if(success){
            alert("成功");
            window.location.href="firedepartment_detail.php?id="+id;
        }else{
            var message=resultobj.message;
            alert("错误码："+code+message);
        }
    })
})
