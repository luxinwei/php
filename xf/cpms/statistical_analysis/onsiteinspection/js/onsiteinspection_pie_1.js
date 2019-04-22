$(document).ready(function(){  
     var chart = document.getElementById("pie_1");  
     var echart = echarts.init(chart);  
     var option = {
    title : {
        text: '报警统计',
        textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',},
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:['误报','报警']
    },
    toolbox: {
        show : true,
        feature : {
            
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'left',
                        max: 1548
                    }
                }
            },
           
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'误报'},
                {value:310, name:'报警'},
               
                
            ]
        }
    ]
};
                      
       
     echart.setOption(option);    

 });  

