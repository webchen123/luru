<div class="admin"><div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <li> <a class="button border-main icon-plus-square-o getinfo" id="addPart" style="cursor:pointer">信息认领</a> </li>
            <li><input type="text" name="search" class="input float-left" value="<?php echo $search;?>" placeholder="请输入你要查询的信息"></li>
            <li><input type="button" class=" button bg-main btn_copy" id="searchButton" value="搜索"></li>
        </ul>
    </div>
    <table class="table table-hover text-center" id="table">
        <tbody>
        <tr>
            <th width="10%">咨询日期</th>
            <th width="10%">网聊老师</th>
            <th width="10%">学生姓名</th>
            <th width="10%">电话号码</th>
            <th width="10%">QQ/微信</th>
            <th width="10%">地区</th>
            <th width="10%">操作</th>
        </tr>
        </tbody>
        <tbody id="goods3">
        <?php foreach($data as $v) {
         ?>
        <tr class="<?php echo !$v['phone']?'lack_bg':'';?>" infoid="<?=$v['id']?>">
            <td><?php echo date('Y/m/d H:i:s',strtotime($v['zxdate']));?> </td>
            <td><?=$v['kfname'] ?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo array_pop((explode('/',$v['phone'])));?></td>
            <td><?php echo array_pop((explode('/',$v['qq'])));?></td>
            <td class="allarea" pro="<?=$v['pro'];?>" city="<?=$v['city'];?>" county="<?=$v['county'];?>"></td>
            <td><a href="javascript:;" class="button border-sub cancel getinfo" name="f4d707f72c60424bad10b1dd659f3d32">信息认领</a></td>
        </tr>
        <?php 
            }?>    
    </table>
    <div class="padding border-bottom">
        <div style="margin: 0 auto;text-align: center;padding-top:60px;">
            <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
            <a href="javascript:;" data-url="/student/publicinfo/<?=$prepage?>/?search=<?=$search?>"class="content button border-main" id="Previous"> 上一页</a>
            <a href="javascript:;" data-url="/student/publicinfo/<?=$nextpage?>/?search=<?=$search?>"class="content button border-main" id="next"> 下一页</a>
            <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
        </div>
    </div>
    <div class="minute  padding-top" id="studentinfo" infoid="">
        
    </div>
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

                    ftr.each(function(){
                        $(this).removeClass('checking');
                    })
                    $(this).addClass('checking');
                })
            }
        })();
        $(function(){
                //显示地区
            $('.allarea').each(function(){
                var pro = $(this).attr('pro');
                var city = $(this).attr('city');
                var county = $(this).attr('county');
                if(county=='0'){
                    var areaID = city
                }else{
                    var areaID = county
                }
                var areaname = getAreaNamebyID(areaID);
                $(this).text(areaname);           
            })
            //信息认领
            $('.getinfo').click(function(){
                if($(this).parents('tr')){
                    var id = $(this).parents('tr').attr('infoid');
                }else{
                    var id=$('#studentinfo').attr('infoid');
                }
                if(!id){
                    alert("请先选择要操作的学生信息\r\n(红色边框的为选中信息)");
                    return;
                }
                $.ajax({
                    url:'/student/receiveinfo',
                    data:{'id':id},
                    type:'get',
                    success:function(data){
                        if(data==1){
                            alert('认领成功');
                        }else{
                            alert('认领失败，请刷新重试');
                        }
                    }
                })
            })
            //搜索
            $('#searchButton').click(function(){
                var search = $('input[name="search"]').val();
                get_content('/student/publicinfo/?search='+search);
            })
        })
    </script>
