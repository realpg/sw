function edit_password()
{
    var user_id=$("#user_id").text();
    var user_name=$("#user_name").val();
    var user_password=$("#user_password").val();
    var user_new_password=$("#user_new_password").val();
    var user_confirm_password=$("#user_confirm_password").val();
    var code=$("#code").val();
    if(user_name=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入用户名');
    }
    else if(user_password=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入原密码');
    }
    else if(user_new_password=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入新密码');
    }
    else if(user_confirm_password=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入确认密码');
    }
    else if(user_new_password!=user_confirm_password)
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('两次输入的密码不一致');
    }
    else if(code=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入验证码');
    }
    else
    {
        $.post("/sw/Admin/User/editDo",{"user_id":user_id,"user_name":user_name,"user_password":user_password,"user_new_password":user_new_password,"code":code},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('修改成功，请重新登录');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
            $("#verify").attr("src","/sw/Admin/Verify/verify");
        },"json")
    }
}
function add_user()
{
    var user_name=$("#user_name").val();
    var user_password=$("#user_password").val();
    var user_confirm_password=$("#user_confirm_password").val();
    if(user_name=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入用户名');
    }
    else if(user_password=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入密码');
    }
    else if(user_confirm_password=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入确认密码');
    }
    else if(user_password!=user_confirm_password)
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('两次输入的密码不一致');
    }
    else
    {
        $.post("/sw/Admin/User/addDo",{"user_name":user_name,"user_password":user_password},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('操作成功');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin/User/index'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
        },"json")
    }
}
function edit_base()
{
    var base_title=$("#base_title").val();
    var base_copyright=$("#base_copyright").val();
    var base_record=$("#base_record").val();
    $.post("/sw/Admin/Base/editDo",{"base_title":base_title,"base_copyright":base_copyright,"base_record":base_record},function(data){
        if(data.code=="1000")
        {
            $('.mask,.dialog').show();
            $('.dialog .dialog-bd p').html('修改成功');
            $('.dialog .dialog-ft').html("<a href='/sw/Admin/Base/edit'><button class='btn btn-info JyesBtn'>确认</button></a>")
        }
        else
        {
            $('.mask,.dialog').show();
            $('.dialog .dialog-bd p').html(data.message);
        }
    })
}
function edit_channel()
{
    var channel_id=$("#channel_id").text();
    var channel_title=$("#channel_title").val();
    var channel_link=$("#channel_link").val();
    var channel_link_m=$("#channel_link_m").val();
    var channel_sort=$("#channel_sort").val()==""?0:$("#channel_sort").val();
    var channel_show=$("input[name='channel_show']:checked").val();
    var channel_web=$("#channel_web").val();
    var channel_rule=$("#channel_rule").val();
    var channel_filter=$("#channel_filter").val();
    if(channel_title=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入标题');
    }
    else if(channel_web=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入节目单采集的页面');
    }
    else if(channel_rule=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入节目单采集的规则');
    }
    else
    {
        $.post("/sw/Admin/Channel/editDo",{"channel_id":channel_id,"channel_title":channel_title,"channel_link":channel_link,"channel_link_m":channel_link_m,"channel_sort":channel_sort,"channel_show":channel_show,"channel_web":channel_web,"channel_rule":channel_rule,"channel_filter":channel_filter},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('编辑成功');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin/Channel/index'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
        },"json")
    }
}
function add_channel()
{
    var channel_title=$("#channel_title").val();
    var channel_link=$("#channel_link").val();
    var channel_link_m=$("#channel_link_m").val();
    var channel_sort=$("#channel_sort").val()==""?0:$("#channel_sort").val();
    var channel_show=$("input[name='channel_show']:checked").val();
    var channel_web=$("#channel_web").val();
    var channel_rule=$("#channel_rule").val();
    var channel_filter=$("#channel_filter").val();
    if(channel_title=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入标题');
    }
    else if(channel_web=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入节目单采集的页面');
    }
    else if(channel_rule=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入节目单采集的规则');
    }
    else
    {
        $.post("/sw/Admin/Channel/addDo",{"channel_title":channel_title,"channel_link":channel_link,"channel_link_m":channel_link_m,"channel_sort":channel_sort,"channel_show":channel_show,"channel_web":channel_web,"channel_rule":channel_rule,"channel_filter":channel_filter},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('添加成功');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin/Channel/index'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
        },"json")
    }
}
function edit_program()
{
    var program_id=$("#program_id").text();
    var program_content=$("#program_content").val();
    var program_level=$("#program_level").val();
    var program_sort=$("#program_sort").val()==""?0:$("#program_sort").val();
    if(program_content=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入内容');
    }
    else
    {
        $.post("/sw/Admin/Program/editDo",{"program_id":program_id,"program_content":program_content,"program_level":program_level,"program_sort":program_sort},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('编辑成功');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin/Program/index'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
        },"json")
    }
}
function add_program()
{
    var program_content=$("#program_content").val();
    var program_level=$("#program_level").val();
    var program_sort=$("#program_sort").val()==""?0:$("#program_sort").val();
    if(program_content=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请输入标题');
    }
    else
    {
        $.post("/sw/Admin/Program/addDo",{"program_content":program_content,"program_level":program_level,"program_sort":program_sort},function(data){
            if(data.code=="1000")
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html('添加成功');
                $('.dialog .dialog-ft').html("<a href='/sw/Admin/Program/index'><button class='btn btn-info JyesBtn'>确认</button></a>")
            }
            else
            {
                $('.mask,.dialog').show();
                $('.dialog .dialog-bd p').html(data.message);
            }
        },"json")
    }
}
function collection()
{
    layer.confirm('采集节目单将删除之前的节目单，并采集新的节目单；采集的时间有可能会长。确定要采集吗？', {
        title:'系统提示',
        btn: ['确定','取消']
    }, function(){
        $("#layui-layer-shade1").css("display","none");  //隐藏遮罩
        $("#layui-layer1").css("display","none");  //隐藏layer
        $("#collection").html("<span class=\'icon-spin icon-refresh\'></span>采集中……");
        $.post("/sw/Admin/Program/collection",function(){
            history.go(0);
        })
    });
}
function All(e, itemName)
{
    var aa = document.getElementsByName(itemName);
    for (var i=0; i<aa.length; i++)
        aa[i].checked = e.checked; //得到那个总控的复选框的选中状态
}
function Item(e, allName)
{
    var all = document.getElementsByName(allName)[0];
    if(!e.checked) {
        all.checked = false;
    }else{
        var aa = document.getElementsByName(e.name);
        for (var i=0; i<aa.length; i++)
            if(!aa[i].checked) return;
        all.checked = true;
    }
}
function batch_delete()
{
    var obj = document.getElementsByName("mm[]");
    var selected="";
    for(var i=0; i<obj.length; i++)
    {
        if(obj[i].checked)
            selected += obj[i].value+','; //如果选中，将value添加到变量selected中
    }
    if(selected=="")
    {
        $('.mask,.dialog').show();
        $('.dialog .dialog-bd p').html('请选择要删除的信息');
    }
    else
    {
        $("#batchdelete").submit();
    }
}
function deleteDo()
{
    $("#table_data").submit();

}
function delayed_dialog(data,time)
{
    var text="";
    var link="";
    if(data==0)
    {
        text="操作失败";
        link="";
    }
    else
    {
        text="操作成功"
        link=data;
    }
    $('.automatic').html(text+"&nbsp;&nbsp;"+time);
    $('dialog').show().delay(3000).hide(0);
    function jump(count) {
        window.setTimeout(function(){
            count--;
            if(count > 0) {
                $('.automatic').html(text+"&nbsp;&nbsp;"+count);
                jump(count);
            } else {
                location.href=link;
            }
        }, 1000);
    }
    jump(time);
}

