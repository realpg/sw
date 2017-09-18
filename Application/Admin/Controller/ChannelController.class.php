<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class ChannelController extends CommonController{
    public function index()
    {
        $CHANNEL_DB=D("Channel");
        $p=I("p",1);  //当前页数
        $searchname=I("searchname","");  //搜索关键字
        $parameter_channel_select=array(
            "where"=>array(
                "channel_title"=>array("like","%".$searchname."%"),
            )
        );
        $channel_rows=$CHANNEL_DB->scope("channel_select",$parameter_channel_select)->limit(($p-1)*CUSTOM_PAGING,CUSTOM_PAGING)->order("channel_sort desc,channel_id asc")->select();
        $channel_count=count($CHANNEL_DB->scope("channel_select",$parameter_channel_select)->select());
        $channel_page = new \Think\Page($channel_count,CUSTOM_PAGING);// 实例化分页类
        $page_show = $channel_page->show();// 分页显示输出

        $this->assign('channel_rows',$channel_rows);// 赋值数据集
        $this->assign('channel_count',$channel_count);
        $this->assign('channel_page',$channel_page);
        $this->assign('page_show',$page_show);// 赋值分页输出
        $this->assign('searchname',$searchname==""?"搜索用户...":$searchname);// 当前搜索
        $this->display(); // 输出模板
    }
    public function edit()
    {
        $CHANNEL_DB=D("Channel");
        $channel=$_SESSION["channel"];
        $channel_id=I("channel_id",$channel["channel_id"]);
        $parameter_channel_byid=array(
            "where"=>array("channel_id"=>$channel_id)
        );
        $channel_row=$CHANNEL_DB->scope("find_channel_byid",$parameter_channel_byid)->find();
        $this->assign("channel_row",$channel_row);
        $this->display();
    }
    public function editDo()
    {
        $CHANNEL_DB=D("Channel");
        $channel_id=I("channel_id");
        $channel_title=I("channel_title");
        $channel_link=I("channel_link");
        $channel_link_m=I("channel_link_m");
        $channel_sort=I("channel_sort");
        $channel_show=I("channel_show");
        $data=array();
        $parameter_channel_edit=array(
            "where"=>array(
                "channel_id"=>$channel_id,
                "channel_title"=>$channel_title,
                "channel_link"=>$channel_link,
                "channel_link_m"=>$channel_link_m,
                "channel_sort"=>$channel_sort,
                "channel_show"=>$channel_show
            )
        );
        $row=$CHANNEL_DB->save($parameter_channel_edit["where"]);
        if($row)
        {
            $data["result"]=true;
            $data["code"]="1000";
            $data["message"]="编辑成功";
        }
        else
        {
            $data["result"]=false;
            $data["code"]="9999";
            $data["message"]="编辑失败";
        }
        return $this->ajaxReturn($data);
    }
    public function add(){
        $this->display();
    }
    public function addDo(){
        $CHANNEL_DB=D("Channel");
        $channel_title=I("channel_title");
        $channel_link=I("channel_link");
        $channel_link_m=I("channel_link_m");
        $channel_sort=I("channel_sort");
        $channel_show=I("channel_show");
        $data=array();
        $parameter_channel_add=array(
            "where"=>array(
                "channel_title"=>$channel_title,
                "channel_link"=>$channel_link,
                "channel_link_m"=>$channel_link_m,
                "channel_sort"=>$channel_sort,
                "channel_show"=>$channel_show
            )
        );
        $row=$CHANNEL_DB->add($parameter_channel_add["where"]);
        if($row)
        {
            $data["result"]=true;
            $data["code"]="1000";
            $data["message"]="添加成功";
        }
        else
        {
            $data["result"]=false;
            $data["code"]="9999";
            $data["message"]="添加失败";
        }
        return $this->ajaxReturn($data);
    }
    public function delete()
    {
        $CHANNEL_DB=D("Channel");
        $mm=$_REQUEST["mm"];
        $id =implode(",",$mm);
        $rows=$CHANNEL_DB->delete($id);
        if($rows)
        {
            $this->redirect("/Admin/Channel/index");
        }
        else
        {
            $this->redirect("/Admin/Channel/index");
        }
    }
}