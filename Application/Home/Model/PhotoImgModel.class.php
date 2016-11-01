<?php
namespace Home\Model;
use Think\Model;

class PhotoImgModel extends Model{
    public $id;
    public $table='photo_img';
    public $table_alias='pi';
    public $foreign_table='photo';
    public $foreign_table_alias='p';
    //分页配置属性
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='';
    public $com='eq';

    public function getPhotoImg(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $arr_where["$this->table_alias.photo_id"]=$this->photo_id;
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.photo_id=$this->foreign_table_alias.id";
        $arr_field=array();
        $arr_field["$this->table_alias.id"]="id";
        $arr_field["$this->table_alias.img_title"]="img_title";
        $arr_field["$this->table_alias.img_src"]="img_src";
        $result=$this->alias($this->table_alias)->join($arr_join)->field($arr_field)->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册获取成功';
                $data['photoImg']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户相册没有数据';
            }
        }else{
            $data['msg']='用户相册获取失败';
        }

        return $data;
    }

    public function getPhotoImgCount(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $arr_where["$this->table_alias.photo_id"]=$this->photo_id;
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.photo_id=$this->foreign_table_alias.id";
        $arr_field=array();
        $arr_field["COUNT($this->table_alias.id)"]="count";
        $result=$this->alias($this->table_alias)->join($arr_join)->field($arr_field)->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册记录数获取成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='用户相册记录数没有数据';
            }
        }else{
            $data['msg']='用户相册记录数获取失败';
        }
        return $data;
    }

    //用户添加相册分类
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add['photo_id']=$this->photo_id;
        $arr_add['member_id']=$this->member_id;
        $arr_add['img_title']=$this->img_title;
        $arr_add['img_src']=$this->img_src;
        $result=$this->data($arr_add)->add();
        if($result!==false){
            $data['status']=1;
            $data['msg']='添加成功';
        }else{
            $data['msg']='添加失败';
        }

        return $data;
    }

    //个人删除相片
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where['id']=array('IN',$this->id);
        $arr_where['member_id']=$this->member_id;
        $result=$this->where($arr_where)->delete();
        $s=$this->getLastSql();
        if($result!==false){
            $data['status']=1;
            $data['msg']='删除成功';
        }else{
            $data['msg']='删除失败';
        }

        return $data;
    }

    //个人查看相册分类
    public function personInfo(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where['id']=$this->id;
        $arr_where['member_id']=$this->member_id;
        $result=$this->field('id,img_title,img_src')->where($arr_where)->select();
        if($result!==false){
            $data['status']=1;
            $data['msg']='查询成功';
            $data['photoImg']=$result[0];
        }else{
            $data['msg']='查询失败';
        }

        return $data;
    }

    //个人编辑相册分类
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_edit=array();
        $arr_edit['img_title']=$this->img_title;
        if(!empty($this->img_src)){
            $arr_edit['img_src']=$this->img_src;
        }
        $arr_where=array();
        $arr_where['id']=$this->id;
        $arr_where['member_id']=$this->member_id;
        $result=$this->data($arr_edit)->where($arr_where)->save();
        if($result!==false){
            $data['status']=1;
            $data['msg']='编辑成功';
        }else{
            $data['msg']='编辑失败';
        }

        return $data;
    }
}