	$.ajaxSetup({ 

 	 			async : false 

 	 });
 
         var bgColor = '#E3F7FF';
         var containers = document.getElementsByClassName('chart');
         var v=1;
     	 var params={uri:"water_sources/geValue/"+Id};
         var url=rootPath+"/com/base/InterfaceGetAction.php";
         $.post(url,params,function(responseText){	
                     	////$("#detail").parent().after(responseText);  
                     	var resultobj = eval("(" + responseText + ")");
                     	v= resultobj["data"]["level"];
                     	  
                     	
                     	 
         });
         a=v;
         if(v==null){
        	 v="0";
        	 a="无数据";
         }
              var options = [
               {
                series: [{
                	name: '水位',
                    type: 'liquidFill',
                    data:[{
                    	name:name,
                        value:a
                    },v],
                    label: {
                        normal: {
                            formatter: '{a}\n{b}\nValue: {c}',
                            textStyle: {
                                fontSize: 28
                            }
                        }
                    },
                    radius: '70%',
                    outline: {
                        show: false
                    }
                }]
            }];
            var charts = [];
            for (var i = 0; i < options.length; ++i) {
                var chart = echarts.init(containers[i]);

                if (i > 0) {
                    options[i].series[0].silent = true;
                }
                chart.setOption(options[i]);
                chart.setOption({
                    baseOption: options[i],
                    media: [{
                        query: {
                            maxWidth: 300
                        },
                        option: {
                            series: [{
                                label: {
                                    normal: {
                                        textStyle: {
                                            fontSize: 26
                                        }
                                    }
                                }
                            }]
                        }
                    }]
                });
            }
	
	 
 
            
