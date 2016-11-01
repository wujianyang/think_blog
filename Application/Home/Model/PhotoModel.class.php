<?php
namespace Home\Model;
use Think\Model;

class PhotoModel extends Model{
    public $id;
    public $table='photo';
    public $table_alias='p';
    public $foreign_table='photo_img';
    public $foreign_table_alias='pi';
    public $foreign_table2='member';
    public $foreign_table2_alias='m';

    //分页配置属性
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='';
    public $com='eq';

    //获取用户的相册分类
    public function getPhotoByMemberId(){
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
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        $arr_field=array();
        $arr_field["$this->table_alias.id"]="photo_id";
        $arr_field["$this->table_alias.photo_title"]="photo_title";
        $arr_field["COUNT($this->foreign_table_alias.id)"]="photo_count";
        $arr_join=array();
        $arr_join[]="RIGHT JOIN $this->table $this->table_alias ON $this->table_alias.id=$this->foreign_table_alias.photo_id";
        $result=$this->table(array("$this->foreign_table"=>$this->foreign_table_alias))->field($arr_field)->join($arr_join)->where($arr_where)->group("$this->table_alias.id")->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册分类获取成功';
                $data['photo']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户相册分类没有数据';
            }
        }else{
            $data['msg']='用户相册分类获取失败';
        }

        return $data;
    }

    public function getCountByMemberId(){
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
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        $arr_field=array();
        $arr_field["COUNT($this->table_alias.id)"]="count";
        $arr_join=array();
        $arr_join[]="RIGHT JOIN $this->table $this->table_alias ON $this->table_alias.id=$this->foreign_table_alias.photo_id";
        $result=$this->table(array("$this->foreign_table"=>$this->foreign_table_alias))->field($arr_field)->join($arr_join)->where($arr_where)->group("$this->table_alias.id")->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册分类数量获取成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='用户相册分类数量没有数据';
            }
        }else{
            $data['msg']='用户相册分类数量获取失败';
        }

        return $data;
    }

    public function getPhotoList(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field('id,photo_title')->where(array('member_id'=>$this->member_id))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册分类获取成功';
                $data['photo']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户相册分类没有数据';
            }
        }else{
            $data['msg']='用户相册分类获取失败';
        }

        return $data;
    }

    public function getMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field('member_id')->where(array('id'=>$this->id))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户ID获取成功';
                $data['member_id']=$result[0]['member_id'];
            }else{
                $data['status']=1;
                $data['msg']='该用户ID没有相册';
            }
        }else{
            $data['msg']='用户ID获取失败';
        }

        return $data;
    }

    public function getPhoto_op(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field('id,photo_title')->where(array('id'=>$this->id))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='当前相册分类获取成功';
                $data['photo_op']=$result[0];
            }else{
                $data['status']=1;
                $data['msg']='当前相册分类没有数据';
            }
        }else{
            $data['msg']='当前相册分类获取失败';
        }

        return $data;
    }

    //用户添加相册分类
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add['photo_title']=$this->photo_title;
        $arr_add['member_id']=$this->member_id;
        $result=$this->data($arr_add)->add();
        if($result!==false){
            $data['status']=1;
            $data['msg']='添加成功';
        }else{
            $data['msg']='添加失败';
        }

        return $data;
    }

    //个人删除相册分类
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where['id']=array('IN',$this->id);
        $arr_where['member_id']=$this->member_id;
        $result=$this->where($arr_where)->delete();
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
        $result=$this->field('id,photo_title')->where($arr_where)->select();
        if($result!==false){
            $data['status']=1;
            $data['msg']='查询成功';
            $data['photo']=$result[0];
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
        $arr_edit['photo_title']=$this->photo_title;
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