<?php
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller{
    //空操作_empty()方法
    function _empty(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Common:unfind");//显示自定义的404页面模版
    }

    function index(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Common:unfind");//显示自定义的404页面模版
    }
}