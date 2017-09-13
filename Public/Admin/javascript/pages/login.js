$(function(){
	$('#entry').click(function(){
		if($('#user_name').val()==''){
			$('.mask,.dialog').show();
			$('.dialog .dialog-bd p').html('请输入管理员账号');
		}
        else if($('#user_password').val()==''){
			$('.mask,.dialog').show();
			$('.dialog .dialog-bd p').html('请输入管理员密码');
		}
        else if($('#code').val()==''){
            $('.mask,.dialog').show();
            $('.dialog .dialog-bd p').html('请输入验证码');
        }
        else{
			$('.mask,.dialog').hide();
			var user_name=$('#user_name').val();
			var user_password=$('#user_password').val();
            var code=$('#code').val();
			$.post("../sw/Admin/Index/login",{"user_name":user_name,"user_password":user_password,"code":code},function(data){
				if(data.code=="1000")
					{
						location.href="../sw/Admin/Home/index";
					}
				else
					{
						$('.mask,.dialog').show();
						$('.dialog .dialog-bd p').html(data.message);
					}
                $("#verify").attr("src","/sw/Admin/Verify/verify");
			},"json")
		}
	});
});