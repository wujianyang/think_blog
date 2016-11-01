<?php
namespace Admin\Model;
use Admin\Model;

class ArticleCommentModel extends CommonModel{
    public $table='article_comment';
    public $table_alias='ac';
    public $foreign_table='member';
    public $foreign_table_alias='m';

    public function index(){
        $arr_where=array();
        $arr_where["$this->table_alias.article_id"]=array('eq',$this->article_id);
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='id';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        $arr_field[$this->table_alias.'.comment_content']='comment_content';
        $arr_field[$this->table_alias.'.comment_time']='comment_time';

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id"))->field($arr_field)->where($arr_where)->page($this->page)->limit($this->pageSize)->select();
        return $result;
    }

    public function getCount(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id"))->field(array("count($this->table_alias.id)"=>'count'))->where($arr_where)->select();
        return $result;
    }

    //获取文章标题信息
    public function getArticleTitle(){
        $article=D('Article');
        $article->id=$this->article_id;
        $articleInfo=$article->getArticleTitle();
        return $articleInfo;
    }
}