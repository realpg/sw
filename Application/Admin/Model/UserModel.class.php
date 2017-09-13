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
        //检测密码
        "check_password"=>array(
            "field"=>array("user_id","user_name"),
            "where"=>array(
                "user_name"=>"null",
                "user_password"=>"null"
                ),
        ),
    );
}