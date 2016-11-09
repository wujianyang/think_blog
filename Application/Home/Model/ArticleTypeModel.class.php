<?php
namespace Home\Model;
use Think\Model;

class ArticleTypeModel extends Model{
    public $id;
    public $table='article_type';
    public $table_alias='at';
    public $foreign_table='member';
    public $foreign_table_alias='m';
    public $foreign_table2='article';
    public $foreign_table2_alias='a';
    public $page=1;
    public $pageSize=10;

    //根据id获取用户ID
    public function getMemberIdById(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field('member_id')->where(array('id'=>$this->id))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取用户ID成功';
                $data['member_id']=$result[0]['member_id'];
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取用户ID失败';
        }

        return $data;
    }
    /*//根据用户ID获取文章分类
    public function getArticleTypeByMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);

        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        if($this->page==0){
            $result=$this->alias($this->table_alias)->field('id,article_type_name')->where($arr_where)->select();
        }else{
            $result=$this->alias($this->table_alias)->field('id,article_type_name')->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        }
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章分类成功';
                $data['articleType']=$result;
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章分类失败';
        }
        return $data;
    }*/

    /*public function getArticleTypeCountByMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        $result=$this->alias($this->table_alias)->field("COUNT(id) AS count")->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章分类总记录数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='获取文章分类总记录没有数据';
            }
        }else{
            $data['msg']='获取文章分类总记录数失败';
        }

        return $data;
    }*/

    public function getArticleType_op(){
        $result=$this->field('id,article_type_name')->where(array('id'=>$this->id))->select();
        return $result[0];
    }

    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add['article_type_name']=$this->article_type_name;
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

    //个人删除文章分类
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

    //个人查看文章分类
    public function personInfo(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where['id']=$this->id;
        $arr_where['member_id']=$this->member_id;
        $result=$this->field('id,article_type_name')->where($arr_where)->select();
        if($result!==false){
            $data['status']=1;
            $data['msg']='查询成功';
            $data['articleType']=$result[0];
        }else{
            $data['msg']='查询失败';
        }

        return $data;
    }

    //个人编辑文章分类
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_edit=array();
        $arr_edit['article_type_name']=$this->article_type_name;
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

    //个人文章分类列表
    public function personIndex(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_field=array();
        $arr_field["$this->table_alias.id"]="article_type_id";
        $arr_field["$this->table_alias.article_type_name"]="article_type_name";
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        /*if($this->page==0){
            $result=$this->alias($this->table_alias)->field('id,article_type_name')->where($arr_where)->select();
        }else{
            $result=$this->alias($this->table_alias)->field('id,article_type_name')->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        }*/
        $result=$this->alias($this->table_alias)->field($arr_field)->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章分类成功';
                $data['rows']=$result;
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章分类失败';
        }
        return $data;
    }

    //个人文章分类数量
    public function personIndexCount(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_field=array();
        $arr_field["COUNT($this->table_alias.id)"]="count";

        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        $result=$this->alias($this->table_alias)->field($arr_field)->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章分类总记录数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='获取文章分类总记录没有数据';
            }
        }else{
            $data['msg']='获取文章分类总记录数失败';
        }

        return $data;
    }
}