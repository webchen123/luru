	<div class="bouncein">
    <div class="panel admin-panel">
        <div class="padding border-bottom">
            <ul class="search padding-left">
                <li>
                    <select name="years" class="button border-sub" id="years">
                    	<?php 
                    		$now = date('Y');
                    		for($i=$now;$i>=$now-5;$i--){
                    			if($i==$year){
                    				echo '<option class="" value="'.$i.'" selected="selected">'.$i.'年</option>';
                    			}else{
                    				echo '<option class="" value="'.$i.'" >'.$i.'年</option>';
                    			}
                    		}
                    	?>
                    </select>
                </li>
            </ul>
        </div>
        <div class="margin-top" id="container" style="height:800px;width: 100%;"></div>
    </div>
</div>
<script >
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var dataAxis= ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'];
    var data=[<?php echo $data; ?>];
    var yMax = 2000;   //左侧最大值
    var dataShadow = [];
    for (var j = 0; j < dataAxis.length; j++) {
        dataShadow.push(yMax);
    }
    option = {
        title : {
            text:"每月信息量",
            left:'center'
        },
        tooltip : {
            trigger: 'axis'
        },
//        legend: {
//            data:['']
//        },
        toolbox: {
            show : true,
            feature : {
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis:[
            {
                type : 'category',
                data :dataAxis
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'信息量',
                type:'bar',
                data:data,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            }, {
                name:"信息量",
                type: 'bar',
                barGap:'-100%',
                barCategoryGap:'40%',
                animation: true,
                itemStyle: {
                    normal: {
                        color: 'rgba(0,0,0,0.07)'
                    }
                },
                data:dataShadow
            }
        ]
    };
    $(function(){
	    //回去点击年份信息
	    $('#years').change(function(){
	        var year=$(this).val();
	        get_content('/analyse/monthinfo/'+year)
	    });

	    if (option && typeof option === "object") {
	        myChart.setOption(option, true);
	    }
	    //点击跳转对应月份的详细信息
	    myChart.on('click', function (params) {
	        var ins=dataAxis[Math.max(params.dataIndex, 0)];
	        var month=ins.split('月')[0];
	        var year = $('#years').val();
	        get_content('/analyse/dayinfo/'+year+'/'+month);
	    });
    })

</script>
