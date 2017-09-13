<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class UserController extends CommonController{
    public function edit()
    {
        $this->display();
    }
    public function editDo()
    {
        $USER_DB=D("User");
        $user_name=I("user_name");
        $user_password=I("user_password");
        $user_new_password=I("user_new_password");
        $code=I("code");
        if($this->check_verify($code))
        {
            //检测用户是否存在
            $parameter_user_checkname=array(
                "where"=>array("user_name"=>$user_name)
            );
            $user_row=$USER_DB->scope("check_name",$parameter_user_checkname)->find();
            if(!$user_row)
            {
                $user=$_SESSION["user"];
                $user_id=$user["user_id"];
                $user_password=md5($user_password); //对密码进行加密
                //检测密码
                $parameter_user_checkpassword=array(
                    "where"=>array(
                        "user_id"=>$user_id,
                        "user_password"=>$user_password
                    )
                );
                $row=$USER_DB->scope("check_user_password",$parameter_user_checkpassword)->find();
                $data=array();
                if($row)
                {
                    $user_new_password=md5($user_new_password); //对密码进行加密
                    //修改密码
                    $parameter_user_savepassword=array(
                        "user_id"=>$user_id,
                        "user_name"=>$user_name,
                        "user_password"=>$user_new_password
                    );
                    $rows=$USER_DB->save($parameter_user_savepassword);
                    if($rows)
                    {
                        $data["result"]=true;
                        $data["code"]="1000";
                        $data["message"]="修改密码成功";
                    }
                    else
                    {
                        $data["result"]=false;
                        $data["code"]="9999";
                        $data["message"]="修改密码失败";
                    }
                }
                else
                {
                    $data["result"]=false;
                    $data["code"]="1004";
                    $data["message"]="修改密码失败，原密码不正确";
                }
            }
            else
            {
                $data["result"]=false;
                $data["code"]="1005";
                $data["message"]="用户已存在";
            }
        }
        else
        {
            $data["result"]=false;
            $data["code"]="7777";
            $data["message"]="验证码错误";
        }
        return $this->ajaxReturn($data);
    }
}