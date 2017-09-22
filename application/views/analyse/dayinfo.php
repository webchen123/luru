<div class="admin bouncein">
    <div class="panel admin-panel">
        <div class="margin-top"  id="container" style="height:800px;width: 100%;"></div>
    </div>
</div>
<script>
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var dataAxis = [];
    var days= <?=$days?>;
    for(var j=1;j<=days;j++){
        var s=j+'号';
        dataAxis.push(s)
    }
    var month= '<?php echo $year.'年'.$month; ?>';//获取几月分
    //存储数据每个月每一天的数据获取存放到data
    var data = [<?=$data;?>];
    var yMax = 200;   //左侧最大值
    var dataShadow = [];
    for (var i = 0; i < data.length; i++) {
        dataShadow.push(yMax);
    }
    option = {
        title: {
            text: month+'月份信息量分析',
            left:'center',
            subtext: 'Information analysis'
        },
        xAxis: {
            data: dataAxis,
            axisLabel: {
                textStyle: {
                    color: '#000'
                }
            },
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            z: 10
        },
        yAxis: {
            axisLine: {
                show: false
            },
            axisTick: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999'
                }
            }
        },
        legend: {
            data: ['信息量'],
            left:'right',
            textStyle:{
                color:'#fff'
            },
        },
        label: {
            normal: {
                show: true,
                position: 'top',
                textStyle: {
                    color: 'rgba(0, 0, 0, 0.7)'
                }
            }
        },
        tooltip : {
            trigger: 'axis',
            // formatter: "{a} <br/>{b} : {c}",
            // axisPointer: {      //坐标轴
            //     type: 'cross',  //十字虚线
            //     label: {
            //         backgroundColor: '#283b56'
            //     }
            // }
        },
        dataZoom: [
            {
                type: 'inside'
            }
        ],
        series: [
            { // For shadow
                name:"信息量",
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: 'rgba(0,0,0,0.07)'
                    }
                },
                barGap:'-100%',
                barCategoryGap:'40%',
                data: dataShadow,
                animation: true
            },
            {
                name:"信息量",
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#83bff6'},
                                    {offset: 0.5, color: '#188df0'},
                                    {offset: 1, color: '#188df0'}
                                ]
                        )
                    },
                    emphasis: {
                        color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#2378f7'},
                                    {offset: 0.7, color: '#2378f7'},
                                    {offset: 1, color: '#83bff6'}
                                ]
                        )
                    }
                },
                data:data
            }
        ]
    };
    //使用刚指定的配置项和数据显示图表。
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
    //单击时启用数据缩放
    var zoomSize = 6;
    myChart.on('click', function (params) {
        console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
        myChart.dispatchAction({
            type: 'dataZoom',
            startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
            endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
        });
    });

</script>