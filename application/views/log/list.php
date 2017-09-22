<div class="panel admin-panel">
    <div class="padding border-bottom container-layout">
        <table class="text-center table table-hover">
            <thead class="margin-bottom">
            <tr>
                <th width="15%">ID</th>
                <th width="25%">登陆用户</th>
                <th width="20%">职位</th>
                <th width="25%">登陆时间</th>
                <th width="15%">操作</th>
            </tr>
            </thead>
            <tbody id="tws">
            <?php 
            $rolearr=array('0'=>"超级管理员",'1'=>"客服主管",'2'=>'后台客服','3'=>'前台邀约');
            foreach($res as $v){?>        
            <tr>
                <td class="logid" logid="<?=$v['bfdyt_id']?>"><?=$v['bfdyt_id']?></td>
                <td><?=$rolearr[$v['bfdyt_role']]?></td>
                <td><?=$v['bfdyt_name']?>(<?=$v['bfdyt_username']?>)</td>
                <td><?php echo date('Y-m-d H:i:s',$v['bfdyt_time']) ?></td>
                <td><a class="dellog button border-dot btn_copy" style="cursor:pointer;">删除</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
         <div class="padding border-bottom">
            <div style="margin: 0 auto;text-align: center;padding-top:60px;">
                <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
                <a href="javascript:;" data-url="/login/loglist/<?=$prepage?>"class="content button border-main" id="Previous"> 上一页</a>
                <a href="javascript:;" data-url="/login/loglist/<?=$nextpage?>"class="content button border-main" id="next"> 下一页</a>
                <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.dellog').click(function(){
        var tr=$(this).parents('tr');
        var id = tr.find('.logid').attr('logid');
        $.ajax({
            url:'/login/dellog/',
            data:{id:id},
            type:'post',
            success:function(data){
                if(data){
                    tr.remove();
                }else{
                    alert('删除失败，联系管理员');
                }
            }
        })
    })
</script>