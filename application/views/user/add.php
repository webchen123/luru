<script src="/public/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/public/js/messages_zh.js" type="text/javascript"></script>
<form id="adduser">
<div class="edit">
    <div class="panel admin-panel">
        <div class="padding border-bottom container-layout">
            <div class="form-group w80">
                <div class="label">
                    <label>职位：</label>
                </div>
                <div class="field w25">
                    <select name="role"  id="role">
                         <?php 
                            if($_SESSION['bfdyt_role']==0){
                                echo '<option value="1">校区主管</option>';
                                echo '<option value="4">前台主管</option>';
                                echo '<option value="5">后台主管</option>';
                            }elseif($_SESSION['bfdyt_role']==1){
                                echo '<option value="4">前台主管</option>';
                                echo '<option value="5">后台主管</option>';
                            }
                         ?>
                         <?php
                            if($_SESSION['bfdyt_role']!=5){

                                echo '<option value="3" >前台邀约</option>';
                            }
                            if($_SESSION['bfdyt_role']!=4){
                                echo '<option value="2" selected="selected">后台客服</option>';
                            }
                          ?>
                    </select>
                </div>
            </div>
             <div class="form-group w80">
                <div class="label">
                    <label>所属校区：</label>
                </div>
                <div class="field w25">
                    <select name="fid"  id="fid">
                    <?php
                        if($_SESSION['bfdyt_role']<=1){
                            echo '<option class="admin" value="'.$_SESSION['bfdyt_id'].'">'.$_SESSION['bfdyt_name'].'('.$_SESSION['bfdyt_username'].')'.'</option>';
                        }
                        foreach ($leader as  $value) {
                            if($value['bfdyt_id']==$_SESSION['bfdyt_id']) continue;
                            echo '<option class="leader" value="'.$value['bfdyt_id'].'">'.$value['bfdyt_name'].'('.$value['bfdyt_username'].')'.'</option>';
                        }
                     ?>
                    </select>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>登录名：</label>
                </div>
                <div class="field w25">
                    <input type="text" name="username" class="input w75" id="username"  placeholder="登录名(6~16位数字、字母、下划线)"/>
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
                    <input type="text" name="name" class="input w75" id="name"  placeholder="真实姓名"/>
                </div>
            </div>
            <div class="form-group w80">
                <div class="label">
                    <label>电话：</label>
                </div>
                <div class="field w25">
                    <input type="text" name="phone" class="input w75" id="phone"  placeholder="电话"/>
                </div>
            </div>
            <div class="form-group w17" style="padding-top:20px">
                <div class="float-right">
                    <input type="submit" class="button bg-main" value="提交" style="cursor: pointer;margin-right:20px;">
                    <input type="reset" class="button bg-main style="cursor: pointer" margin-left" value="重置">
                </div>
            </div>
             <p style="color: red">注意：登录名请使用字母数字组合</p>
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
            $('.admin').attr('selected','selected')
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
                remote:"/user/checkname/0",
            },
            passwd:{
                required:true,
                minlength:6,
                maxlength:16,
            },
            repasswd:{
                required:true,
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
                required: "请输入密码",
                minlength:"必须大于6位",
                maxlength:"不能超过16位",
                equalTo:"输入密码不一致"
              },
              repasswd: {
                required: "请输入密码",
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
                url:"/user/doadd/",
                type:"post",
                data : {data:$(form).serialize()},
                success :function(data){
                    if(data==1){
                        alert('添加成功');
                      get_content('/user/');
                    }else{
                        alert('添加失败，请联系管理员')
                        $('.goback').trigger('click');
                    }
                }
            })
            return false;
        }    
    })
})
</script>
