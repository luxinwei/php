 
$("#btn_search").bind("click", function(){
	
	applySearch();
	search();
});

$("#appCode").change(function(){
	 
	search()
	
})
applySearch();
search();
function search(){
	var params="";
	var appCode=$("#appCode").val();
	var name=$("#name").val();
	if(appCode!=0){params+="appCode="+appCode;params+="&";};
	if(name!=""){params+="&name="+name;params+="&";};
 	params+="uri=roles";
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	gridpage({url:url
				,param:params			                                                       
				,bodyid:"tbody_content"                                                                  
				,pagenavid:"pageNav"                                                                     
				,single:false  
				,showType:1
				,length:10
				,store:processData                                                                                 
	});         
}
function processData(resultobj){
	// $("#pageNav").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	 var success=resultobj.success;
     var code=resultobj.code;
     var content="";
     if(success){
         var data=resultobj.data;
         for(j=0;j<data.length;j++){
             var id=data[j]["id"];
             content+="<tr align=\'center\'>";
             content+="<td align='center'>";
             content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";
             content+="</td>";
             content+="<td>"+data[j]["id"]+"</td>";
             content+="<td>"+data[j]["name"]+"</td>";
             content+="<td>"+data[j]["description"]+"</td>";
             content+="<td>"+data[j]["appCode"]+"</td>";
            
             content+="<td >";
             content+="<a class=\"hmui-btn-primary\" href=\"rolemanagement_detail.php?id="+id+"\"></a>";
             content+="</td>";
             content+="</tr>";

         }
         if(data.length==0){
             content+="<tr>";
             content+="<td colspan=6 align='center'>";
             content+="没有查询到数据";
             content+="</td>";
             content+="</tr>";

         }

     }else{
         var message=resultobj.message;
         content+="<tr>";
         content+="<td colspan=6 align='center'>";
         content+="错误码："+code+message;
         content+="</td>";
         content+="</tr>";
     }                                                               
	return content;  
	
}

//==========================================================================================================================================


 
function applySearch(){
    //var params={uri:"owner_departments"};
    //var params={uri:"owner_departments?params={'pageSize':'1','currentPage':'5'}"};
    var params={uri:"system_menus"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
       // //$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        content+="<option value=\"0\" selected=\"selected\">请选择应用</option>"
        if(success){
            var data=resultobj.data;
            for(j=0;j<data.length;j++){
                var id=data[j]["id"];
                content+="<option value='"+data[j]["id"]+"'>"+data[j]["appCode"]+"</option>";
             

            }
            if(data.length==0){
             alert("没有查询到数据");

            }

        }else{
            var message=resultobj.message;
          alert("错误码："+code+message);
        }
        $("#appCode").empty().append(content);  //列表注入位置
    })
}


//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){ 
	var tourl="rolemanagement_build.php";  
	window.location.href=tourl;
});
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="rolemanagement_updata.php?id="+key;	 	 
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row<1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"roles/"+id};
		var url=rootPath+"/com/base/InterfaceDeleteAction.php";
		
		 if(row.row>1){
 		    	 params={uri:"roles/batch",commitData:row.value};
		 		 url=rootPath+"/com/base/InterfacePostBatchDelAction.php";
		    }
		$.post(url,params,function(responseText){
		     var resultobj=eval("("+responseText+")"); 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		   
		     if(success){
		           alert("成功！");
		           search();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }	     
	    })    	    
});
//导出数据=========================================
$("#btn_xls").bind("click", function(){
		 		var row=checkBoxObj('key');
		if(row.row<1){alert("请选择记录");return false;}
		var ids=row.value;
		var tourl="management_xls.php?ids="+ids;
		window.open(tourl);
});




