$(document).ready(function(){  
     var chart = document.getElementById("pie_part");  
     var echart = echarts.init(chart);  
     var option = {
    title : {
        text: '部件状态',
        textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600'},
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },

    /*legend: {
        orient : 'vertical',
        x : 'left',
        data:['离线','故障','在线']
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
    },*/
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'离线'},
                {value:310, name:'故障'},
                {value:234, name:'在线'},
                
            ]
        }
    ]
};
                      
       
     echart.setOption(option);    

 });  

