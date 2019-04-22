 $("#btn_prc").bind("click", function(){
	var tourl="commonsenseoffire_pic.php?";
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params="";
	if(params!="")params+="&";
	params+="uri=fire_fighting_videos";
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
  //$("#pageNav").parent().after(JSON.stringify(resultobj));
	 // var resultobj=eval("("+responseText+")");
	var success=resultobj.success;
	var code=resultobj.code;
	var content="";
	if(success){
		var data=resultobj.data;
		for(j=0;j<data.length;j++){
			var id=data[j]["id"];
 			content+="<tr align='center'>";
			content+="<td align='center'>";
			content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";
			content+="</td>";
			content+="<td>"+data[j]["name"]+"</td>";
			content+="<td>"+data[j]["description"]+"</td>";
			content+="<td>"+data[j]["uploadUser"]+"</td>";
			content+="<td>"+ClearTrim(data[j]["createTime"])+"</td>";
			content+="<td class=\"tc\">";
			content+="<a class=\"hmui-btn-primary\" href=\"firevideo_detail.php?id="+id+"\"></a>";
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

//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){
	var tourl="firevideo_build.php";
	window.location.href=tourl;
});
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="firevideo_update.php?id="+key;
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	var row=checkBoxObj('key');
	//  if(row.row<=0){alert("请选择要删除的信息");return false;}
	if(row.row!=1){alert("请选择一条记录");return false;}
	if(!confirm("确认进行此操作吗?"))return false;
	var id=row.value;
	var params={uri:"fire_fighting_videos/"+id};
	var url=rootPath+"/com/base/InterfaceDeleteAction.php";
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

//=====================================================================