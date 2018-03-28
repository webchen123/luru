<script src="/public/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/public/js/messages_zh.js" type="text/javascript"></script>
<form id="adduser">
<div class="edit">
    <div class="panel admin-panel">
        <div class="padding border-bottom container-layout">
            <?php if($_SESSION['bfdyt_role']<2||$_SESSION['bfdyt_role']>3){?>
            <div class="form-group w80">
                <div class="label">
                    <label>职位：</label>
                </div>
                <div class="field w25">
                    <select name="role"  id="role">
                         <?php
                         $rolearr=array('0'=>"超级管理员",'1'=>"校区管理",'2'=>'后台客服','3'=>'前台邀约','4'=>'前台主管','后台主管');
                         foreach ($rolearr as $k => $v) {
                             # code...
                            $selected = $info['bfdyt_role']==$k?'selected="selected"':'';
                            echo '<option value="'.$k.'" '.$selected.' disabled="disabled">'.$v.'</option>';
                         }
                         ?>
                    </select>
                </div>
            </div>
             <div class="form-group w80">
                <div class="label">
                    <label>所属校区</label>
                </div>
                <div class="field w25">
                    <select name="fid"  id="fid">
                    <?php
                        if($info['bfdyt_role']==0){
                            echo '<option class="admin" value="'.$_SESSION['bfdyt_id'].'" selected="selected">'.$_SESSION['bfdyt_username'].'('.$_SESSION['bfdyt_name'].')'.'</option>';
                        }else {
                            foreach ($leader as  $value) {
                                if($info["bfdyt_fid"]==$value['bfdyt_id']){
                                    echo '<option class="leader" value="'.$value['bfdyt_id'].'" selected="selected" >'.$value['bfdyt_username'].'('.$value['bfdyt_name'].')'.'</option>';
                                }else{
                                    if($info['bfdyt_role']==1||$_SESSION['bfdyt_role']>1) continue;
                                    echo '<option class="leader" value="'.$value['bfdyt_id'].'">'.$value['bfdyt_username'].'('.$value['bfdyt_name'].')'.'</option>';
                                }
                            }

                        }
                     ?>
                    </select>
                </div>
            </div>
            <?php }?>
            <div class="form-group w80">
                <div class="label">
                    <label>登录名：</label>
                </div>
                <div class="field w25">
                    <input type="text" name="username" value="<?=$info['bfdyt_username']?>" class="input w75" id="username"  placeholder="登录名(6~16位数字、字母、下划线)"/>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>密码：</label>
                </div>
                <div class="field w25">
                    <input type="password" name="passwd" class="input w75" id="passwd"   placeholder="密码(6~16位字符)"/>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>重复密码：</label>
                </div>
                <div class="field w25">
                    <input type="password" name="repasswd" class="input w75" id="repasswd"  placeholder="重复密码"/>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>姓名：</label>
                </div>
                <div class="field w25">
                    <input type="text" name="name" class="input w75" id="name" value="<?=$info['bfdyt_name']?>" placeholder="真实姓名"/>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>电话：</label>
                </div>
                <div class="field w25">
                    <input type="text" name="phone" class="input w75" id="phone" value="<?=$info['bfdyt_phone']?>" placeholder="电话"/>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $info['bfdyt_id']?>">
            <?php if($_SESSION['bfdyt_role']<2){?>
            <div class="form-group w80">
                <div class="label">
                    <label>当前状态：</label>
                </div>
                <div class="field w25">
                    <select name="status"  id="role">
                        <option value="0" <?php echo $info['bfdyt_status']?'':'selected="selected"';?> >禁用</option>
                        <option value="1" <?php echo $info['bfdyt_status']?'selected="selected"':'';?> >启用</option>
                    </select>
                </div>
            </div>
            <?php }?>
            <div class="form-group w17" style="padding-top:20px">
                <div class="float-right">
                    <input type="submit" class="button bg-main" value="修改" style="cursor: pointer;margin-right:20px;">
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(function(){

    $('#role').change(function(){
        var role = $(this).val()
        if(role == 1){
            $('.leader').attr('disabled','disabled')
        }else{
            $('.leader').removeAttr('disabled')
        }
    })
    $('#adduser').validate({
        errorElement:"div",
        errorClass:"error",
        rules:{
            username:{
                required:true,
                minlength:6,
                maxlength:16,
                remote:"/user/checkname/<?=$info['bfdyt_id']?>",
            },
            passwd:{
                minlength:6,
                maxlength:16,
            },
            repasswd:{
                minlength:6,
                maxlength:16,
                equalTo: "#passwd"
            },
            name:{
                required:true,
                maxlength:10,
            },
            phone:{
                required:true,
                number:true,
                maxlength:11,
            },
        },
         messages: {
              username: {
                required: "请输入登录名",
                minlength:"必须大于6位",
                maxlength:"不能超过16位",
                remote:"登录名已经存在",
              },
              passwd: {
                minlength:"必须大于6位",
                maxlength:"不能超过16位",
                equalTo:"输入密码不一致"
              },
              repasswd: {
                minlength:"必须大于6位",
                maxlength:"不能超过16位",
              },
              name:{
                required:"姓名不能为空",
                maxlength:"姓名长度不能超过10个字符",
              },
              phone:{
                required:"电话不能为空",
                number:"请输入正确的电话号",
                maxlength:"电话号不能超过11位",                
              }
        },
         submitHandler:function(form){
            $.ajax({
                url:"/user/doedit/",
                type:"post",
                data : {data:$(form).serialize()},
                success :function(data){
                    if(data==1){
                        alert('修改成功');
                    }else{
                        alert('修改失败，请联系管理员')
                    }
                    $('.goback').trigger('click');
                }
            })
            return false;
        }    
    })
})
</script>
