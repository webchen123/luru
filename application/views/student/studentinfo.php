<h3>详细信息：</h3>
<div class="" >
    <div class="float-left w33">
        <p class="userName">姓名：<span dname="<?=$data['bfdyt_name'];?>"><?=$data['bfdyt_name']?></span>
            <a class="margin-left button border-sub icon-plus-square-o" id="reviseName"  style="cursor:pointer"> 修改姓名</a>
        </p>
        <p>性别：<span><?php echo $data['bfdyt_sex']?'男':'女';?></span></p>
        <p>年龄：<span><?=$data['bfdyt_age'];?></span></p>
        <p>职业状况：<span><?=$job[$data['bfdyt_job']]?></span></p>
        <p>学历：<span><?=$edu[$data['bfdyt_edu']]?></span></p>
        <p class="telPhone">
            电话号码：<span><?=$data['bfdyt_phone'];?></span>
            <?php 
                if(!$data['bfdyt_phone']){
                    echo '<a class="margin-left button border-sub icon-plus-square-o" id="addPhone"  style="cursor:pointer"> 添加电话号码</a>';
                }
             ?>
        </p>
        <p class="QQ_W">qq/微信号码：<span><?=$data['bfdyt_qq'];?></span><a class="margin-left button border-sub icon-plus-square-o" id="addQQ"  style="cursor:pointer"> 添加QQ/微信</a></p>
    </div>
    <div class="float-left w33">
        <p>咨询老师：<span ><?=$backuser['bfdyt_name'];?> & <?=$frontuser['bfdyt_name'];?></span></p>
        <p>咨询日期：<span><?=$data['bfdyt_zxdate'];?></span></p>
        <p>回访状态：
            <span class="hf_info">
                <select  id="visitstatus">
                <?php  
                foreach($visitstatus as $k=>$v){
                    if($data['bfdyt_zxstatus']==$k){
                        $select = 'selected="selected"';
                    }else{
                        $select = '';
                    }
                    echo  '<option '.$select.' value="'.$k.'">'.$v.'</option>';
                }
                ?>
                </select>
             </span>
        </p>
        <p>咨询工具：<span><?=$source[$data['bfdyt_source']];?></span></p>
        <p>咨询学制：<span>
            <?php 
            if($data['bfdyt_learnmonth']>0){
            echo $data['bfdyt_learnmonth']<12?$data['bfdyt_learnmonth'].'个月':(floor($data['bfdyt_learnmonth']/12)).'年制';
            }else{
            echo '其他';               
            }
            ?>
            </span>
        </p>
        <p>咨询专业：<span><?=$major[$data['bfdyt_major']];?></span></p>
        <p>来自哪里：<span id="onearea"  pro="<?=$data['bfdyt_pro'];?>" city="<?=$data['bfdyt_city'];?>" county="<?=$data['bfdyt_county'];?>">四川省攀枝花</span></p>
    </div>
    <div class="float-left w33">
        <p class="arrival">预计到校时间：
            <span id="arivetime" atime="<?=$data['bfdyt_arivetime'];?>"><?=$data['bfdyt_arivetime'];?></span>
            <a class="margin-left button border-sub icon-plus-square-o" id="ArrivalTime"  style="cursor:pointer"> 修改到校时间</a>
        </p>
        <p>
            星级：
            <select name="" id="xingji">
                <?php  
                foreach($star as $k=>$v){
                    if($data['bfdyt_star']==$k){
                        $select = 'selected="selected"';
                    }else{
                        $select = '';
                    }
                    echo  '<option '.$select.' value="'.$k.'">'.$v.'</option>';
                }
                ?>
            </select>
        </p>
        <p class="revisit">
            回访时间：<span><br> <?php echo $data['bfdyt_visitime']>0? '1、'.$data['bfdyt_visitime']:'';?></span>
            <a class="margin-left button border-sub icon-plus-square-o" id="RevisitDays"  style="cursor:pointer"> 添加回访时间</a>
        </p>
    </div>
</div>
<div class="clear"></div>
<div class="addbz">
    <div class="w100">
        <div style="color: #09f;font-size: 18px">备注：</div>
        <div class="remark_info w80 padding-top">
            <?php foreach($remark as $k=>$v) {

             ?>
            <div class="remark_module">
                <div class="remark_title">
                <?php 
                    echo date('Y年m月d日 H:i:s',strtotime($v['bfdyt_time']));
                    $week=array(
                        '1'=>'一',
                        '2'=>'二',
                        '3'=>'三',
                        '4'=>'四',
                        '5'=>'五',
                        '6'=>'六',
                        '7'=>'日'
                        );
                    echo '星期'.$week[date('N',strtotime($v['bfdyt_time']))];
                 ?>
                 ，网络咨询 [
                <?php 
                    echo $v['bfdyt_username'];
                 ?>
                 ]录入回访信息。 回访状态：
                <?php 
                    echo $visitstatus[$v['bfdyt_zxstatus']];
                 ?>
                 </div>
                <div class="remark_content">
                    <?php
                        echo $v['bfdyt_content'];
                     ?>
                </div> 
            </div>
            <?php 
            }
            ?>
        </div>
    </div>
    <div>
        <a class="button border-sub icon-plus-square-o" id="addBZ"  style="cursor:pointer"> 添加备注</a>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        //修改姓名
        var usName=true;
            $("#reviseName").click(function(){
                if(usName){
                    $(this).siblings("span").empty();
                    $(this).siblings("span").append("<input type='text' autofocus>");
                    $(this).text("保存");
                    usName=false;
                }else{
                    var name = $(".userName input").val();
                    if(!name){
                        name=$(".userName span").attr('dname');
                    }else{
                        var data = {'name':name};
                        updateinfo(data);
                    }
                    $(".userName span").html(name);
                    $(".userName input").remove();
                    $(this).text("修改姓名");
                    usName=true;
                }
            });
            //修改回访状态
            $('#visitstatus').change(function(){
                var value = $(this).val();
                var data={'zxstatus':value};
                updateinfo(data);
            })
            //星级修改
            $('#xingji').change(function(){
                var value = $(this).val();
                var data = {'star':value};
                updateinfo(data);
            })
            //添加电话
            var phone=true;
            $("#addPhone").click(function(){
                if(phone){
                    $(this).parent().append("<input type='text' autofocus>");
                    $(this).text("保存");
                    phone=false;
                }else {
                    var telphone = $('.telPhone input').val();
                    var regPhone=/^1[3456789]\d{9}/;
                    var value = parseInt(telphone);
                    if(!regPhone.test(value)){
                        alert('电话格式不正确');
                    }else {
                        var data = {'phone':telphone};
                        if(updateinfo(data)){
                            $(this).siblings().html(telphone);
                            $(this).remove();
                        }else{
                            alert('修改失败');
                        }
                    }
                    $(".telPhone input").remove();
                    $(this).text("添加电话号码");
                    phone=true;
                }
            });
            //添加qq/微信
            var qq=true;
            $("#addQQ").click(function(){
                if(qq){
                    $(this).parent().append("<input type='text' autofocus>");
                    $(this).text("保存");
                    qq=false;
                }else {
                    if($('.QQ_W input').val()!="" && $('.QQ_W input').val()!=null){
                        var ptn=$(this).siblings().html()+' / '+$('.QQ_W input').val();
                        $(this).siblings().html(ptn);
                         var nqq = $('.QQ_W input').val();
                         var data={'qq':nqq};
                         updateinfo(data);
                    }
                    $(".QQ_W input").remove();
                    $(this).text("添加QQ/微信");
                    qq=true;
                }
            });
            //备注
            // var tin=true;
            // $("#addBZ").on("click",function(){
            //     if(tin){
            //         $(".addbz").append("<textarea style='width: 60%;height: 200px'></textarea>");
            //         $(this).text("保存");
            //         tin=false;
            //     }else{
            //         var at=$(".addbz textarea").val();
            //         if(at!="" && at!=null){
            //             $(".remark_info").append("<p></p>");
            //             $(".remark_info p:last-child").html($(".addbz textarea").val())
            //             var remark = $(".addbz textarea").val();
            //             var data={'htremark':remark};
            //             updateinfo(data);
            //         }
            //         $(".addbz textarea").remove();
            //         $(this).text("添加备注");
            //         tin=true;
            //     }
            // })
            // var  arri=true;
            var tin=true;
            var index=0;
            $("#addBZ").on("click",function(){
                if(tin){
                    $(".addbz").append("<textarea style='width: 60%;height: 200px'></textarea>");
                    $(this).text("保存");
                    tin=false;
                }else{
                    var at=$(".addbz textarea").val();
                    if(at!="" && at!=null){
                        var userName="<?php echo $_SESSION['bfdyt_name']; ?>";
                        var hfInfo="<?php echo $visitstatus[$data['bfdyt_zxstatus']]; ?>";
                        var zxstatus=$('#visitstatus').val();
                        var infoid=$('#studentinfo').attr('infoid');
                        var remarkCon=at;
                        var info=nd()+" ，网络咨询 ["+userName+"]录入回访信息。 回访状态："+hfInfo;
                        var remarkContent='<div class="remark_module"><div class="remark_title">'+info+'</div> <div class="remark_content">'+remarkCon+'</div> </div>';
                        $(".remark_info").append( remarkContent);
                        $.ajax({
                            url:'/student/addremark',
                            data:{'name':userName,'content':at,'zxstatus':zxstatus,'infoid':infoid},
                            type:'get',
                            success:function(data){
                                if(data==1){
                                    alert('添加成功');
                                }else{
                                    alert('请联系管理员');
                                }
                            }, 
                            error:function(){
                                alert('请联系管理员');
                            }
                        })
                    }
                    $(".addbz textarea").remove();
                    $(this).text("添加备注");
                    tin=true;
                }
            })
            function nd(){
                var date = new Date();
                this.year = date.getFullYear();
                this.month = date.getMonth() + 1;
                this.date = date.getDate();
                this.day = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[date.getDay()];
                this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
                this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
                return  this.year + "年" + this.month + "月" + this.date + "日 " + this.hour + ":" + this.minute + ":" + this.second + " " + this.day;
            }
            //修改到校时间
            $("#ArrivalTime").on("click",function(){
                if(arri){
                    $(this).siblings('span').empty();
                    $(this).siblings("span").append("<input type='date' autofocus>");
                    $(this).text("保存");
                    arri=false;
                }else {
                    var atime = $(".arrival input").val()
                    $(".arrival input").remove();
                    $(this).text("修改时间");
                    arri=true;
                    if(atime){
                        var data={'arivetime':atime};
                        updateinfo(data);
                    }else{
                        atime = $('#arivetime').attr("atime");
                    }
                    $(".arrival span").html(atime);

                }
            })
            //添加回访时间
            var revi=true;
            var i=2;
            $("#RevisitDays").on("click",function(){
                if(revi){
                    $(this).parent().append("<input type='date' autofocus>");
                    $(this).text("保存");
                    revi=false
                }else {
                    if($('.revisit input').val()!="" && $('.revisit input').val()!=null){
                        var ptn=$(this).siblings().html()+'<br>'+(i++)+'、'+$('.revisit input').val();
                        $(this).siblings().html(ptn);
                        var vtime = $('.revisit input').val()
                        var data={'visitime':vtime};
                        updateinfo(data);
                    }
                    $(".revisit input").remove();
                    $(this).text("添加回访时间");
                    revi=true;
                }
            })
            //信息转接
            $('#addPart').click(function(){
                data={'zystatus':'1'};
                var res=updateinfo(data);
                if(res){
                    $('.checking').remove();
                }
            })
            //信息修改ajax
            function updateinfo(data){
                var id=$('#studentinfo').attr('infoid');
                var res = false;
                if(!id){
                    alert('请选点击学生信息选择要修改的学生');
                    return;
                }
                data.id = id;
                $.ajax({
                    url:'/student/update/',
                    data:data,
                    type:'post',
                    dataType:'json',
                    async:false,
                    success:function(data){
                        if(data['code']=='1'){
                            alert('修改成功');
                            res = true;
                        }else{
                            alert(data['mesg']);
                            res = false;
                        }
                    },
                    error:function(){
                        alert('修改失败，请联系管理员')
                    }
                })
                return res;
            }
            //显示地区
            $('#onearea').each(function(){
                var pro = $(this).attr('pro');
                var city = $(this).attr('city');
                var areaname = getAreaNamebyID(city);
                $(this).text(areaname);           
            })
    })
</script>