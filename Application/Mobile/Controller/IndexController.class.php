<?php
namespace Mobile\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $CHANNEL_DB=M("Channel");
        $BASE_DB=M("Base");
        $channel_first_row=$CHANNEL_DB->field("channel_id")->order("channel_sort desc,channel_id asc")->find();  //条件查询第一条数据
        $channel_id=I("id",$channel_first_row["channel_id"]);  //如果为空默认第一条
        $channel_row=$CHANNEL_DB->find($channel_id);  //条件查询播放的频道
        $channel_link=$channel_row["channel_link_m"];   //获取视频来源
        $parameter_channel_select=array(
            "where"=>array("channel_show"=>"1")
        );
        $channel_rows=$CHANNEL_DB->field("channel_id,channel_title")->where($parameter_channel_select["where"])->order("channel_sort desc,channel_id asc")->select();  //条件查询所有频道
        $base_row=$BASE_DB->find();  // 获取网站的基信息
        $this->assign("channel_link",$channel_link);
        $this->assign("channel_id",$channel_id);
        $this->assign("channel_rows",$channel_rows);
        $this->assign("base_row",$base_row);
        $this->display();
    }
}