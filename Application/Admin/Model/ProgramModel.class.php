<?php
namespace Admin\Model;
use Think\Model\RelationModel;
//use Think\Model;
class ProgramModel extends RelationModel{
    protected $_scope=array(
        //条件查询
        "program_select"=>array(
            "field"=>array("program_id","program_title","program_show","program_time","program_video","program_level","program_sort","channel_title"),
            "table"=>array(
                "program"=>"a",
                "channel"=>"b"
            ),
            "where"=>array(
                "program_title"=>array("like","%%"),
                "program_level"=>null,
                "a.program_level=b.channel_id"
            ),
        ),
        //根据id获取用户
        "find_program_byid"=>array(
            "field"=>array("program_id","program_title","program_show","program_time","program_video","program_level","program_sort","channel_title"),
            "table"=>array(
                "program"=>"a",
                "channel"=>"b"
            ),
            "where"=>array(
                "program_id"=>null,
                "a.program_level=b.channel_id"
            )
        ),
    );
}