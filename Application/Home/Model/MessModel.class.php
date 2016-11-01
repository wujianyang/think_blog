<?php
namespace Home\Model;
use Think\Model;
require_once C('ROOT').C('FUNC').'func.php';
class MessModel extends Model{
    public $id;
    public $table='mess';
    public $table_alias='ms';
    public $foreign_table='member';
    public $foreign_table_alias='m';
    //分页配置信息
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='';
    public $com='eq';

    public function getMessByMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';


        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }
        $arr_where["$this->table_alias.messed_id"]=$this->messed_id;
        $arr_field=array();
        $arr_field["$this->table_alias.id"]="mess_id";
        $arr_field["$this->table_alias.messer_id"]="messer_id";
        $arr_field["$this->foreign_table_alias.member_name"]="member_name";
        $arr_field["$this->foreign_table_alias.head_pic"]="head_pic";
        $arr_field["$this->table_alias.content"]="content";
        $arr_field["$this->table_alias.mess_time"]="mess_time";
        $arr_join=array();
        $arr_join[]="INNER JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.messer_id=$this->foreign_table_alias.id";
        $result=$this->alias("$this->table_alias")->field($arr_field)->join($arr_join)->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $result=html_decode($result,'content');
                $data['status']=1;
                $data['msg']='用户留言板获取成功';
                $data['mess']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户留言板没有数据';
            }
        }else{
            $data['msg']='用户留言板获取失败';
        }
        return $data;
    }

    //获取留言板总记录数
    public function getCount(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }
        $arr_where["$this->table_alias.messed_id"]=$this->messed_id;
        $arr_join=array();
        $arr_join[]="INNER JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.messer_id=$this->foreign_table_alias.id";
        $result=$this->alias("$this->table_alias")->field("COUNT($this->table_alias.id) as count")->join($arr_join)->where($arr_where)->select();

        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户留言板总记录数获取成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='用户留言板总记录数没有数据';
            }
        }else{
            $data['msg']='用户留言板总记录数获取失败';
        }
        return $data;
    }

    //用户留言
    public function mess(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add["messer_id"]=$this->messer_id;
        $arr_add["content"]=$this->content;
        $arr_add["messed_id"]=$this->messed_id;
        $arr_add["mess_time"]=date("Y-m-d h:i:s",time());
        $result=$this->data($arr_add)->add();
        if($result!==false){
            $data['status']=1;
            $data['msg']='留言成功';
        }else{
            $data['msg']='留言失败';
        }
        return $data;
    }

    //用户删除留言
    public function personDel(){
        $data=array();
        $data['status']=1;
        $data['msg']='';

        $arr_where=array();
        $arr_where["id"]=array('IN',$this->id);
        $arr_where["messed_id"]=$this->messed_id;
        $result=$this->where($arr_where)->delete();
        if($result!==false){
            $data['status']=1;
            $data['msg']='删除成功';
        }else{
            $data['msg']='删除失败';
        }
        return $data;
    }
}