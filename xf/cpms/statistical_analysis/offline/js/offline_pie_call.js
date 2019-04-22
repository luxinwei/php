$(document).ready(function(){
    var chart = document.getElementById("pie_call");
    var echart = echarts.init(chart);
    var option = {
        title : {
            text: '分类系统故障统计',
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
            data:['火灾自动报警系统','消防水源','消火栓灭火系统','自动喷淋灭火系统','防排烟系统','防火门帘系统','智慧用电系统']
        },
        calculable : true,
        series : [
            {
                name:'访问来源',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:335, name:'火灾自动报警系统'},
                    {value:310, name:'消防水源'},
                    {value:305, name:'消火栓灭火系统'},
                    {value:300, name:'自动喷淋灭火系统'},
                    {value:325, name:'防排烟系统'},
                    {value:315, name:'防火门帘系统'},
                    {value:315, name:'智慧用电系统'},

                ]
            }
        ]
    };


//    echart.setOption(option);

});

