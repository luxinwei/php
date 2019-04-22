// JavaScript Document
/*
gostep(0);
function gostep(step){
	$(".flow_step").loadFlowStep(step);
}
*/
jQuery.extend($.fn,{ 
	loadFlowStep:function (step) { 
	var thisObj=$(this);
	var hdObj=$(this).children(".hd").children("ul");
	var bdObj=$(this).children(".bd");
	var maxStep=hdObj.children().length;
    for(var i=0;i<maxStep;i++){
			 if(i==step){
				bdObj.children().eq(i).show();
			 }else{
				bdObj.children().eq(i).hide();
			 }
			 if(i==step){
				 var firstObj=hdObj.children().eq(0);
				 var lastObj =hdObj.children().eq(maxStep-1);
				 var hdCurObj=hdObj.children().eq(i);	
				if(step==0){
					hdObj.children().attr("class","");
					hdCurObj.attr("class","current");
					lastObj.attr("class","last");
				}else if(step==1){
					hdObj.children().attr("class","");
					firstObj.attr("class","current_prev");
					hdCurObj.attr("class","current");
					lastObj.attr("class","last");
				}else if(step==(maxStep-2)){
					var hdPrevObj=hdObj.children().eq(step-1);
				    var hdNexObj=hdObj.children().eq(step+1);
					for(var j=0;j<step-1;j++)hdObj.children().eq(j).attr("class","done");
					hdPrevObj.attr("class","current_prev");
					hdCurObj.attr("class","current");	
					hdNexObj.attr("class","");
					lastObj.attr("class","last");
					
				}else if(step==(maxStep-1)){
					var hdPrevObj=hdObj.children().eq(step-1);
					for(var j=0;j<step-1;j++)hdObj.children().eq(j).attr("class","done");
					 hdPrevObj.attr("class","current_prev");
					 hdCurObj.attr("class","current");	
					 lastObj.css("background-image","none");
				}else{
					var hdPrevObj=hdObj.children().eq(step-1);
				    var hdNexObj=hdObj.children().eq(step+1);
					for(var j=0;j<step-1;j++)hdObj.children().eq(j).attr("class","done");
					hdPrevObj.attr("class","current_prev");
					hdCurObj.attr("class","current");	
					for(var j=(step+1);j<maxStep;j++)hdObj.children().eq(j).attr("class","");
					lastObj.attr("class","last");
				}	
			 }
		}
    } 
})

