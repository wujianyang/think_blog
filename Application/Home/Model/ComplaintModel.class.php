<?php
namespace Home\Model;
use Think\Model;

class ComplaintModel extends Model{
    public function complain(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $add_data=$this->create_Data();

        $result=$this->data($add_data)->add();
        if($result!==false){
            $data['msg']='申诉提交成功，请耐心等待审核';
            $data['status']=1;
        }else{
            $data['msg']='申诉提交失败，请重新申诉';
            $data['status']=0;
        }
        return $data;
    }

    //创建提交数据数组
    public function create_Data(){
        $arr=array();
        $arr['member_name']=$this->member_name;
        $arr['complain_content']=$this->complain_content;
        $arr['complain_time']=date("Y-m-d h:i:s",time());
        $arr['isPass']=0;
        return $arr;
    }
}