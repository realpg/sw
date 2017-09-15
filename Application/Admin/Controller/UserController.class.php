<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class UserController extends CommonController{
    public function index()
    {
        $USER_DB=D("User");
        $p=I("p",1);  //当前页数
        $searchname=I("searchname","");  //搜索关键字
        $parameter_user_select=array(
            "where"=>array(
                "user_name"=>array("like","%".$searchname."%"),
            )
        );
        $user_rows=$USER_DB->scope("user_select",$parameter_user_select)->limit(($p-1)*CUSTOM_PAGING,CUSTOM_PAGING)->order("user_id asc")->select();
        $user_count=count($USER_DB->scope("user_select",$parameter_user_select)->select());
        $user_page = new \Think\Page($user_count,CUSTOM_PAGING);// 实例化分页类
        $page_show = $user_page->show();// 分页显示输出

        $this->assign('user_rows',$user_rows);// 赋值数据集
        $this->assign('user_count',$user_count);
        $this->assign('user_page',$user_page);
        $this->assign('page_show',$page_show);// 赋值分页输出
        $this->assign('searchname',$searchname==""?"搜索用户...":$searchname);// 当前搜索
        $this->display(); // 输出模板
    }
    public function add(){
        $this->display();
    }
    public function addDo(){
        $USER_DB=D("User");
        $user_name=I("user_name");
        $user_password=I("user_password");
        $user_password=md5($user_password); //对密码进行加密
        //检测用户是否存在
        $parameter_user_checkname=array(
            "where"=>array("user_name"=>$user_name)
        );
        $user_row=$USER_DB->scope("check_name",$parameter_user_checkname)->find();
        if(!$user_row)
        {
            //添加用户
            $parameter_user_adduser=array(
                "where"=>array(
                    "user_name"=>$user_name,
                    "user_password"=>$user_password
                ),
            );
            $row=$USER_DB->add($parameter_user_adduser["where"]);
            if($row)
            {
                $data["result"]=true;
                $data["code"]="1000";
                $data["message"]="添加用户成功";
            }
            else
            {
                $data["result"]=false;
                $data["code"]="1008";
                $data["message"]="用户添加失败";
            }
        }
        else
        {
            $data["result"]=false;
            $data["code"]="1005";
            $data["message"]="用户已存在";
        }
        return $this->ajaxReturn($data);
    }
    public function edit()
    {
        $USER_DB=D("User");
        $user=$_SESSION["user"];
        $user_id=I("user_id",$user["user_id"]);
        $parameter_user_byid=array(
            "where"=>array("user_id"=>$user_id)
        );
        $user_row=$USER_DB->scope("find_user_byid",$parameter_user_byid)->find();
        $this->assign("user_row",$user_row);
        $this->display();
    }
    public function editDo()
    {
        $USER_DB=D("User");
        $user_id=I("user_id");
        $user_name=I("user_name");
        $user_password=I("user_password");
        $user_new_password=I("user_new_password");
        $code=I("code");
        if($this->check_verify($code))
        {
            $judge=false; //作为是否可以修改用户信息的参数
            //判断用户名是否修改
            $parameter_user_byid=array(
                "where"=>array("user_id"=>$user_id)
            );
            $user_list=$USER_DB->scope("find_user_byid",$parameter_user_byid)->find();
            if($user_list["user_name"]==$user_name)
            {
                $judge=true;
            }
            else
            {
                //检测用户是否存在
                $parameter_user_checkname=array(
                    "where"=>array("user_name"=>$user_name)
                );
                $user_row=$USER_DB->scope("check_name",$parameter_user_checkname)->find();
                if(!$user_row)
                {
                    $judge=true;
                }
                else
                {
                    $judge=false;
                }
            }
            if($judge)
            {
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
    public function delete()
    {
        $USER_DB=D("User");
        $mm=$_REQUEST["mm"];
        $id =implode(",",$mm);
        $rows=$USER_DB->delete($id);
        if($rows)
        {
            $this->redirect("/Admin/User/index");
        }
        else
        {
            $this->redirect("/Admin/User/index");
        }
    }
}