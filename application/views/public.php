<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/css/pintuer.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <!--加载js-->
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <script type="text/javascript" src="/public/js/pintuer.js"></script>
    <script type="text/javascript" src="/public/js/md5.js"></script>
    <script type="text/javascript" src="/public/js/echarts.min.js"></script>
    <script type="text/javascript" src="/public/js/AreaData.min.js"></script>
    <script type="text/javascript" src="/public/js/Area.js"></script>
    <script src="/public/js/main.js" type="text/javascript"></script>
</head>
<body>
<div id="header">
    <div class="float-left">
        <a  href="/" class="float-left" style="margin: 0"><img src="/public/img/logo_dyt_private.png" class="img-responsive"></a>
    </div>
    <div class="float-right">
        <a  class="icon-power-off flash-hover txt radius-circle  txt-small" href="/login/loginout"></a>

        <a data-url="/user/edit/<?=$bfdyt_id?>/" href="javascript:;" style="text-decoration: underline" class="content icon-check-square-o">设置</a>
        <a data-url="/user/edit/<?=$bfdyt_id?>/" class="content icon-user">
        <?php switch ($bfdyt_role) {
            case '0':
            echo '系统管理员';
            break;
            case '1':
            echo '客服主管';
            break;
            case '2':
            echo '后台客服';
            break;
            case '3':
            echo '前台邀约';
            break;
        }?>
        <span id="userName"> <?=$bfdyt_name?></span></a>
        <a class=" times flash-hover"></a>
    </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>  功能导航</strong></div>
    <h2 class="on"><span class="icon-wrench"></span>  信息添加</h2>
    <ul>
        <li data-num="1" class="subMenu"><a  class="content" data-url="/student/add/"  site="1" href="javascript:;"  target="right"><span class="icon-caret-right"></span> 添加信息</a></li>
    </ul>
    <?php  if($_SESSION['bfdyt_role']==0||$_SESSION['bfdyt_role']==1){?>
    <h2 class="on"><span class="icon-wrench"></span> 人员管理<span class="badge bg-yellow"></span></h2>
    <ul>
        <li data-num="1" class="subMenu"><a class="content" data-url="/user/"   site="1" href="javascript:;" target="right"><span class="icon-caret-right"></span> 人员列表</a></li>
        <li data-num="10" class="subMenu"><a class="content" data-url="/user/add" site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 添加账号</a></li>
        <li data-num="12" class="subMenu"><a  class="content" data-url="/login/loglist" site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 登陆日志</a></li>
    </ul>
    <?php }
    if($_SESSION['bfdyt_role']!=3){
    ?>
    <h2 class="on"><span class="icon-pencil-square-o"></span>  后台咨询</h2>
    <ul>
        <li data-num="2" class="subMenu"><a  class="content" data-url="/student/index"  site="1" href="javascript:;"  target="right"><span class="icon-caret-right"></span> 我的信息</a></li>
        <li data-num="3" class="subMenu"><a  class="content" data-url="/student/index/?visit=0" site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 要回访学生</a></li>
        <li data-num="4" class="subMenu"><a  class="content" data-url="/student/index/?visit=1"  site="1" href="javascript:;"  target="right"><span class="icon-caret-right"></span> 已回访学生</a></li>
        <li data-num="5" class="subMenu"><a  class="content" data-url="/student/index/?zystatus=1" site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 已转接信息</a></li>
    </ul>
    <?php
    }
     if($_SESSION['bfdyt_role']!=2){
    ?>
    <h2 class="on"><span class="icon-automobile (alias)"></span>  前台邀约 </h2>
    <ul>
         <li data-num="6" class="subMenu"><a class="content" data-url="/student/publicinfo"  site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 公共信息</a></li>
        <li data-num="7" class="subMenu"><a  class="content" data-url="/student/indexfront"  site="1" href="javascript:;"  target="right"><span class="icon-caret-right"></span> 我的信息</a></li>
        <li data-num="8" class="subMenu"><a  class="content" data-url="/student/indexfront/?visit=0" site="1"  href="javascript:;"  target="right"><span class="icon-caret-right"></span> 要回访学生</a></li>
        <li data-num="9" class="subMenu"><a  class="content" data-url="/student/indexfront/?visit=1"  site="1" href="javascript:;"  target="right"><span class="icon-caret-right"></span> 已回访学生</a></li>
    </ul>
    <?php }?>
    <h2 class="on"><span class="icon-wrench"></span>  数据分析</h2>
    <ul>
    <?php
     if($_SESSION['bfdyt_role']<=1){
    ?>
        <li data-num="14" class="subMenu"><a  class="content" data-url="/analyse/monthinfo" site="1"  href="javascript:;" ><span class="icon-caret-right"></span> 总信息量</a></li>
        <li data-num="16" class="subMenu"><a  class="content" data-url="/analyse/areainfo" site="1"  href="javascript:;" ><span class="icon-caret-right"></span> 地域分布</a></li>
        <li data-num="17" class="subMenu"><a  class="content" data-url="/analyse/majorinfo" site="1"  href="javascript:;" ><span class="icon-caret-right"></span> 专业分析</a></li>
    <?php 
     }
     if($_SESSION['bfdyt_role']!=3){
      ?>
     <li data-num="18" class="subMenu"><a  class="content" data-url="/analyse/transdinfo" site="1"  href="javascript:;" ><span class="icon-caret-right"></span> 转接数据</a></li>
     <?php 
     }
     if($_SESSION['bfdyt_role']!=2){
     ?>
        <li data-num="19" class="subMenu"><a  class="content" data-url="/analyse/joininfo" site="1"  href="javascript:;" ><span class="icon-caret-right"></span> 报名数据</a></li>
    <?php 
      }
     ?>
    </ul>
</div>
<!-- content--begin -->
<div id="content">
    <ul class="bread">
        <li><a href="/" target="" class="icon-home"> 首页</a></li>
        <li>位置：<a href="javascript:;" class="site" id="a_leader_txt">我的信息</a></li>
        <li><a class="goback" data-url="/" href="javascript:;"  id="a_leader_txt">返回</a></li>
        <li><a class="fresh" data-url="/" href="javascript:;"  id="a_leader_txt">刷新</a></li>
    </ul>
</div>
<div class="admin">
<!-- 中间内容 -->
</div>
<!--自定义jS-->
</body>
</html>
<script type="text/javascript">
    $(function(){
        var index = <?php echo $_SESSION['bfdyt_role']==3?'"/student/frontindex/"':'"/student/index/"';?>;
        get_content(index);
    })
</script>