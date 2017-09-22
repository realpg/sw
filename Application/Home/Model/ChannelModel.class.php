<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ChannelModel extends RelationModel{
    protected $_scope=array(
        //条件查询
        "channel_select"=>array(
            "field"=>array("channel_id","channel_title"),
            "where"=>array(
                "channel_title"=>array("like","%%"),
                "channel_show"=>"1",
            ),
        ),
        //根据id获取
        "find_channel_byid"=>array(
            "field"=>array("channel_id","channel_title","channel_link","channel_link_m","channel_sort","channel_show","channel_web","channel_rule","channel_filter"),
            "where"=>array(
                "channel_id"=>null
            )
        ),
    );
}