<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class ProgramController extends CommonController{
    public function index()
    {
        $PROGRAM_DB=D("Program");
        $p=I("p",1);  //当前页数
        $searchname=I("searchname","");  //搜索关键字
        $channel=I("channel","");  //获取频道
        if(empty($channel))
        {
            $parameter_program_select=array(
                "where"=>array(
                    "program_title"=>array("like","%".$searchname."%"),
                    "program_level"=>array("like","%%"),
                    "a.program_level=b.channel_id"   //program与channel关联，a为program，b为channel（在ProgramModel中定义）
                )
            );
        }
        else
        {
            $parameter_program_select=array(
                "where"=>array(
                    "program_title"=>array("like","%".$searchname."%"),
                    "program_level"=>array("in",$channel),
                    "a.program_level=b.channel_id"   //program与channel关联，a为program，b为channel（在ProgramModel中定义）
                )
            );
        }
        //节目单条件查询
        $program_rows=$PROGRAM_DB->scope("program_select",$parameter_program_select)->limit(($p-1)*CUSTOM_PAGING,CUSTOM_PAGING)->order("program_sort desc,program_id desc")->select();
        $program_count=count($PROGRAM_DB->scope("program_select",$parameter_program_select)->select());
        $program_page = new \Think\Page($program_count,CUSTOM_PAGING);// 实例化分页类
        $page_show = $program_page->show();// 分页显示输出

        //输出所有频道
        $channel_rows=$this->channel();

        $this->assign('program_rows',$program_rows);// 赋值数据集
        $this->assign('program_count',$program_count);
        $this->assign('program_page',$program_page);
        $this->assign('page_show',$page_show);// 赋值分页输出
        $this->assign('searchname',$searchname==""?"搜索用户...":$searchname);// 当前搜索
        $this->assign('channel',$channel);// 当前搜索频道
        $this->assign('channel_rows',$channel_rows);// 赋值数据集
        $this->display(); // 输出模板
    }
    public function edit()
    {
        $PROGRAM_DB=D("Program");
        $program=$_SESSION["program"];
        $program_id=I("program_id",$program["program_id"]);
        $parameter_program_byid=array(
            "where"=>array("program_id"=>$program_id)
        );
        $program_row=$PROGRAM_DB->scope("find_program_byid",$parameter_program_byid)->find();
        //输出所有频道
        $channel_rows=$this->channel();
        $this->assign("program_row",$program_row);
        $this->assign("program_level",$program_row["program_level"]);  //频道赋值
        $this->assign("channel_rows",$channel_rows);
        $this->display();
    }
    public function editDo()
    {
        $PROGRAM_DB=D("Program");
        $program_id=I("program_id");
        $program_level=I("program_level");
        $program_title=I("program_title");
        $program_video=I("program_video");
        $program_time=I("program_time");
        $program_sort=I("program_sort");
        $program_show=I("program_show");
        $data=array();
        $parameter_program_edit=array(
            "where"=>array(
                "program_id"=>$program_id,
                "program_level"=>$program_level,
                "program_title"=>$program_title,
                "program_video"=>$program_video,
                "program_time"=>$program_time,
                "program_sort"=>$program_sort,
                "program_show"=>$program_show
            )
        );
        $row=$PROGRAM_DB->save($parameter_program_edit["where"]);
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
        //输出所有频道
        $channel_rows=$this->channel();
        $this->assign("channel_rows",$channel_rows);
        $this->display();
    }
    public function addDo(){
        $PROGRAM_DB=D("Program");
        $program_level=I("program_level");
        $program_title=I("program_title");
        $program_video=I("program_video");
        $program_time=I("program_time");
        $program_sort=I("program_sort");
        $program_show=I("program_show");
        $data=array();
        $parameter_program_add=array(
            "where"=>array(
                "program_level"=>$program_level,
                "program_title"=>$program_title,
                "program_video"=>$program_video,
                "program_time"=>$program_time,
                "program_sort"=>$program_sort,
                "program_show"=>$program_show
            )
        );
        $row=$PROGRAM_DB->add($parameter_program_add["where"]);
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
        $PROGRAM_DB=D("Program");
        $mm=$_REQUEST["mm"];
        $id =implode(",",$mm);
        $rows=$PROGRAM_DB->delete($id);
        if($rows)
        {
            $this->redirect("/Admin/Program/index");
        }
        else
        {
            $this->redirect("/Admin/Program/index");
        }
    }
    /*
     * 输出所有频道
     */
    public function channel()
    {
        $CHANNEL_DB=D("Channel");
        //输出所有频道
        $parameter_channel_select=array(
            "where"=>array(
                "channel_title"=>array("like","%%"),
            )
        );
        $channel_rows=$CHANNEL_DB->scope("channel_select",$parameter_channel_select)->select();
        return $channel_rows;
    }
}