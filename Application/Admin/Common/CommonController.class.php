<?php
namespace Admin\Common;
use Think\Controller;
class CommonController extends Controller{
    public function _initialize()
    {
        //判断SESSION
        $USER_DB=D("User");
        if(CONTROLLER_NAME!="Index")
        {
            if(empty($_SESSION["user"]))
            {
                $this->error('警告！非法操作：登录超时或用户已被清除，请重新先登录！跳转中...',"/sw/admin.html",5);
            }
            else
            {
                $user=$_SESSION["user"];
                $parameter_user_name=array(
                    "where"=>array("user_name"=>$user["user_name"])
                );
                $user_row=$USER_DB->scope("check_name",$parameter_user_name)->find();
                if(!$user_row)
                {
                    $this->error('警告！非法操作：请先登录！跳转中...',"/sw/admin.html",5);
                }
            }
        }

    }
    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    //对密码进行不可逆加密
    public function encryption($password)
    {
        $user_password1=md5($password);
        $user_password2=substr($user_password1, CUSTOM_p_1,CUSTOM_p_length);
        $user_password3=md5($user_password2);
        $user_password4=substr($user_password3, CUSTOM_p_2,CUSTOM_p_length);
        $user_password=md5($user_password4);
        return $user_password;
    }
    // 清除SESSION
    public function unsetsession()
    {
        session(null);  //删除session
        session('[destroy]');  //销毁session
        $this->redirect("/Admin");
    }
    // 清除缓存
    public function clearruntime()
    {
        $style = RUNTIME_PATH;
        if($this->_deleteDir($style))
            $this->ajaxReturn("1000");
    }
    private function _deleteDir($style)
    {
        $handle = opendir($style);
        while(($item = readdir($handle)) !== false)
        {

            if($item != '.' and $item != '..')
            {
                if(is_dir($style.'/'.$item))
                {
                    $this->_deleteDir($style.'/'.$item);
                }
                else
                {
                    if(!unlink($style.'/'.$item))
                        die('error!');
                }
            }
        }
        closedir( $handle );
        return rmdir($style);
    }
    //计算两个时间相差多少天
    public function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ceil(($second1 - $second2) / 86400);
    }
    //404页面
    public function unfind()
    {
        $this->display();
    }
    //空操作_empty()方法
    public function _empty()
    {
        $this -> display("Common:unfind");//显示自定义的404页面模版
    }
}