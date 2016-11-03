<?php
namespace Admin\Model;
use Think\Model;
class CommonModel extends Model{
    public $id;
    public $table='member';
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='';
    public $com='eq';
    public $sql='';

    //条件搜索显示列表
    public function index($f=''){
        $arr_where=array();
        if($this->key!=''){
            if($this->com=='like'){
                $this->key="%".$this->key."%";
            }
            $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
        }
        $result=$this->where($arr_where)->page($this->page)->limit($this->pageSize)->select();

        return $result;
    }

    //条件搜索显示记录数
    public function getCount(){
        $arr_where=array();
        if($this->key){
            $arr_where[$this->keyItem]=array($this->com,$this->key);
        }
        $resultCount=$this->field(array('count(id)'=>'count'))->where($arr_where)->select();

        return $resultCount;
    }

    //添加信息
    public function addData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $vali_result=$this->setValidata();
        if($vali_result===true){
            $add_data=$this->create_Data();
            $result=$this->data($add_data)->add();
            if($result!==false){
                $data['msg']='添加成功';
                $data['status']=1;
            }else{
                $data['msg']='添加失败';
                $data['status']=0;
            }
        }else{
            $data['msg']=$vali_result;
        }
        return $data;
    }

    //查询信息
    public function infoData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->where(array('id'=>array('eq',$this->id)))->select();
        if($result!==false){
            $data['msg']='获取数据成功';
            $data['status']=1;
            $data['rows']=$result;
        }else{
            $data['msg']='获取数据失败';
        }

        return $data;
    }

    //编辑信息
    public function editData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $vali_result=$this->setValidata('edit');
        if($vali_result===true){
            $edit_data=$this->create_Data('edit');
            $result=$this->data($edit_data)->where(array('id'=>$this->id))->save();
            if($result!==false){
                $data['msg']='编辑成功';
                $data['status']=1;
            }else{
                $data['msg']='编辑失败';
                $data['status']=0;
            }
        }else{
            $data['msg']=$vali_result;
        }
        return $data;
    }

    //批量删除信息
    public function delData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->where(array('id'=>array('in',$this->id)))->delete();
        if($result!==false){
            $data['msg']='删除成功';
            $data['status']=1;
        }else{
            $data['msg']='删除失败';
        }

        return $data;
    }

    //判断用户ID是否存在
    public function isExistsMemberId($member_id=''){
        $member=D('Member');
        $result=$member->field(array("count(id)"=>"count"))->where(array("id"=>$member_id))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }

    //判断相册ID是否存在
    public function isExistsPhotoId($photo_id=''){
        $photo=D('Photo');
        $result=$photo->field(array("count(id)"=>"count"))->where(array("id"=>$photo_id))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }

    //判断文章类别ID是否存在
    public function isExistsArticleTypeId($article_type_id=''){
        $articleType=D('ArticleType');
        $result=$articleType->field(array("count(id)"=>"count"))->where(array("id"=>$article_type_id))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }


    //验证信息数据
    public function setValidata($f=''){
        /*
         * 子类重写
         */
    }

    //创建提交信息数据数组
    public function create_Data($f=''){
        /*
         * 子类重写
         */
    }
}