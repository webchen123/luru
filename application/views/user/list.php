<div class="panel admin-panel">
    <div class="padding border-bottom container-layout">
        <table class="text-center table table-hover">
            <thead class="margin-bottom">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">姓名(登录名)</th>
                    <th width="8%">职位</th>
                    <th width="15%">上级主管</th>
                    <th width="10%">电话</th>
                    <th width="5%">状态</th>
                    <th width="10%">注册日期</th>
                    <th width="5%">登陆次数</th>
                    <th width="15%">最后登陆</th>
                    <th width="15%">操作</th>
                </tr>
            </thead>
            <tbody id="tws">
                <?php $rolearr=array('0'=>"超级管理员",'1'=>"校区管理",'2'=>'后台客服','3'=>'前台邀约','4'=>'前台主管','后台主管');
                foreach($data as $v){
                    ?>
                <tr>
                    <td class="infoid" infoid="<?=$v['bfdyt_id']?>"><?=$v['bfdyt_id']?></td>
                    <td><?php echo $v['bfdyt_name'].'('.$v["bfdyt_username"].')';?></td>
                    <td><?php echo $rolearr[$v['bfdyt_role']];?></td>
                    <td><?php echo $v['lname'].'('.$v["lusername"].')';?></td>
                    <td><?=$v['bfdyt_phone']?></td>
                    <td><?php echo $v['bfdyt_status']?'已开启':'已禁用';?></td>
                    <td><?=$v['bfdyt_time']?></td>
                    <td><?=$v['bfdyt_logins']?></td>
                    <td><?=$v['bfdyt_logintime']?></td>
                    <td>
                    <a href="javascript:;" class="content button bg-main btn_copy margin-right" data-url="/user/edit/<?=$v['bfdyt_id']?>/" id="alter">修改</a>
                    <a href="javascript:;" class="delinfo button border-dot btn_copy">删除</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="padding border-bottom">
            <div style="margin: 0 auto;text-align: center;padding-top:60px;">
                <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
                <a href="javascript:;" data-url="/user/index/<?=$prepage?>"class="content button border-main" id="Previous"> 上一页</a>
                <a href="javascript:;" data-url="/user/index/<?=$nextpage?>"class="content button border-main" id="next"> 下一页</a>
                <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('.delinfo').click(function(){
    var tr=$(this).parents('tr');
    var id = tr.find('.infoid').attr('infoid');
    var statu = confirm('你将要删除id为'+id+"的账户\r\n删除后该账户录入的信息只有上级账户能看到");
    if(statu){
        $.ajax({
            url:'/user/del/',
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
    }
})
</script>