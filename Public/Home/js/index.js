if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    window.location.href = "/sw/mobile.html"; //可以换成http地址
}
$(function(){
    var win_height=$(window).height(); //浏览器时下窗口可视区域高度
    $("#body").css("height",win_height);

    // 对Date的扩展，将 Date 转化为指定格式的String
    // 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
    // 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
    Date.prototype.Format = function (fmt) { //author: meizz
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "H+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    }
    var time = new Date().Format("yyyy/MM/dd");
    $("#content-time").text(time);
})
function search(){
    $("#searchChannel").submit();
}
//切换视频
function playvideo(channel_id){
    var searchname=$("#searchname").val();
    $.post("/sw/Home/Index/play",{"channel_id":channel_id,"searchname":searchname},function(data){
        $("#channel").html(data["channel"]);
        $("#main").html(data["main"]);
        $("#program").html(data["program"]);
        $("#source").html(data["source"]);
        $("#searchname").val(data["searchname"]);
    })
}