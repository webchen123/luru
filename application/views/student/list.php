<div class="panel admin-panel">
    <div class="padding border-bottom">
        <ul class="search padding-left">
            <!-- <li><a class="button border-main icon-plus-square-o" id="addPart" style="cursor:pointer"> 信息转接</a> </li> -->
            <li><a class="button border-sub icon-plus-square-o content"  id="addPartS"  style="cursor:pointer" data-url="/student/add/"> 添加信息</a> </li>
            <?php 
            if($_SESSION['bfdyt_role']==0){
              ?>
                <li><a class="button border-mix icon-plus-square-o" id="delete"  style="cursor:pointer"> 删除信息</a> </li>
                <!-- <li><a class="button border-dot icon-plus-square-o" id="edit" style="cursor:pointer"> 修改信息</a> </li> -->
             <?php 
            }
             ?>
             
            <!-- <li><a class="button border-dot icon-plus-square-o" id="revise"  style="cursor:pointer"> 修改信息</a> </li> -->
            <li><input type="text" name="search" class="input float-left" placeholder="搜索姓名/电话/qq" value="<?=$search?>" ></li>
            <li><input type="button" class=" button bg-main btn_copy" id="searchButton" value="搜索"></li>
        </ul>
        <ul class="search padding-left padding-top">
            <li>
                <span>回访状态筛选：</span>
                <select class="button check" name="zxstatus" id="visitState" style="display: inline-block">
                    <option value="0">--不限--</option>
                        <?php 
                            foreach ($visitstatus  as $k => $v) {
                                if($k==$zxstatus){
                                    $selected='selected="selected"';
                                }else{
                                    $selected='';
                                }
                                echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                            }
                         ?>
                </select>
            </li>
            <li>
                <span>日期晒选：</span>
                <input type="date" name="startime" class="input check" id="starTime" value="<?=$startime?>" style="display: inline-block;width: 38%" />
                <span>到</span>
                <input type="date" name="endtime" class="input check" id="endTime" value="<?=$endtime?>" style="display: inline-block;width: 38%">
            </li>
            <li>
                <span>省份晒选：</span>
                <select name="pro" class="button check">
                    <option value="0">不限</option>
                    <?php 
                        foreach ($province  as $k => $v) {
                            if($k==$pro){
                                $selected='selected="selected"';
                            }else{
                                $selected='';
                            }
                            echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                        }
                     ?>
                </select>
            </li>
            <li>
           <!--  <li>
                <span>城市晒选：</span>
                <select name="city" class="button check">
                    <option value="0">不限</option>
                    <?php 
                        foreach ($maincity  as $k => $v) {
                            if($k==$city){
                                $selected='selected="selected"';
                            }else{
                                $selected='';
                            }
                            echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                        }
                     ?>
                </select>
            </li> -->
            <li>
                <select name="isfull" class="button check" id="wzxx">
                    <option value="2">全部信息</option>
                    <option value="1" <?php echo $isfull==1?'selected="selected"':'';?>>完整信息</option>
                    <option value="0" <?php echo $isfull==='0'?'selected="selected"':'';?>>不完整信息</option>
                </select>
            </li>
            <?php if($_SESSION['bfdyt_role']<2||$_SESSION['bfdyt_role']>3){
            ?>

            <li>
                <span>咨询老师晒选：</span>
                <select name="backuser" class="button check" id="zxs">
                    <option value="0">--不限--</option>
                    <?php 
                        foreach ($backusers  as  $v) {
                            if($v['bfdyt_id']==$backuser){
                                $selected='selected="selected"';
                            }else{
                                $selected='';
                            }
                            echo '<option value="'.$v['bfdyt_id'].'" '.$selected.'>'.$v['bfdyt_name'].'</option>';
                        }
                     ?>
                </select>
            </li>
            <?php 
            } 

             ?>
        </ul>
    </div>
    <table class="table table-hover text-center" id="table">
        <thead>
        <tr>
            <th width="8%">咨询日期</th>
            <th width="6%">录入老师</th>
            <th width="5%">回访状态</th>
            <th width="5%">来源</th>
            <th width="6%">学生姓名</th>
            <th width="2%">性别</th>
            <th width="2%">年龄</th>
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
        <tr class="<?php /*echo !$v['phone']?'lack_bg':'';*/ echo $v['frontuser']?' yzj':'';?>" infoid="<?=$v['id']?>">
            <td><?php echo date('Y/m/d H:i:s',strtotime($v['zxdate']));?> </td>
            <td><?=$v['kfname'] ?></td>
            <td><?php echo $visitstatus[$v['visitstatus']];?></td>
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
		    <?php 
                if($maxpage){

              ?>
            <a href="javascript:;" data-url="/student/index/<?=$prepage?>/?<?=$checkstr?>"class="content button border-main" id="Previous"> 上一页</a>
            <a href="javascript:;" data-url="/student/index/<?=$nextpage?>/?<?=$checkstr?>"class="content button border-main" id="next"> 下一页</a>
             <?php 
                }
             ?>
            <a href="javascript:;" data-url=""            class=" button  border-main"> 共(<span id="pagenum" style="color:#f00"><?=$maxpage?></span>)页</a>
        </div>
        <p  class="padding-top" style="color: red">温馨提示：红色边框为当前选中，<!-- 紫色行缺少主要信息， -->黄色行信息已转接</p>
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
            //信息修改
            $("#edit").click(function(){
                var id=$('#studentinfo').attr('infoid');
                if(!id){
                    alert('请先选择要操作的学生');
                    return;
                }
                get_content('/student/edit/'+id);
            })
            //信息筛选
            var checkstr = '<?php echo $checkstr;?>';
            $('.check').change(function(){
                var key = $(this).attr('name');
                var value = $(this).val();
                checkstr += key+'='+value+'&';
                console.log(checkstr);
                get_content('/student/index/?'+checkstr);
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
