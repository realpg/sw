<?php
namespace Admin\Model;
use Think\Model\RelationModel;
//use Think\Model;
class BaseModel extends RelationModel{
    protected $_scope=array(
        //查询信息
        "find_byid"=>array(
            "field"=>array("base_id","base_title","base_keywords","base_description","base_logo","base_copyright","base_record"),
            "where"=>array(
                "base_id"=>null
            )
        )
    );
}