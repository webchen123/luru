<div class="admin bouncein"><div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <li class="w80">
                <span>从</span>
                <input type="date" class="input w25" id="starTime" value="<?=$start?>"style="display: inline-block" />
                <span>到</span>
                <input type="date" class="input w25" id="endTime" value="<?=$end?>"style="display: inline-block">
            </li>
        </ul>
    </div>
    <div id="container" style="height:800px;width: 100%;"></div>
</div>
    <script>
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var dataAll = [<?=$majorvalue?>];  //专业柱状图数量
        var yAxisData = [<?=$majorkey?>];
        var monthdata = <?=$monthjson?>;
        var jobdata = <?=$jobjson?>;
        var option = {
            backgroundColor: '#0f375f',
            title: [{
                text: "学制占比",
                x: '2%',
                y: '1%',
                textStyle: {
                    color: "#fff",
                    fontSize: "14"
                }
            }, {
                text: "专业柱状图",
                x: '40%',
                y: '1%',
                textStyle: {
                    color: "#fff",
                    fontSize: "14"
                }
            }, {
                text: "职业占比",
                x: '2%',
                y: '50%',
                textStyle: {
                    color: "#fff",
                    fontSize: "14"
                }
            }],
            toolbox: {//右边功能按钮-----------------------------------------
                trigger: 'axis',
                show: true,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            grid: [{
                x: '50%',
                y: '7%',
                width: '45%',
                height: '90%'
            }],
//            tooltip: {
//                formatter: '{b} ({c})'
//            },
            xAxis: [{
                gridIndex: 0,
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: false
                }
            }],
            yAxis: [{
                gridIndex: 0,
                interval: 0,
                data: yAxisData.reverse(),
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: true
                },
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: "#6173a3"
                    }
                }
            }],
            series: [{
                name: '学制',
                type: 'pie',
                radius: '30%',
                center: ['22%', '25%'],
                color: ['#86c9f4', '#4da8ec', '#3a91d2', '#005fa6', '#315f97','#3a91d2'],
                data: monthdata,
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                itemStyle: {
                    normal: {
                        label: {
                            show: true,
                            formatter: '{b} \n ({d}%)',
                            textStyle: {
                                color: '#B1B9D3'
                            }
                        }
                    }
                }
            }, {
                name: '职业',
                type: 'pie',
                radius: '30%',
                center: ['22%', '75%'],
                color: ['#86c9f4', '#4da8ec', '#3a91d2', '#005fa6', '#315f97'],
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data: jobdata,
                itemStyle: {
                    normal: {
                        label: {
                            show: true,
                            formatter: '{b} \n ({d}%)',
                            textStyle: {
                                color: '#B1B9D3'
                            }
                        }
                    }
                }
            }, {
                name: '专业',
                type: 'bar',
                xAxisIndex: 0,
                yAxisIndex: 0,
                barWidth: '45%',
                itemStyle: {
                    normal: {
                        color: '#86c9f4'
                    }
                },
                label: {
                    normal: {
                        show: true,
                        position: "right",
                        textStyle: {
                            color: "#9EA7C4"
                        }
                    }
                },
                data: dataAll.sort()
            }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
         $(function(){
            $('#endTime,#starTime').change(function(){
                var starTime = $("#starTime").val();
                var endTime = $("#endTime").val();
                if (starTime == "" || starTime == null) {
                    alert("请选择开始时间！");
                    return false;
                }
                if (endTime == "" || endTime == null) {
                    alert("请选择结束时间！");
                    return false;
                }
                var startNum = parseInt(starTime.replace(/-/g, ''), 10);
                var endNum = parseInt(endTime.replace(/-/g, ''), 10);
                if (startNum > endNum) {
                    alert("结束时间不能在开始时间之前！");
                    return false;
                }
                get_content('/analyse/majorinfo?start='+starTime+'&end='+endTime);
            })
        })
    </script>
</div>