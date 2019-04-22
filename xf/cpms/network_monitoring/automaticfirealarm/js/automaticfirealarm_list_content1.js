 	//查询处理=======================
	$("#btn_search").bind("click", function(){
		search();
	});
		search();
		function search(){
		var params="";
		params="loginName="+manageuseraccount;
		if(params!="")params+="&";
		params+="uri=auto_fire_alarms/fireAlarm";
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
	//   $("#tbody_content").parent().after(JSON.stringify(resultobj));
		var success=resultobj.success;
		var code=resultobj.code;
		var content="";
		if(success&&data!=null){
			var data=resultobj.data;
			for(j=0;j<data.length;j++){
				var id=data[j]["id"];
				var eId=data[j]["eid"];
				var tId=data[j]["tId"];
				content+="<tr align='center'>";
				content+="<td>"+ClearTrim(data[j]["ctime"])+"</td>";
				content+="<td>"+ClearTrim(data[j]["type"])+"</td>";
				content+="<td>"+ClearTrim(data[j]["buildName"])+"</td>";
				content+="<td>"+ClearTrim(data[j]["partName"])+"</td>";
				content+="<td>"+ClearTrim(data[j]["deviceName"])+"</td>";
				content+="<td>"+fnChangeName(data[j]["error"],error_jsarray)+"</td>";
				content+="<td>"+fnChangeName(data[j]["state"],state_jsarray)+"</td>";
		 
				content+="<td class=\"tc\">";
				content+="<a class=\"hmui-btn-primary\" href=\"automaticfirealarm_list_content1_detail.php?id="+id+"&eId="+eId+"&tId="+id+"\"></a>";
				content+="</td>";
				content+="</tr>";

			}
			if(data.length==0){
				content+="<tr>";
				content+="<td colspan=8 align='center'>";
				content+="没有查询到数据";
				content+="</td>";
				content+="</tr>";

			}
		}else{
			var message=resultobj.message;
			content+="<tr>";
			content+="<td colspan=8 align='center'>";
			content+="错误码："+code+message;
			content+="</td>";
			content+="</tr>";
		}                                                      
		return content;  
		
	}
