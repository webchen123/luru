<h3>详细信息：</h3>
<div class="" >
    <div class="float-left w33">
        <p class="userName">姓名：<span dname="<?=$data['bfdyt_name'];?>"><?=$data['bfdyt_name']?></span><a class="margin-left button border-sub icon-plus-square-o" id="reviseName"  style="cursor:pointer"> 修改姓名</a></p>
        <p>性别：<span><?php echo $data['bfdyt_sex']?'男':'女';?></span></p>
        <p>年龄：<span><?=$data['bfdyt_age'];?></span></p>
        <p>职业状况：<span><?=$job[$data['bfdyt_job']]?></span></p>
        <p>学历：<span><?=$edu[$data['bfdyt_edu']]?></span></p>
        <p class="telPhone">
            电话号码：<span><?=$data['bfdyt_phone'];?></span><a class="margin-left button border-sub icon-plus-square-o" id="addPhone"  style="cursor:pointer"> 添加电话号码</a>
        </p>
        <p class="QQ_W">qq/微信号码：<span><?=$data['bfdyt_qq'];?></span><a class="margin-left button border-sub icon-plus-square-o" id="addQQ"  style="cursor:pointer"> 添加QQ/微信</a></p>
    </div>
    <div class="float-left w33">
        <p>咨询老师：<span ><?=$backuser['bfdyt_name'];?></span></p>
        <p>咨询日期：<span><?=$data['bfdyt_zxdate'];?></span></p>
        <p>咨询时间：<span><?=$data['bfdyt_zxtime'];?>点</span></p>
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
        <p>来自哪里：<span id="onearea"  pro="<?=$data['bfdyt_pro'];?>" city="<?=$data['bfdyt_city'];?>" ></span></p>
    </div>
    <div class="float-left w33">
        <p>咨询状态：<span><?php echo $data['bfdyt_zxstatus']=='1'?'已到校':'未到校';?></span></p>
        <p class="arrival">预计到校时间：
            <span id="arivetime" atime="<?=$data['bfdyt_arivetime'];?>"><?=$data['bfdyt_arivetime'];?></span>
            <a class="margin-left button border-sub icon-plus-square-o" id="ArrivalTime"  style="cursor:pointer"> 修改到校时间</a>
        </p>
        <p>星级：<span><?=$data['bfdyt_star'];?>星级</span></p>
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
            <p><?=$data['bfdyt_htremark']?></p>
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
            //添加电话
            var phone=true;
            $("#addPhone").click(function(){
                if(phone){
                    $(this).parent().append("<input type='text' autofocus>");
                    $(this).text("保存");
                    phone=false;
                }else {
                    if($('.telPhone input').val()!="" && $('.telPhone input').val()!=null){
                        var ptn=$(this).siblings().html()+' / '+$('.telPhone input').val();
                        $(this).siblings().html(ptn);
                        var telphone = $('.telPhone input').val();
                        var data = {'phone':telphone};
                        updateinfo(data)
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
            var tin=true;
            $("#addBZ").on("click",function(){
                if(tin){
                    $(".addbz").append("<textarea style='width: 60%;height: 200px'></textarea>");
                    $(this).text("保存");
                    tin=false;
                }else{
                    var at=$(".addbz textarea").val();
                    if(at!="" && at!=null){
                        $(".remark_info").append("<p></p>");
                        $(".remark_info p:last-child").html($(".addbz textarea").val())
                        var remark = $(".addbz textarea").val();
                        var data={'htremark':remark};
                        updateinfo(data);
                    }
                    $(".addbz textarea").remove();
                    $(this).text("添加备注");
                    tin=true;
                }
            })
            var  arri=true;
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
            //信息删除
            $('#delete').click(function(){
               var id=$('#studentinfo').attr('infoid');
                if(!id){
                    alert('请选点击学生信息选择要修改的学生');
                    return;
                }
                var res = confirm("确定要删除该信息？");
                if(res){
                    $.get('/student/delinfo/'+id,{},function(data){
                        if(data==1){
                            $('.checking').remove();
                            alert('删除成功');
                        }else{
                            alert('删除失败联系管理员');
                        }
                    });
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
                    async:false,
                    success:function(data){
                        if(data=='1'){
                            alert('修改成功');
                            res = true;
                        }else{
                            alert('修改失败，请联系管理员');
                            res = false;
                        }
                    },
                    error:function(){
                        alert('请联系管理员')
                    }
                })
                return res;
            }
            //显示地区
            $('#onearea').each(function(){
                var pro = $(this).attr('pro');
                var city = $(this).attr('city');
                var areaname = getAreaNamebyID(city);
                console.log(city);
                $(this).text(areaname);           
            })
    })
</script>