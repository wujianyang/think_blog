<?php
namespace Home\Model;
use Think\Model;
require_once C('ROOT').C('FUNC').'func.php';
class ArticleModel extends Model{
    public $id;
    public $table='article';
    public $table_alias='a';
    public $foreign_table='member';
    public $foreign_table_alias='m';
    public $foreign_table2='article_type';
    public $foreign_table2_alias='at';
    public $foreign_table3='article_comment';
    public $foreign_table3_alias='ac';

    //分页和搜索配置信息
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='id';
    public $com='eq';

    //根据条件查找文章
    public function getArticleByTitle(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        //字段数组date_format(create_time,'%Y-%m-%d') as create_time
        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='article_id';
        $arr_field[$this->table_alias.'.title']='title';
        $arr_field["date_format($this->table_alias.create_time,'%Y-%m-%d')"]='create_time';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id";

        $result=$this->alias($this->table_alias)->field($arr_field)->join($arr_join)->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户文章列表获取成功';
                $data['hotArticle']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户文章列表没有数据';
            }
        }else{
            $data['msg']='用户文章列表获取失败';
        }

        return $data;
    }

    public function getArticleCountByTitle(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        //字段数组
        $arr_field=array();
        $arr_field["COUNT($this->table_alias.id)"]='count';
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id";

        $result=$this->alias($this->table_alias)->field($arr_field)->join($arr_join)->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户文章列表数量获取成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='用户文章列表没有数据';
            }
        }else{
            $data['msg']='用户文章列表数量获取失败';
        }

        return $data;
    }

    //获取文章标题
    public function getTitleByArticleId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where["id"]=$this->id;
        $result=$this->field("title")->where($arr_where)->select();
        if($result!==false){
            $data['status']=1;
            $data['msg']='获取文章标题成功';
            $data['title']=$result[0]['title'];
        }else{
            $data['msg']='获取文章标题失败';
        }
        return $data;
    }


    //根据文章ID获取详细文章信息
    public function getArticleByArticleId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='article_id';
        $arr_field[$this->table_alias.'.title']='title';
        $arr_field[$this->table_alias.'.content']='content';
        $arr_field[$this->table_alias.'.hitnum']='hitnum';
        $arr_field[$this->table_alias.'.create_time']='create_time';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        $arr_field[$this->table_alias.'.article_type_id']='article_type_id';
        $arr_field[$this->foreign_table2_alias.'.article_type_name']='article_type_name';
        $arr_field["COUNT($this->foreign_table3_alias.id)"]='article_comment_count';

        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->table $this->table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id";
        $arr_join[]="LEFT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id";
        $arr_join[]="LEFT JOIN $this->foreign_table3 $this->foreign_table3_alias ON $this->table_alias.id=$this->foreign_table3_alias.article_id";

        $result=$this->table(array("$this->foreign_table"=>$this->foreign_table_alias))->field($arr_field)->join($arr_join)->where(array("$this->table_alias.id"=>$this->id))->group("$this->table_alias.id")->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='文章信息获取成功';
                $result=html_decode($result,'content');
                $data['article']=$result[0];
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='文章信息获取失败';
        }
        return $data;
    }

    /*//获取用户文章列表
    public function getArticleByMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            if($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }

        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        //字段数组
        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='article_id';
        $arr_field[$this->table_alias.'.title']='title';
        $arr_field[$this->table_alias.'.content']='content';
        $arr_field[$this->table_alias.'.hitnum']='hitnum';
        $arr_field[$this->table_alias.'.create_time']='create_time';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        $arr_field[$this->table_alias.'.article_type_id']='article_type_id';
        $arr_field[$this->foreign_table2_alias.'.article_type_name']='article_type_name';
        $arr_field["COUNT($this->foreign_table3_alias.id)"]='article_comment_count';
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->table $this->table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id";
        $arr_join[]="LEFT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id";
        $arr_join[]="LEFT JOIN $this->foreign_table3 $this->foreign_table3_alias ON $this->table_alias.id=$this->foreign_table3_alias.article_id";

        $result=$this->table(array("$this->foreign_table"=>$this->foreign_table_alias))->field($arr_field)->join($arr_join)->where($arr_where)->group("$this->table_alias.id")->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户文章列表获取成功';
                $data['article']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户文章列表没有数据';
            }
        }else{
            $data['msg']='用户文章列表获取失败';
        }

        return $data;
    }*/
    //根据文章分类ID获取文章列表
    public function getArticleByArticleTypeId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field("id,title,date_format(create_time,'%Y-%m-%d') as create_time")->where(array('article_type_id'=>$this->article_type_id))->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章列表成功';
                $data['article']=$result;
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章列表失败';
        }
        return $data;
    }

    //根据文章分类ID获取记录条数
    public function getCountByArticleId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field("COUNT(id) as count")->where(array('article_type_id'=>$this->article_type_id))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章记录总数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章记录总数失败';
        }

        return $data;
    }

    /*//根据用户ID获取记录条数
    public function getCountByMemberId(){
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
            }elseif($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;

        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id";

        //$result=$this->table(array("$this->foreign_table"=>$this->foreign_table_alias))->field("COUNT(id) as count")->join($arr_join)->where($arr_where)->group("$this->table_alias.id")->select();
        $result=$this->alias($this->table_alias)->join($arr_join)->field("COUNT($this->table_alias.id) as count")->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章记录总数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章记录总数失败';
        }

        return $data;
    }*/

    //获取用户文章分类信息
    public function getArticleTypeByMemberId(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_field=array();
        $arr_field["$this->foreign_table2_alias.id"]='article_type_id';
        $arr_field["$this->foreign_table2_alias.article_type_name"]='article_type_name';
        $arr_field["COUNT($this->table_alias.id)"]='article_count';
        $arr_join=array();
        $arr_join[]="RIGHT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->foreign_table2_alias.id=$this->table_alias.article_type_id";

        $result=$this->alias($this->table_alias)->field($arr_field)->join($arr_join)->where(array("$this->foreign_table2_alias.member_id"=>$this->member_id))->group("$this->foreign_table2_alias.id")->limit($this->pageSize)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取用户文章分类成功';
                $data['article_type']=$result;
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取用户文章分类失败';
        }
        return $data;
    }

    //获取热门文章排行
    public function getHotArticle(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_field=array();
        $arr_field["id"]="article_id";
        $arr_field["title"]="title";
        $arr_field["hitnum"]="hitnum";
        $arr_field["date_format(create_time,'%Y-%m-%d')"]="create_time";
        $result=$this->field($arr_field)->where(array("member_id"=>$this->member_id,'hitnum'=>array('gt','0')))->order(array("hitnum"=>"desc"))->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取用户热门文章成功';
                $data['hotArticle']=$result;
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取用户热门文章失败';
        }

        return $data;
    }

    //获取热门文章排行记录数
    public function getHotArticleCount(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->field('count(id) as count')->where(array('member_id'=>$this->member_id,'hitnum'=>array('gt',0)))->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取用户热门文章记录数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取用户热门文章记录数失败';
        }

        return $data;
    }

    //个人添加文章
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add['title']=$this->title;
        $arr_add['member_id']=$this->member_id;
        $arr_add['article_type_id']=$this->article_type_id;
        $arr_add['content']=$this->content;
        $arr_add['hitnum']=0;
        $arr_add['create_time']=date("Y-m-d h:i:s",time());
        $result=$this->data($arr_add)->add();
        if($result!==false){
            $data['status']=1;
            $data['msg']='添加成功';
        }else{
            $data['msg']='添加失败';
        }
        return $data;
    }

    //个人编辑文章
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_add=array();
        $arr_add['title']=$this->title;
        $arr_add['article_type_id']=$this->article_type_id;
        $arr_add['content']=$this->content;

        $arr_where=array();
        $arr_where['id']=$this->id;
        $arr_where['member_id']=$this->member_id;
        $result=$this->data($arr_add)->where($arr_where)->save();
        if($result!==false){
            $data['status']=1;
            $data['msg']='编辑成功';
        }else{
            $data['msg']='编辑失败';
        }
        return $data;
    }

    //用户删除文章
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $arr_where=array();
        $arr_where["id"]=array("IN",$this->id);
        $result=$this->where($arr_where)->delete();
        if($result!==false){
            $data['status']=1;
            $data['msg']='删除成功';
        }else{
            $data['msg']='删除失败';
        }
        return $data;
    }

    //判断文章ID是否存在
    public function isExistsArticleId(){
        $result=$this->field('id')->where(array('id'=>$this->id))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }

    //个人文章列表
    public function personIndex(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //条件数组
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%$this->key%";
            }
            if($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }

        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;
        //字段数组
        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='article_id';
        $arr_field[$this->table_alias.'.title']='title';
        $arr_field[$this->table_alias.'.content']='content';
        $arr_field[$this->table_alias.'.hitnum']='hitnum';
        $arr_field[$this->table_alias.'.create_time']='create_time';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->table_alias.'.article_type_id']='article_type_id';
        $arr_field[$this->foreign_table2_alias.'.article_type_name']='article_type_name';
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id";


        $result=$this->alias($this->table_alias)->join($arr_join)->field($arr_field)->where($arr_where)->page($this->page)->limit($this->pageSize)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户文章列表获取成功';
                $data['rows']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户文章列表没有数据';
            }
        }else{
            $data['msg']='用户文章列表获取失败';
        }

        return $data;
    }

    //个人文章列表数量
    public function personIndexCount(){
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
            }elseif($this->keyItem=='article_type_name'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }
        $arr_where["$this->table_alias.member_id"]=$this->member_id;

        $arr_field=array();
        $arr_field["COUNT($this->table_alias.id)"]='count';
        //多表查询条件数组
        $arr_join=array();
        $arr_join[]="LEFT JOIN $this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.article_type_id=$this->foreign_table2_alias.id";


        $result=$this->alias($this->table_alias)->join($arr_join)->field($arr_field)->where($arr_where)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='获取文章记录总数成功';
                $data['count']=$result[0]['count'];
            }else{
                $data['status']=1;
                $data['msg']='没有数据';
            }
        }else{
            $data['msg']='获取文章记录总数失败';
        }

        return $data;
    }
}