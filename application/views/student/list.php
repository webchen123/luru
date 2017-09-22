<div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <li><a class="button border-main icon-plus-square-o" id="addPart" style="cursor:pointer"> 信息转接</a> </li>
            <li><a class="button border-sub icon-plus-square-o content"  id="addPartS"  style="cursor:pointer" data-url="/student/add/"> 添加信息</a> </li>
            <?php 
            if($_SESSION['bfdyt_role']==0){
              ?>
                <li><a class="button border-mix icon-plus-square-o" id="delete"  style="cursor:pointer"> 删除信息</a> </li>
                <li><a class="button border-dot icon-plus-square-o" id="edit" style="cursor:pointer"> 修改信息</a> </li>
             <?php 
            }
             ?>
             <li>
                <select name="check" class="button border-sub" id="fullsearch">
                    <option value="2">全部信息</option>
                    <option value="1" <?php echo $full==1?'selected="selected"':'';?>>完整信息</option>
                    <option value="0" <?php echo $full==='0'?'selected="selected"':'';?>>不完整信息</option>
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
            <th width="7%">资讯日期</th>
            <th width="6%">网聊老师</th>
            <th width="5%">咨询时间</th>
            <th width="5%">咨询工具</th>
            <th width="5%">学生姓名</th>
            <th width="5%">性别</th>
            <th width="4%">年龄</th>
            <th width="6%">电话号码</th>
            <th width="6%">QQ/微信</th>
            <th width="4%">星级</th>
            <th width="6%">回访时间</th>
            <th width="6%">预计到校时间</th>
            <th width="6%">咨询专业</th>
            <th width="8%">地区</th>
        </tr>
        </thead>
        <tbody id="goods3">
        <?php foreach($data as $v) {
         ?>
        <tr class="<?php echo !$v['phone']||!$v['qq']||!strtotime($v['atime'])||!strtotime($v['vtime'])?'lack_bg':'';?>" infoid="<?=$v['id']?>">
            <td><?php echo date('Y/m/d',strtotime($v['zxdate']));?> </td>
            <td><?=$v['kfname'] ?></td>
            <td><?php echo $v['zxtime'].'点';?></td>
            <td><?php echo $source[$v['source']];?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo $v['sex']==1?'男':'女';?></td>
            <td><?php echo $v['age'];?></td>
            <td><?php echo array_pop((explode('/',$v['phone'])));?></td>
            <td><?php echo array_pop((explode('/',$v['qq'])));?></td>
            <td><?php echo $v['star'].'星级'; ?></td>
            <td><?php echo strtotime($v['vtime'])?$v['vtime']:''; ?></td>
            <td><?php echo strtotime($v['atime'])?$v['atime']:''; ?></td>
            <td><?php echo $major[$v['major']] ?></td>
            <td class="allarea" pro="<?=$v['pro'];?>" city="<?=$v['city'];?>" county="<?=$v['county'];?>"></td>
        </tr>
        <?php 
            }?>
        </tbody>
    </table>
    <div class="padding border-bottom">
        <div style="margin: 0 auto;text-align: center;padding-top:60px;">
                <a href="javascript:;" data-url=""            class=" button border-main"> 第(<span id="page" style="color:#f00" ><?=$nowpage?></span>)页</a>
                <a href="javascript:;" data-url="/student/index/<?=$prepage?>/?search=<?=$search?>&full=<?=$full?>"class="content button border-main" id="Previous"> 上一页</a>
                <a href="javascript:;" data-url="/student/index/<?=$nextpage?>/?search=<?=$search?>&full=<?=$full?>"class="content button border-main" id="next"> 下一页</a>
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
                //显示地区
            $('.allarea').each(function(){
                var pro = $(this).attr('pro');
                var city = $(this).attr('city');
                var county = $(this).attr('county');
                if(county==''){
                    var areaID = city
                }else{
                    var areaID = county
                }
                var areaname = getAreaNamebyID(areaID);
                $(this).text(areaname);           
            })
            //信息转接
            $('#addPart,#delete').click(function(){
                var id=$('#studentinfo').attr('infoid');
                if(!id){
                    alert('请先选择要操作的学生');
                    return;
                }
            })
            //信息修改
            $("#edit").click(function(){
                var id=$('#studentinfo').attr('infoid');
                if(!id){
                    alert('请先选择要操作的学生');
                    return;
                }
                get_content('/student/edit/'+id);
            })
             //筛选是否完整
            $('#fullsearch').change(function(){
                var isjoin = $(this).val();
                if(isjoin==1){
                    get_content('/student/index/?full=1');
                }else if(isjoin==0){
                    get_content('/student/index/?full=0');
                }else{
                    get_content('/student/index/');
                }
            })
            //搜索
            $('#searchButton').click(function(){
                var search = $('input[name="search"]').val();
                if(search){
                    get_content('/student/index/?search='+search);
                }else{
                    alert('请输入搜索条件');
                }
            })
        })
    </script>