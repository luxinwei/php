$(document).ready(function(){
	var chart = document.getElementById("bar");
	var echart = echarts.init(chart);
	var   option = {
		title : {
			text: '所有故障时长统计',
			textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',},
		},
		tooltip : {
			trigger: 'axis'
		},
		calculable : true,
		grid: {y: 70, y2:30, x2:20},
		xAxis : [
			{
				type : 'category',
				data : ['火灾自动报警系统','消防水源','消火栓灭火系统','防火门帘系统','智慧用电系统']
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : ['火灾自动报警系统','消防水源','消火栓灭火系统','防火门帘系统','智慧用电系统']
			}
		],
		yAxis : [
			{
				type : 'value',
				axisLabel:{formatter:'{value} ms'}
			}
		],
		series : [

			{
				name:'ECharts2 - 20w数据',
				type:'bar',
				itemStyle: {normal: {color:'rgba(252,206,16,1)', label:{show:true,textStyle:{color:'#E87C25'}}}},
				data:[906,911,908,778,0],
				barWidth:50
			},

			{
				name:'ECharts1 - 20w数据',
				type:'bar',
				xAxisIndex:1,
				itemStyle: {normal: {color:'rgba(252,206,16,0.5)', label:{show:true,formatter:function(p){return p.value > 0 ? (p.value +'+'):'';}}}},
				data:[3000,3000,2817,3000,0],
				barWidth:50
			}
		]
	};




	//echart.setOption(option);

});

