<?php
namespace Admin\Model;
use Admin\Model;
require_once C('ROOT').C('FUNC').'func.php';
class PhotoImgModel extends CommonModel{
    public $table='photo_img';
    public $table_alias='pi';
    public $foreign_table='member';
    public $foreign_table_alias='m';
    public $foreign_table2='photo';
    public $foreign_table2_alias='p';

    public function index(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }elseif($this->keyItem=='photo_title'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $arr_field=array();
        $arr_field[$this->table_alias.'.id']='id';
        $arr_field[$this->table_alias.'.img_title']='img_title';
        $arr_field[$this->table_alias.'.img_src']='img_src';
        $arr_field[$this->table_alias.'.member_id']='member_id';
        $arr_field[$this->table_alias.'.photo_id']='photo_id';
        $arr_field[$this->foreign_table_alias.'.member_name']='member_name';
        $arr_field[$this->foreign_table2_alias.'.photo_title']='photo_title';

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id","$this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.photo_id=$this->foreign_table2_alias.id"))->field($arr_field)->where($arr_where)->page($this->page)->limit($this->pageSize)->select();
        return $result;
    }

    public function getCount(){
        $arr_where=array();
        if($this->key!=''){
            if($this->keyItem=='member_name'){
                $arr_where["$this->foreign_table_alias.$this->keyItem"]=array($this->com,$this->key);
            }elseif($this->keyItem=='photo_title'){
                $arr_where["$this->foreign_table2_alias.$this->keyItem"]=array($this->com,$this->key);
            }else{
                $arr_where["$this->table_alias.$this->keyItem"]=array($this->com,$this->key);
            }
        }

        $result=$this->alias($this->table_alias)->join(array("$this->foreign_table $this->foreign_table_alias ON $this->table_alias.member_id=$this->foreign_table_alias.id","$this->foreign_table2 $this->foreign_table2_alias ON $this->table_alias.photo_id=$this->foreign_table2_alias.id"))->field(array("count($this->table_alias.id)"=>'count'))->where($arr_where)->select();
        return $result;
    }

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
            if(!empty(C('ROOT').C('UPLOAD').$this->img_src) && file_exists(C('ROOT').C('UPLOAD').$this->img_src)){
                unlink(C('ROOT').C('UPLOAD_PATH').$this->img_src);
            }
        }
        return $data;
    }

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
            if(!empty(C('ROOT').C('UPLOAD_PATH').$this->img_src) && file_exists(C('ROOT').C('UPLOAD').$this->img_src)){
                unlink(C('ROOT').C('UPLOAD_PATH').$this->img_src);
            }
        }
        return $data;
    }

    //批量删除信息
    public function delData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $this->img_src=D('PhotoImg')->field('img_src')->where(array('id'=>array('in',$this->id)))->select();   //获取相片数据
        if(count($this->img_src)>0){
            $result=$this->where(array('id'=>array('in',$this->id)))->delete();
            if($result!==false){
                foreach($this->img_src as $img_src_arr){  //在空间中删除相片
                    if(file_exists(C('ROOT').C('UPLOAD').$img_src_arr['img_src'])){
                        if(!stristr($img_src_arr['head_pic'],'default')){
                            unlink(C('ROOT').C('UPLOAD').$img_src_arr['img_src']);
                        }
                    }
                }
                $data['msg']='删除成功';
                $data['status']=1;
            }else{
                $data['msg']='删除失败';
            }
        }else{
            $data['msg'] = '相片信息获取失败';
        }

        return $data;
    }

    //验证数据
    public function setValidata($f=''){
        if(empty($this->img_title) && !preg_match("/^[\w]{4,}$/",$this->img_title)){
            return '相片名称验证失败';
        }
        if(empty($this->member_id) && !preg_match("/^[\d]{1,}$/",$this->member_id)){
            return "用户名验证失败";
        }else{
            if(!$this->isExistsMemberId($this->member_id)){
                return "用户名不存在";
            }
        }
        if(empty($this->photo_id) && !preg_match("/^[\d]{1,}$/",$this->photo_id)){
            return "相册名称验证失败";
        }else{
            if(!$this->isExistsPhotoId($this->photo_id)){
                return "相册名称不存在";
            }
        }

        if(isset($this->img_src) && !empty($this->img_src)) {
            $fileStatus=(array)upload_file($this->img_src,'photo_img');
            if($fileStatus['status']==1){
                $this->img_src='photo_img/'.$fileStatus['fileName'];
            }else{
                return $fileStatus['msg'];
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
        $arr['member_id']=$this->member_id;
        $arr['photo_id']=$this->photo_id;
        if(!empty($this->img_src)){
            $arr['img_src']=$this->img_src;
        }

        return $arr;
    }

    //判断是否已存在用户名
    public function isExistsMemberName(){
        $result=$this->where(array('member_name'=>$this->member_name))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }
}