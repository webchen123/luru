<!--地域分布-->
<div class="admin bouncein"><div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <li class="w80">
                <span>从</span>
                <input type="date" class="input w25" id="starTime" name="start" value="<?=$start?>"style="display: inline-block" />
                <span>到</span>
                <input type="date" class="input w25" id="endTime" name="end" value="<?=$end?>"style="display: inline-block">
            </li>
        </ul>
    </div>
    <div id="container" style="height:800px;width: 100%;"></div>
</div>
    <script>
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var dataAll = [<?=$agevalue?>];
        var yAxisData = [<?=$agekey?>];
        var datasource = <?php echo $sourcejson?$sourcejson:'""';?>;
        var dataarea = <?php echo $areajson?$areajson:'""';?>;
        for(var i=0;i<dataarea.length;i++){
            dataarea[i].name=(getAreaNamebyID(String(dataarea[i].name))).substr(3);
        }
        var option = {
            backgroundColor: '#0f375f',
            title: [{
                text: "各渠道占比",
                x: '2%',
                y: '1%',
                textStyle: {
                    color: "#fff",
                    fontSize: "14"
                }
            }, {
                text: "年龄柱状图",
                x: '40%',
                y: '1%',
                textStyle: {
                    color: "#fff",
                    fontSize: "14"
                }
            }, {
                text: "地域分布占比",
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
                name: '各渠道占比',
                type: 'pie',
                radius: '30%',
                center: ['22%', '25%'],
                color: ['#86c9f4', '#4da8ec', '#3a91d2', '#005fa6', '#315f97','#5D5F97'],
                data: datasource,
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
                name: '各级别投诉占比',
                type: 'pie',
                radius: '30%',
                center: ['22%', '75%'],
                color: ['#86c9f4', '#4da8ec', '#3a91d2', '#005fa6', '#315f97'],
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data: dataarea,
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
                name: '年龄',
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
                get_content('/analyse/areainfo?start='+starTime+'&end='+endTime);
            })
        })
    </script>
</div>
