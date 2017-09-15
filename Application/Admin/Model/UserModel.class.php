<?php
namespace Admin\Model;
use Think\Model\RelationModel;
//use Think\Model;
class UserModel extends RelationModel{
    protected $_scope=array(
        //检测用户是否存在
        "check_name"=>array(
            "field"=>array("user_name"),
            "where"=>array("user_name"=>"null"),
        ),
        //检测密码（用于登陆页验证）
        "check_password"=>array(
            "field"=>array("user_id","user_name"),
            "where"=>array(
                "user_name"=>"null",
                "user_password"=>"null"
            ),
        ),
        //检测密码（用于用户修改信息）
        "check_user_password"=>array(
            "field"=>array("user_id","user_name"),
            "where"=>array(
                "user_id"=>"null",
                "user_password"=>"null"
            ),
        ),
        //条件查询
        "select_user"=>array(
            "field"=>array("user_id","user_name","user_password"),
            "where"=>array(
                "user_name"=>array("like","%%")
            ),
        ),
        //根据id获取用户
        "find_user_byid"=>array(
            "field"=>array("user_id","user_name"),
            "where"=>array(
                "user_id"=>null
            )
        ),
    );
}