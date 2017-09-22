<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $CHANNEL_DB=D("Channel");
        $BASE_DB=M("Base");
        $PROGRAM_DB=D("Program");
        $searchname=I("searchname");
//        $channel_first_row=$CHANNEL_DB->scope("channel_select")->order("channel_sort desc,channel_id asc")->find();  //条件查询第一条数据
//        $channel_id=I("id",$channel_first_row["channel_id"]);  //如果为空默认第一条
        $channel_id=I("id");
        $channel_row=$CHANNEL_DB->find($channel_id);  //条件查询播放的频道
        $channel_link=$channel_row["channel_link"];   //获取视频来源
        $parameter_channel_select=array(
            "where"=>array(
                "channel_show"=>"1",
                "channel_title"=>array("like","%".$searchname."%")
            )
        );
        $channel_rows=$CHANNEL_DB->scope("channel_select",$parameter_channel_select)->order("channel_sort desc,channel_id asc")->select();  //条件查询所有频道
        //节目单
        $parameter_program_bylevel=array(
            "where"=>array(
                "program_level"=>$channel_id
            )
        );
        $program_rows=$PROGRAM_DB->scope("program_select",$parameter_program_bylevel)->order("program_sort desc,program_id asc")->select();
        $base_row=$BASE_DB->find();  // 获取网站的基信息
        $this->assign("channel_link",$channel_link);
        $this->assign("channel_id",$channel_id);
        $this->assign("channel_rows",$channel_rows);
        $this->assign("program_rows",$program_rows);
        $this->assign("base_row",$base_row);
        $this->assign("searchname",$searchname);
        $this->display();
    }
    /*
     * 切换视频
     */
    public function play(){
        $CHANNEL_DB=D("Channel");
        $PROGRAM_DB=D("Program");
        $channel_id=I("channel_id");
        $searchname=I("searchname");
        //查询频道
        $parameter_channel_select=array(
            "where"=>array(
                "channel_show"=>"1",
                "channel_title"=>array("like","%".$searchname."%")
            )
        );
        $channel_lists=$CHANNEL_DB->scope("channel_select",$parameter_channel_select)->order("channel_sort desc,channel_id asc")->select();  //条件查询所有频道
        //查询要播放的频道
        $parameter_channel_byid=array(
            "where"=>array(
                "channel_id"=>$channel_id
            )
        );
        $channel_row=$CHANNEL_DB->scope("find_channel_byid",$parameter_channel_byid)->find();
        //加载节目单
        $parameter_program_bylevel=array(
            "where"=>array(
                "program_level"=>$channel_id
            )
        );
        $program_rows=$PROGRAM_DB->scope("program_select",$parameter_program_bylevel)->order("program_sort desc,program_id asc")->select();
        //输入频道列表
        $data["channel"]="";
        foreach ($channel_lists as $channel_list)
        {
            $data["channel"].="<a href=\"javascript:void(0)\" onclick=\"playvideo(".$channel_list["channel_id"].")\">";
            if($channel_list["channel_id"]==$channel_id)
            {
                $data["channel"].="<li style=\"background: #fff;\">";
            }
            else
            {
                $data["channel"].="<li>";
            }
                $data["channel"].=$channel_list["channel_title"];
                $data["channel"].="</li>";
            $data["channel"].="</a>";
        }
        //输入要播放的视频代码和视频来源
        $data["main"]="<iframe style=\"margin: 8% auto;\" frameborder=\"0\" height=\"80%\" width=\"100%\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" border=\"0\" src=\"".$channel_row["channel_link"]."\"></iframe>";
        $data["source"]="视频来源：".$channel_row["channel_link"];
        //输入节目单部分的代码
        $data["program"]="";
        foreach($program_rows as $program_row)
        {
            $data["program"].="<li>".$program_row["program_content"]."</li>";
        }
        if($data["program"]=="")
        {
            $data["program"].="<li>暂时没有节目单</li>";
        }
        $data["searchname"]=$searchname;
        return $this->ajaxReturn($data);
    }
}