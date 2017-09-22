<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class IndexController extends CommonController{
    public function index(){
        $this->display();
    }
    public function login(){
        $USER_DB=D("User");
        $data=array();
        $user_name=I("user_name");
        $user_password=I("user_password");
        $user_password=md5($user_password); //对密码进行加密
        $code=I("code");
        //检测用户是否存在
        $parameter_user_checkname=array(
            "where"=>array("user_name"=>$user_name)
        );
        $user_row=$USER_DB->scope("check_name",$parameter_user_checkname)->find();
        if($user_row)
        {
            //检测密码
            $parameter_user_checkpassword=array(
                "where"=>array(
                    "user_name"=>$user_name,
                    "user_password"=>$user_password
                )
            );
            $list=$USER_DB->scope("check_password",$parameter_user_checkpassword)->find();
            if($list)
            {
                if($this->check_verify($code))
                {
                    $data["result"]=true;
                    $data["code"]="1000";
                    $data["message"]="用户登录成功";
                    $user_session["user_id"]=$list["user_id"];
                    $user_session["user_name"]=$list["user_name"];
                    $_SESSION["user"]=$user_session;
                }
                else
                {
                    $data["result"]=false;
                    $data["code"]="7777";
                    $data["message"]="验证码错误";
                }
            }
            else
            {
                $data["result"]=false;
                $data["code"]="1001";
                $data["message"]="密码错误";
            }
        }
        else
        {
            $data["result"]=false;
            $data["code"]="1002";
            $data["message"]="用户不存在";
        }
        return $this->ajaxReturn($data);
    }
    /*
     * 采集节目单（之后加入——用于windows定时计划）
     */
    public function collection()
    {
        header("Content-Type: text/html;charset=utf-8");
        $CHANNEL_DB=D("Channel");
        $PROGRAM_DB=D("Program");
        $channel_rows=$CHANNEL_DB->field("channel_web,channel_rule,channel_filter,channel_id")->select();
        foreach ($channel_rows as $channel_row)
        {
            if(!empty($channel_row["channel_web"])&&!empty($channel_row["channel_rule"]))
            {
                //删除之前的节目单
                $parameter_program_delete=array(
                    "where"=>array(
                        "program_level"=>$channel_row["channel_id"],
                    )
                );
                $list=$PROGRAM_DB->where($parameter_program_delete["where"])->delete();
                //采集网页地址
                $url=htmlspecialchars_decode($channel_row["channel_web"]); //将html语言反转义
                //获取页面代码
                $source=file_get_contents($url);
                //设置匹配正则
                $search = htmlspecialchars_decode($channel_row["channel_rule"]); //将html语言反转义
                //采集
                preg_match_all($search,$source,$datas);
                //将采集到的数据添加到数据库
                foreach ($datas[0] as $data)
                {
                    //去掉过滤的字段
                    $filters=explode("_",$channel_row["channel_filter"]);
                    foreach ($filters as $filter)
                    {
                        $data=strip_tags(str_replace($filter,'',$data));
                    }
                    if($data!="")
                    {
                        $parameter_program_add=array(
                            "where"=>array(
                                "program_level"=>$channel_row["channel_id"],
                                "program_content"=>$data,
                                "program_sort"=>0,
                            )
                        );
                        $row=$PROGRAM_DB->add($parameter_program_add["where"]);
                    }
                }

            }
        }
    }
}