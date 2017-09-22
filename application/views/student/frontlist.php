<div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
             <li>
                <select name="check" class="button border-sub" id="joinsearch">
                    <option value="2">全部信息</option>
                    <option value="1" <?php echo $joinstatus==1?'selected="selected"':'';?> >已报名</option>
                    <option value="0" <?php echo $joinstatus==='0'?'selected="selected"':'';?> >未报名</option>
                </select>
            </li>
            <!-- <li><a class="button border-dot icon-plus-square-o" id="revise"  style="cursor:pointer"> 修改信息</a> </li> -->
            <li><input type="text" name="search" class="input float-left" placeholder="搜索姓名/电话/qq" value="<?=$search?>" ></li>
            <li><input type="button" class=" button bg-main btn_copy" id="searchButton" value="搜索"></li>
        </ul>
    </div>
    <table class="table table-hover text-center" id="table">
        <thead>
        <tr>
            <th width="10%">资讯日期</th>
            <th width="10%">认领时间</th>
            <th width="10%">网聊老师</th>
            <th width="10%">认领老师</th>
            <th width="10%">学生姓名</th>
            <th width="10%">电话号码</th>
            <th width="10%">QQ/微信</th>
            <th width="10%">来访时间</th>
            <th width="10%">是否报名</th>
        </tr>
        </thead>
        <tbody id="goods3">
        <?php foreach($data as $v) {
         ?>
        <tr class="<?php echo !$v['phone']||!$v['qq']||!strtotime($v['atime'])||!strtotime($v['vtime'])?'lack_bg':'';?>" infoid="<?=$v['id']?>">
            <td><?php echo date('Y/m/d',strtotime($v['zxdate']));?> </td>
            <td><?php echo date('Y/m/d',strtotime($v['rltime']));?> </td>
            <td><?php echo $backuser[$v['backuserid']];?></td>
            <td><?=$v['kfname'] ?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo array_pop((explode('/',$v['phone'])));?></td>
            <td><?php echo array_pop((explode('/',$v['qq'])));?></td>
            <td><?php echo strtotime($v['atime'])?$v['atime']:''; ?></td>
            <td>
                <select id="in" class="isjoin">
                    <option value="0" <?php echo $v['joinstatus']==0?'selected="selected"':'';?> >未报名</option>
                    <?php 
                        $select='';
                        foreach ($major as $mk => $mv) {
                            if($v['joinstatus']){
                                if($v['major']==$mk){
                                    $select='selected="selected"';
                                }else{
                                    $select='';
                                }
                            }
                            echo '<option value="'.$mk.'" '.$select.'>'.$mv.'</option>';
                        }
                     ?>
                </select>
            </td>
        </tr>
        <?php 
            }?>
        </tbody>
    </table>
    <div class="padding border-bottom">
        <div style="margin: 0 auto;text-align: center;padding-top:60px;">
                <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
                <a href="javascript:;" data-url="/student/indexfront/<?=$prepage?>/?search=<?=$search?>&joinstatus=<?=$joinstatus?>"class="content button border-main" id="Previous"> 上一页</a>
                <a href="javascript:;" data-url="/student/indexfront/<?=$nextpage?>/?search=<?=$search?>&joinstatus=<?=$joinstatus?>"class="content button border-main" id="next"> 下一页</a>
                <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
            </div>
    </div>
    <div class="minute  padding-top" id="studentinfo" infoid="">
        
    </div>
</div>
    <script>
        //寻找tr
        (function(){
            var ftr=$("#goods3 tr");
            for(var i=0;i<ftr.length;i++){
                ftr.eq(i).click(function(){
                    $(this).find('td').css({"border-top":"1px solid #e33","border-bottom":"1px solid #e33"})
                    $(this).siblings().find('td').css({"border-top":"1px solid #ddd","border-bottom":"none"})
                    var id=$(this).attr('infoid');
                    $('#studentinfo').attr('infoid',id);
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
                    ftr.each(function(){
                        $(this).removeClass('checking');
                    })
                    $(this).addClass('checking');
                })
            }
        })();
        $(function(){
            //筛选是否报名
            $('#joinsearch').change(function(){
                var isjoin = $(this).val();
                if(isjoin==1){
                    get_content('/student/indexfront/?joinstatus=1');
                }else if(isjoin==0){
                    get_content('/student/indexfront/?joinstatus=0');
                }else{
                    get_content('/student/indexfront/');
                }
            })
            //搜索
            $('#searchButton').click(function(){
                var search = $('input[name="search"]').val();
                get_content('/student/indexfront/?search='+search);
            })
            //报名选择
            $('.isjoin').change(function(){
                var val = $(this).val();
                var id = $(this).parents('tr').attr('infoid');
                console.log(val,id)
                $.ajax({
                    url:'/student/makejoin',
                    data:{id:id,major:val},
                    type:'post',
                    success:function(data){
                        if(data==1){
                            alert('修改成功');
                        }else{
                            alert('修改失败');
                        }
                    },
                    error:function(){
                        alert('修改失败请联系管理员');
                    }
                })
            })
        })
    </script>