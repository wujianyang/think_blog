<?php
namespace Admin\Controller;
use Think\Controller;

class ComplaintController extends \Think\Controller{
    //用户申诉列表
    public function index(){
        $complaint=A('Common');
        $complaint->index('Complaint');
    }

    //通过审核
    public function pass(){

    }

    //忽略申诉
    public function ignore(){

    }
}