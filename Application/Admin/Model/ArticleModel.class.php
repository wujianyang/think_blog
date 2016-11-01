<?php
namespace Admin\Model;
use Admin\Model;

class ArticleModel extends CommonModel{
    public $table='article';
    public $table_alias='a';
    public $foreign_table='member';
    public $foreign_table_alias='m';
    public $foreign_table2='article_type';
    public $foreign_table2_alias='at';

    public function index(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }elseif($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='id';
        $arr_field[$this->table_alias.'.title']='title';
        $arr_field[$this->table_alias.'.content']='content';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        $arr_field[$this->foreign_table2_alias.'.article_type_name']='article_type_name';
        $arr_field[$this->table_alias.'.hitnum']='hitnum';
        $arr_field[$this->table_alias.'.create_time']='create_time';

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id","$this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id"))->field($arr_field)->where($arr_where)->page($this->page)->limit($this->pageSize)->select();
        return $result;
    }

    public function getCount(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }elseif($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id","$this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id"))->field(array("count($this->table_alias.id)"=>'count'))->where($arr_where)->select();
        return $result;
    }

    //获取文章标题信息
    public function getArticleTitle(){
        $arr_where["id"]=array('eq',$this->id);
        $result=$this->field(array('id','title'))->where($arr_where)->select();
        return $result;
    }

    //验证信息数据
    public function setValidata($f=''){
        if(empty($this->title) && !preg_match("/^.{6,}$/",$this->title)){
            return '文章标题验证失败';
        }

        if(empty($this->member_id) && !preg_match("/^[\d]{1,}$/",$this->member_id)){
            return '文章作者验证失败';
        }else{
            if(!$this->isExistsMemberId($this->member_id)){
                return '该作者不存在';
            }
        }

        if(empty($this->article_type_id) && !preg_match("/^[\d]{1,}$/",$this->article_type_id)){
            return '文章类型验证失败';
        }else{
            if(!$this->isExistsArticleTypeId($this->article_type_id)){
                return '该文章类型不存在';
            }
        }

        if(strlen($this->content)<10){
            return '文章内容验证失败';
        }

        if($f!='edit'){
            $this->hitnum=0;
            $this->create_time=date("Y-m-d h:i:s",time());
        }

        return true;
    }

    //创建提交信息数据数组
    public function create_Data($f=''){
        $arr=array();
        $arr['title']=$this->title;
        $arr['member_id']=$this->member_id;
        $arr['article_type_id']=$this->article_type_id;
        $arr['content']=$this->content;
        if($f!='edit'){
            $arr['hitnum']=$this->hitnum;
            $arr['create_time']=$this->create_time;
        }

        return $arr;
    }
}