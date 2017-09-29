<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
//use Think\Controller;
class BaseController extends CommonController{
    public function edit()
    {
        $BASE_DB=D("Base");
        $parameter_base_byid=array(
            "where"=>array("base_id"=>"1")
        );
        $base_row=$BASE_DB->scope("find_byid",$parameter_base_byid)->find();
        $this->assign("base_row",$base_row);
        $this->display();
    }
    public function editDo()
    {
        $BASE_DB=D("Base");
        $base_title=I("base_title");
        $base_keywords=I("base_keywords");
        $base_description=I("base_description");
        $base_copyright=I("base_copyright");
        $base_record=I("base_record");
        $data=array();
        $parameter_base_edit=array(
            "where"=>array(
                "base_id"=>"1",
                "base_title"=>$base_title,
                "base_keywords"=>$base_keywords,
                "base_description"=>$base_description,
                "base_copyright"=>$base_copyright,
                "base_record"=>$base_record
                )
        );
        $row=$BASE_DB->save($parameter_base_edit["where"]);
        if($row)
        {
            $data["result"]=true;
            $data["code"]="1000";
            $data["message"]="修改成功";
        }
        else
        {
            $data["result"]=false;
            $data["code"]="9999";
            $data["message"]="修改失败";
        }
        return $this->ajaxReturn($data);
    }
}