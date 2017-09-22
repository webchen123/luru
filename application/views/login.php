<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/public/css/entry.css">
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <script type="text/javascript" src="/public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/public/js/entry.js"></script>
</head>
<body>
    <div class="w1100">
        <div class="item">
            <div class="logo"></div>
            <div class="content-form">
                <h4 class="content-title">用户登陆<span class="error" style="font-size:14px;color:red;margin-left:10px;"></span> </h4>
                <form method="post" action="/login/dologin/">
                    <div id="change_margin_1">
                        <em class="user_logo"></em>
                        <input class="user" type="text" name="username" placeholder="请输入用户名">
                    </div>
                    <p id="remind_1"></p>
                    <div id="change_margin_2">
                        <em class="password_logo"></em>
                        <input class="password" type="password" name="passwd" placeholder="请输入密码">
                    </div>
                    <p id="remind_2"></p>
                    <div id="change_margin_1">
                        <input class="user" style="width:55%" type="text" name="capword" placeholder="验证码">
                        <div class="capimg" style="width:40%;float:right;box-sizing:border-box;">
                            
                        </div>
                    </div>
                    <div id="change_margin_4">
                        <input class="content-form-signup" type="submit"  value="登录">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
