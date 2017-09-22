<div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search" style="padding-left:10px;">
            <?php
                echo !$zystatus?'<li> <a class="button border-main icon-plus-square-o" id="addPart" style="cursor:pointer">信息转接</a> </li>':'';
             ?>
            <li><input type="text" name="search" class="input float-left" placeholder="请输入你要查询的信息"></li>
            <li><input type="button" class=" button bg-main btn_copy" id="searchButton" value="搜索"></li>
        </ul>
    </div>
    <table class="table table-hover text-center" id="table">
        <tbody>
        <tr>
            <th width="10%">资讯日期</th>
            <th width="10%">网聊老师</th>
            <th width="10%">学生姓名</th>
            <th width="10%">电话号码</th>
            <th width="10%">QQ/微信</th>
            <th width="10%">回访时间</th>
            <th>操作</th>
        </tr>
        </tbody>
        <tbody id="goods3">
             <?php foreach($data as $v) {
             ?>
            <tr class="<?php echo !$v['phone']||!$v['qq']||!strtotime($v['atime'])||!strtotime($v['vtime'])?'lack_bg':'';?>" infoid="<?=$v['id']?>">
                <td><?php echo date('Y/m/d',strtotime($v['zxdate']));?> </td>
                <td><?=$v['kfname'] ?></td>
                <td><?php echo $v['name'];?></td>
                <td><?php echo array_pop((explode('/',$v['phone'])));?></td>
                <td><?php echo $v['qq'];?></td>
                <td><?php echo strtotime($v['vtime'])?$v['vtime']:''; ?></td>
                <?php 
                    if(!$zystatus){
                        if($visit==0){
                            echo '<td><a href="javascript:;" class="button border-sub cancel setvisit" name="f4d707f72c60424bad10b1dd659f3d32"> 设为已回访</a></td>';
                        }else{
                            echo '<td><a href="javascript:;" class="button border-sub cancel " name="f4d707f72c60424bad10b1dd659f3d32"> 已回访</a></td>';
                        }
                    }else{
                        echo ' <td><a href="javascript:;" class="button border-sub cancel" name="f4d707f72c60424bad10b1dd659f3d32"> 信息已转接</a></td>';
                    }

                 ?>
            </tr>
            <?php 
            }?>
    </table>
    <div class="padding border-bottom">
       <div style="margin: 0 auto;text-align: center;padding-top:60px;">
                <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
                <a href="javascript:;" data-url="/student/index/<?=$prepage?>/?visit=<?=$visit?>&zystatus=<?=$zystatus?>&search=<?=$search?>"class="content button border-main" id="Previous"> 上一页</a>
                <a href="javascript:;" data-url="/student/index/<?=$nextpage?>/?visit=<?=$visit?>&zystatus=<?=$zystatus?>&search=<?=$search?>"class="content button border-main" id="next"> 下一页</a>
                <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
            </div>
    </div>
    <div class="minute  padding-top" id="studentinfo" infoid="">
        
    </div>
</div>
<script type="text/javascript">
 //寻找tr
    (function(){
        var ftr=$("#goods3 tr");
        for(var i=0;i<ftr.length;i++){
            ftr.eq(i).click(function(){
                $(this).find('td').css({"border-top":"1px solid #e33","border-bottom":"1px solid #e33"})
                $(this).siblings().find('td').css({"border-top":"1px solid #ddd","border-bottom":"none"})
                var id=$(this).attr('infoid');
                $('#studentinfo').attr('infoid',id);
  <?php
    if($visit=='0'){
  ?>
                $.ajax({
                    url:'/student/getinfo/'+id+'/',
                    data:'',
                    type:'get',
                    success:function(data){
                        $('#studentinfo').html(data);
                    },
                    error:function(){
                        alert('请联系管理员')
                    }
                })
                $('#studentinfo').html('<h4>正在加载中...<h4>');
                $(".minute").show();
 <?php 
    }
 ?>
                ftr.each(function(){
                    $(this).removeClass('checking');
                })
                $(this).addClass('checking');
            })
        }
    })();
    //信息转接
    $('#addPart').click(function(){
        var id=$('#studentinfo').attr('infoid');
        if(!id){
            alert('请先选择要操作的学生');
            return;
        }
        data={'zystatus':'1'};
        updateinfo(data);
    })
    //搜索
    $('#searchButton').click(function(){
        var search = $('input[name="search"]').val();
        if(search){
            get_content('/student/index/?search='+search+'&visit=<?=$visit?>&zystatus=<?=$zystatus?>');
        }else{
            alert('请输入搜索条件');
        }
    })
    //设置已回访
    $('.setvisit').click(function(){
        data={visitstatus:'1'};
        var res = updateinfo(data);
        if(res){
            $(this).parents('tr').remove();
        }
    })
    //信息修改ajax
    function updateinfo(data){
        var id=$('#studentinfo').attr('infoid');
        var res=false;
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
</script>