<?php
namespace Admin\Model;
use Admin\Model;


class PhotoModel extends CommonModel{
    public $table='photo';
    public $table_alias='p';
    public $foreign_table='member';
    public $foreign_table_alias='m';

    public function index(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem!='member_name'){
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='id';
        $arr_field[$this->table_alias.'.photo_title']='photo_title';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';

        $result=$this->alias($this->table_alias)->join("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id")->field($arr_field)->where($arr_where)->page($this->page)->limit($this->pageSize)->select();
        return $result;
    }

    public function getCount(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem!='member_name'){
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $result=$this->alias($this->table_alias)->join("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id")->field(array("count($this->table_alias.id)"=>'count'))->where($arr_where)->select();
        return $result;
    }

    //批量删除信息
    public function delData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $this->startTrans();
        $photoImg=D('PhotoImg');
        //删除本表数据放在最后，$result和$result2顺序不能改变，否则因外键约束而导致删除失败
        $result=$photoImg->where(array('photo_id'=>array('in',$this->id)))->delete();
        $result2=$this->where(array('id'=>array('in',$this->id)))->delete();
        if($result && $result2){
            $this->commit();
            $data['msg']='删除成功';
            $data['status']=1;
        }else{
            $this->rollback();
            $data['msg']='删除失败';
        }

        return $data;
    }

    public function setValidata($f=''){
        $title=$this->photo_title;
        if(empty($this->photo_title) && !preg_match("/^.{4,}$/",$this->photo_title)){
            return "相册名称验证失败";
        }
        if(empty($this->member_id) && !preg_match("/^[\d]{1,}$/",$this->member_id)){
            return "用户名验证失败";
        }else{
            if(!$this->isExistsMemberId($this->member_id)){
                return "用户名不存在";
            }
        }
        return true;
    }

    public function create_Data($f=''){
        $arr=array();
        $arr['photo_title']=$this->photo_title;
        $arr['member_id']=$this->member_id;

        return $arr;
    }

    //获取相册ID和相册名称
    public function getPhoto(){
        $data=array();
        $result=$this->field(array('id','photo_title'))->where(array('member_id'=>$this->member_id))->select();
        $data['rows']=$result;
        return $data;
    }

}