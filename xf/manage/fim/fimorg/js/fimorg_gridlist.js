
$("#btn_his").bind("click", function(){window.location.href="fimorg_list.php?&m="+m;  });
$("#btn_find").bind("click", function(){  search()});
search();
function search(){
	var params=decodeURI($("#myform").serialize());
	var url="fimorgAction.php?action=list&m="+m;
gridpage({url:url
			,param:params		                                                       
			,bodyid:"tbody_content"                                                                  
			,pagenavid:"pageNav"                                                                     
			,single:false
			,length:100
			,store:function(ds){                                                                     
			         var content="";                                                                 
					 if(ds.totalProperty>0){                                                             
						for(j=0;j<ds.root.length;j++){                                                     
						    var key=ds.root[j]["ID"] ;
						    var mapx=ClearTrim(ds.root[j]["MAPX"]);
						    var mapy=ClearTrim(ds.root[j]["MAPY"]);
							content+="<tr>";                                                                 
							content+="<td>"+ds.root[j]["ID"]+"</td>";           
							content+="<td>"+ds.root[j]["TITLE"]+"</td>";   
							content+="<td>"+ClearTrim(ds.root[j]["MEMBERNUM"])+"</td>"; 
							content+="<td>"+fnChangeName(ds.root[j]["TYPE"],type_array)+"</td>"; 
							content+="<td>"+fnChangeName(ds.root[j]["ORGKIND"],org_kind_array)+"</td>"; 
							content+="<td>"+ds.root[j]["INTERALORDER"]+"</td>";  
							content+="<td>"+ds.root[j]["INTERAL"]+"</td>";  
							if(mapx==""){
								content+="<td></td>"; 
							}else{
								content+="<td>"+mapx+"*"+mapy+"</td>"; 
							}
							content+="<td onclick=\"setmap('"+key+"')\"><font class=\"hand\" >设置经纬度</font></td>"; 
							content+="</tr>";                                                                
						}                                                                                  
					}                                                                                    
					return content;                                                                      
			 }                                                                                       
	 });                                                                                         
}

$("#btn_xls").bind("click", function(){  

	var params=decodeURI($("#myform").serialize());
	var tourl="fimorg_xls.php?m="+m+"&"+params;
	window.open(tourl);
});
$("#btn_mapview").bind("click", function(){  
	window.location.href="fimorg_map_list.php?m="+m;
	
	
});
function setmap(orgid){
	window.location.href="fimorg_map_edit.php?keyvalue="+orgid+"&m="+m;
}
