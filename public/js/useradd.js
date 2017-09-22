    $('#role').change(function(){
        var role = $(this).val()
        console.log(role);
        if(role == 1){
            $('.leader').attr('disabled','disabled');
        }else{
            $('.leader').attr('disabled','');
        }
    })
    $('#adduser').validate({
        rules:{
            job:{
                "required":true,
                maxlength:10,
            },
            username:{
                "required":true,
                minlength:6,
                maxlength:16,
                remote:"/user/checkname/",
            },
            passwd:{
                "required":true,
                minlength:6,
                maxlength:16,
            },
            name:{
                "required":true,
                maxlength:10,
            },
            phone:{
                "required":true,
                "number":true,
                "maxlength":11,
            },
        },
         messages: {
              job:{
                required:"职称不能为空",
                maxlength:"职称长度不能超过10个字符",
              },
              username: {
                required: "请输入登录名",
                minlength:"必须大于6位",
                maxlength:"不能超过16位",
                remote:"登录名已经存在",
              },
              password: {
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

                }
            })
            return false;
        }    
    })
