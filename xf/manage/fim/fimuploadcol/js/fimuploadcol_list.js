
search();
function search(){
	$params=null;
	$url="fimUploadColAction.php?action=list&m="+m;
	jQuery.post($url,$params,function(responseText){
	     var ds=eval("("+responseText+")"); 
	     var content="";                                                                 
		 if(ds.totalProperty>0){                                                             
			for(j=0;j<ds.root.length;j++){                                                     
				  var key=ds.root[j]["UPLOADCOLKEY"]                                                 
					content+="<tr>";                                                                 
					content+="<td align='center'>"+(j+1)+"</td>";                                                                                                
					content+="<td>"+ds.root[j]["UPLOADCOLKEY"]+"</td>";                               
					content+="<td>"+ds.root[j]["TABLENAME"]+"</td>";                               
					content+="<td>"+ds.root[j]["UPLOADCOL"]+"</td>";                               
					content+="<td>"+ds.root[j]["ALLOWFILETYPE"]+"</td>";                               
					content+="<td>"+ds.root[j]["VIRTUALSAVEPATH"]+"</td>";                               
					content+="<td>"+ds.root[j]["DESCRIPTION"]+"</td>";                               
					//content+="<td>"+ds.root[j]["README"]+"</td>";                               
					//content+="<td>"+ds.root[j]["FILEMAXLENTH"]+"</td>";                               
					//content+="<td>"+ds.root[j]["FILENUM"]+"</td>";                               
					content+="</tr>";                                                                             
			}                                                                                  
		}                                                                                    
		 $("#tbody_content").empty().append(content);  
	     
})
}
                                                          