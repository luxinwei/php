$(document).ready(function(){  
     var chart = document.getElementById("pie_part");  
     var echart = echarts.init(chart);  
     var option = {
    title : {
        text: '不同品牌系统报警统计',
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
        data:['天广','中消','海湾']
    },

           

    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'天广'},
                {value:310, name:'中消'},
                {value:234, name:'海湾'},
                
            ]
        }
    ]
};
                      
       
    // echart.setOption(option);    

 });  

