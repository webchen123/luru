<div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <li>
                <span>日期晒选：</span>
                <input type="date" class="input" id="starTime" style="display: inline-block;width: 38%" />
                <span>到</span>
                <input type="date" class="input" id="endTime" style="display: inline-block;width: 38%">
            </li>
            <li>
                <span>校区选择：</span>
                <select class="button" id="visitState" name="type" style="display: inline-block">
                <?php 
                    if($_SESSION['bfdyt_role']==1){
                        echo '<option value="'.$_SESSION['bfdyt_id'].'" selected="selected">--'.$_SESSION['bfdyt_name'].'--</option>';
                    }else{
                        echo '<option value="0">--全部--</option>';
                        foreach ($xqlist as $k => $v) {
                            echo '<option value="'.$v['bfdyt_id'].'">'.$v['bfdyt_name'].'</option>';
                        }
                    }
                ?>
                </select>
            </li>
            <li><submit class="button border-dot icon-plus-square-o"  id="getexcel" style="cursor:pointer"> 导出 </li>
        </ul>
    </div>
    <script type="text/javascript">
    $('#getexcel').click(function(){
        var starTime = $('#starTime').val();
        var endTime = $('#endTime').val();
        var type = $(visitState).val();
        if(!starTime||!endTime){
            alert('请选择数据日期范围');
        }else{
            var href="/analyse/dogetexcel?starTime="+starTime+'&endTime='+endTime+'&type='+type;
            window.open(href);
        }
    })
    </script>
    <!-- <table  class="table table-hover text-center" id="table">
        <thead>
        <tr>
            <th width="7%">资讯日期</th>
            <th width="6%">网聊老师</th>
            <th width="5%">回访状态</th>
            <th width="5%">咨询工具</th>
            <th width="5%">学生姓名</th>
            <th width="5%">性别</th>
            <th width="4%">年龄</th>
            <th width="6%">电话号码</th>
            <th width="6%">QQ/微信</th>
            <th width="5%">星级</th>
            <th width="6%">回访时间</th>
            <th width="6%">预计到校时间</th>
            <th width="6%">咨询专业</th>
            <th width="7%">省市</th>
        </tr>
        </thead>
        <tbody id="goods3">
        <tr>
            <td>2017/8/15</td>
            <td>薛莲</td>
            <td>回访通话</td>
            <td>商桥</td>
            <td>王建民</td>
            <td>男</td>
            <td>25</td>
            <td>15205811551</td>
            <td>37451</td>
            <td>1星级</td>
            <td>2017-9-12</td>
            <td>2017-9-14</td>
            <td>金牌大厨</td>
            <td>四川省攀枝花是</td>
        </tr>
        <tr class="yzj">
            <td>2017/8/15</td>
            <td>薛莲</td>
            <td>回访通话</td>
            <td>商桥</td>
            <td>王建民</td>
            <td>男</td>
            <td>25</td>
            <td>15205811551</td>
            <td>37451</td>
            <td>1星级</td>
            <td>2017-9-12</td>
            <td>2017-9-14</td>
            <td>金牌大厨</td>
            <td>四川省攀枝花是</td>
        </tr>
        <tr class="lack_bg">
            <td>2017/8/15</td>
            <td>薛莲</td>
            <td>回访通话</td>
            <td>商桥</td>
            <td>王建民</td>
            <td>男</td>
            <td>25</td>
            <td>15205811551</td>
            <td>37451</td>
            <td>1星级</td>
            <td>2017-9-12</td>
            <td></td>
            <td>金牌大厨</td>
            <td>四川省攀枝花是</td>
        </tr>
        </tbody>
    </table>
    <div class="padding border-bottom">
        <div style="margin: 0 auto;text-align: center;padding-top:60px;">
            <a href="javascript:;" class="button border-main"> 第(<span id="page">1</span>)页</a>
            <a href="javascript:;" class="button border-main" id="Previous"> 上一页</a>
            <a href="javascript:;" class="button border-main" id="next"> 下一页</a>
            <a href="javascript:;" class="button  border-main"> 共(<span id="pagenum">1</span>)页</a>
        </div>
    </div> -->
</div>