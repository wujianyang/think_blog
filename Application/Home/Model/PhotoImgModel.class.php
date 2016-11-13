<?php
namespace Home\Model;
use Home\Model;

class PhotoImgModel extends CommonModel{
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

    //根据相册ID获取相片列表
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

    //根据相册ID获取相片数量
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
    /*public function personAdd(){
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
    }*/

    //个人删除相片
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //获取相片本地路径信息
        $imgSrcResult=$this->field('img_src')->where(array('id'=>array('IN',$this->id)))->select();
        $arr_where=array();
        $arr_where['id']=array('IN',$this->id);
        $arr_where['member_id']=$this->member_id;
        $result=$this->where($arr_where)->delete();
        if($result!==false){
            $data['status']=1;
            $data['msg']='删除成功';
            foreach($imgSrcResult as $imgSrc){  //在空间中删除相片
                if(file_exists(C('ROOT').C('UPLOAD').$imgSrc['img_src'])){
                    if(!stristr($imgSrc['img_src'],'default')){
                        unlink(C('ROOT').C('UPLOAD').$imgSrc['img_src']);
                    }
                }
            }
        }else{
            $data['msg']='删除失败';
        }

        return $data;
    }


    //个人编辑相册分类
    /*public function personEdit(){
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
    }*/

    //个人相片列表
    public function personIndex(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(IS_AJAX){
            $this->photo_id=I('post.photo_id');
        }else{
            $this->photo_id=I('get.photo_id');
        }
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
        $result=$this->alias($this->table_alias)->join($arr_join)->field($arr_field)->where($arr_where)->limit($this->pageSize)->page($this->page)->select();
        if($result!==false){
            if(count($result)>0){
                $data['status']=1;
                $data['msg']='用户相册获取成功';
                $data['rows']=$result;
            }else{
                $data['status']=1;
                $data['msg']='用户相册没有数据';
            }
        }else{
            $data['msg']='用户相册获取失败';
        }

        return $data;
    }

    //个人相片列表数量
    public function personIndexCount(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(IS_AJAX){
            $this->photo_id=I('post.photo_id');
        }else{
            $this->photo_id=I('get.photo_id');
        }
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

    //验证数据
    public function setValidata($f=''){
        if(empty($this->img_title) && !preg_match("/^[\w]{4,}$/",$this->img_title)){
            return '相片名称验证失败';
        }

        if(isset($this->img_src) && !empty($this->img_src)) {
            $uploadConfig=array('name' => 'img_src',
                'maxSize'   =>  1000000,
                'exts'      =>  array('png','jpg','jpeg','gif'),
                'rootPath'  =>  C('ROOT').C('UPLOAD_PATH'),
                'savePath'  =>  'photo_img/',
                'saveName'  =>  'photo_img_'.time(),
                'autoSub'   =>  false);
            $resultUpload=$this->upload($uploadConfig);
            if($resultUpload['status']==1 && $resultUpload['upload']['img_src']['savename']!=''){
                $this->img_src=$uploadConfig['savePath'].$resultUpload['upload']['img_src']['savename'];
            }else{
                return $resultUpload['msg'];
            }
        }elseif($f!='edit'){    //编辑时验证
            return "相片验证失败";
        }

        return true;
    }

    //创建提交数据数组
    public function create_Data($f=''){
        $arr=array();
        $arr['img_title']=$this->img_title;
        if(!empty($this->img_src)){
            $arr['img_src']=$this->img_src;
        }

        return $arr;
    }
}