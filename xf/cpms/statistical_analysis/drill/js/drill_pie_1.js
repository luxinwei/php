$(document).ready(function(){  
     var chart = document.getElementById("pie_1");  
     var echart = echarts.init(chart);  
     var option = {
    title : {
        text: '演练任务监管级别合格率',
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

