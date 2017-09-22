/**
 * Created by xuezhiyi on 2017/8/21.
 */

$(document).ready(function () {
    var statu = false;
    $('input[name=username]').blur(function(){
        var val=$(this).val();
        var reg = /^.{6,16}$/;
        if(reg.test(val)){
            $(this).css('border','0px')
            $('.error').text('');
            statu = true;
        }else{
            $(this).css('border','1px solid red')
            $('.error').text('');
            $('.error').text('用户名为6~16位数字、字母、下划线');
            statu = false;
        }
    });
    $('input[name=passwd]').blur(function(){
        var val=$(this).val();
        var reg = /^.{6,16}$/;
        if(reg.test(val)){
            $(this).css('border','0px')
            $('.error').text('');
            statu = true;
        }else{
            $(this).css('border','1px solid red')
            $('.error').text('');
            $('.error').text('密码为6~16位字符');
            statu = false;
        }
    });
    $('input[name=capword]').blur(function(){
        var val=$(this).val();
        var reg = /^[a-z0-9]{4}$/;
        if(reg.test(val)){
            $(this).css('border','0px')
            $('.error').text('');
            statu = true;
        }else{
            $(this).css('border','1px solid red')
            $('.error').text('');
            $('.error').text('验证码为4位字符');
            statu = false;
        }
    });
    getCaptcha();
    $('.capimg').click(getCaptcha);
    $('form').submit(function(){
        $('input').trigger('blur');
        if(statu){
            return true;
        }else{
            $('.error').text('');
            $('.error').text('请检查表单是否正确');
            return false;
        }
    })
});


//获取验证码
function getCaptcha(){
    $.get('/login/captcha/',{},function(data){
        $('.capimg').html(data);
    })
}
