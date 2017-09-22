/**
 * Created by Administrator on 2017/8/10.
 */
$(function(){
    //点击选项卡内容--------调用函数
    var $leftnav=$(".leftnav h2");
    $leftnav.on("click",function () {
        $(this).next().slideToggle();
        $(this).removeClass("on");
        $(this).siblings("h2").addClass("on")
    });
    $("body").on("click",".content",function () {
        if($(this).attr('site')){
            $("#a_leader_txt").text($(this).text());
        }
        $(this).addClass("on").parent("li").siblings("li").children().removeClass("on");
        var url = $(this).attr('data-url');
        get_content(url);
    });
    $('.fresh,.goback').click(function(){
        var url = $(this).attr('data-url');
        if(url){
            get_content(url);
        }
    })
    //获取时间---------------------------
    setInterval(function () {
        var dates=new Date().getTime();
        $(".times").html(getLocalTime(parseInt(dates/1000)))
    },1000);
    
});
function get_content(url){
    if(!url){
        return false;
    }
    var oldurl=$('.fresh').attr('data-url');
    if(url!=oldurl){
        $('.goback').attr('data-url',oldurl);
    }
    $('.fresh').attr('data-url',url);
    $.ajax({
        type:"get",
        async:true,
        jsonp: "jsonpCallback",
        url:url,
        success:function(data){
            $(".admin").html('');
            $(".admin").html(data);
        }
    })
}
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
}
function showAreaID() {
    //地区码
    var areaID = getAreaID();
    //地区名
    var areaName = getAreaNamebyID(areaID);
    return areaName;
}

//根据地区码查询地区名
function getAreaNamebyID(areaID){
    var areaName = "";
    if(areaID.length == 2){
        areaName = area_array[areaID];
    }else if(areaID.length == 4){
        var index1 = areaID.substring(0, 2);
        areaName = area_array[index1] + "" + sub_array[index1][areaID];
    }else if(areaID.length == 6){
        var index1 = areaID.substring(0, 2);
        var index2 = areaID.substring(0, 4);
        areaName = area_array[index1] + "" + sub_array[index1][index2] + "" + sub_arr[index2][areaID];
    }
    return areaName;
}
