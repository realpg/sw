<?php
namespace Home\Model;
use Think\Model\RelationModel;
//use Think\Model;
class ProgramModel extends RelationModel{
    protected $_scope=array(
        //条件查询
        "program_select"=>array(
            "field"=>array("program_content"),
            "where"=>array(
                "program_level"=>null,
            ),
        ),
        //根据id获取
        "find_program_byid"=>array(
            "field"=>array("program_id","program_content","program_time","program_level","program_sort","channel_title"),
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