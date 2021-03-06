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
                    "program_content"=>array("like","%".$searchname."%"),
                    "program_level"=>array("like","%%"),
                    "a.program_level=b.channel_id"   //program与channel关联，a为program，b为channel（在ProgramModel中定义）
                )
            );
        }
        else
        {
            $parameter_program_select=array(
                "where"=>array(
                    "program_content"=>array("like","%".$searchname."%"),
                    "program_level"=>array("in",$channel),
                    "a.program_level=b.channel_id"   //program与channel关联，a为program，b为channel（在ProgramModel中定义）
                )
            );
        }
        //节目单条件查询
        $custom_paging=5;  //设置每页显示的条数
        $program_rows=$PROGRAM_DB->scope("program_select",$parameter_program_select)->limit(($p-1)*$custom_paging,$custom_paging)->order("program_sort desc,program_id asc")->select();
        $program_count=count($PROGRAM_DB->scope("program_select",$parameter_program_select)->select());
        $program_page = new \Think\Page($program_count,$custom_paging);// 实例化分页类
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
        $program_content=I("program_content");
        $program_sort=I("program_sort");
        $data=array();
        $parameter_program_edit=array(
            "where"=>array(
                "program_id"=>$program_id,
                "program_level"=>$program_level,
                "program_content"=>$program_content,
                "program_sort"=>$program_sort,
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
        $program_content=I("program_content");
        $program_sort=I("program_sort");
        $data=array();
        $parameter_program_add=array(
            "where"=>array(
                "program_level"=>$program_level,
                "program_content"=>$program_content,
                "program_sort"=>$program_sort,
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
     * 采集节目单
     */
    public function collection()
    {
        header("Content-Type: text/html;charset=utf-8");
        $CHANNEL_DB=D("Channel");
        $PROGRAM_DB=D("Program");
        $channel_rows=$CHANNEL_DB->field("channel_web,channel_rule,channel_filter,channel_id")->select();
        foreach ($channel_rows as $channel_row)
        {
            if(!empty($channel_row["channel_web"])&&!empty($channel_row["channel_rule"]))
            {
                //删除之前的节目单
                $parameter_program_delete=array(
                    "where"=>array(
                        "program_level"=>$channel_row["channel_id"],
                    )
                );
                $list=$PROGRAM_DB->where($parameter_program_delete["where"])->delete();
                //采集网页地址
                $url=htmlspecialchars_decode($channel_row["channel_web"]); //将html语言反转义
                //获取页面代码
                $source=file_get_contents($url);
                //设置匹配正则
                 $search = htmlspecialchars_decode($channel_row["channel_rule"]); //将html语言反转义
                //采集
                preg_match_all($search,$source,$datas);
                //将采集到的数据添加到数据库
                foreach ($datas[0] as $data)
                {
                    //去掉过滤的字段
                    $filters=explode("_",$channel_row["channel_filter"]);
                    foreach ($filters as $filter)
                    {
                        $data=strip_tags(str_replace($filter,'',$data));
                    }
                    if($data!="")
                    {
                        $parameter_program_add=array(
                            "where"=>array(
                                "program_level"=>$channel_row["channel_id"],
                                "program_content"=>$data,
                                "program_sort"=>0,
                            )
                        );
                        $row=$PROGRAM_DB->add($parameter_program_add["where"]);
                    }
                }

            }
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
        $channel_rows=$CHANNEL_DB->scope("channel_select",$parameter_channel_select)->order("channel_sort desc,channel_id asc")->select();
        return $channel_rows;
    }
}