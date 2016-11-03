<?php
namespace Admin\Model;
use Admin\Model;
require_once C('ROOT').C('FUNC').'func.php';
class MemberModel extends CommonModel{

    public $id;
    public $table='member';
    public $table_alias='m';
    public $table_foreign='';
    public $table_foreign_alias='';
    public $table_foreign2='';
    public $table_foreign_alias2='';
    public $page=1;
    public $pageSize=10;
    public $key='';
    public $keyItem='';
    public $com='eq';
    public $sql='';


    //添加用户
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
            if(!empty(C('ROOT').C('UPLOAD').$this->head_pic) && file_exists(C('ROOT').C('UPLOAD').$this->head_pic)){
                unlink($this->head_pic);
            }
        }
        return $data;
    }

    //编辑用户
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
            if(!empty(C('ROOT').C('UPLOAD').$this->head_pic) && file_exists(C('ROOT').C('UPLOAD').$this->head_pic)){
                unlink($this->head_pic);
            }
        }
        return $data;
    }

    //批量删除信息
    public function delData(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $this->head_pic=D('Member')->field('head_pic')->where(array('id'=>array('in',$this->id)))->select();   //获取用户头像，删除用户同时删除头像
        /*if(!empty(C('ROOT').C('UPLOAD').$this->head_pic) && file_exists(C('ROOT').C('UPLOAD').$this->head_pic)) {*/
        if(count($this->head_pic)>0) {
            $this->startTrans();
            $article = D('Article');
            $articleType = D('ArticleType');
            $photo = D('Photo');
            $photoImg = D('PhotoImg');
            //删除本表数据放在最后，$result和$result2顺序不能改变，否则因外键约束而导致删除失败
            $result = $article->where(array('member_id' => array('in', $this->id)))->delete();
            $result2 = $articleType->where(array('member_id' => array('in', $this->id)))->delete();
            $result3 = $photoImg->where(array('member_id' => array('in', $this->id)))->delete();
            $result4 = $photo->where(array('member_id' => array('in', $this->id)))->delete();
            $result5 = $this->where(array('id' => array('in', $this->id)))->delete();
            if ($result!==false && $result2!==false && $result3!==false && $result4!==false && $result5!==false) {
                $this->commit();
                foreach($this->head_pic as $head_pic_arr){  //在空间中删除头像
                    if(file_exists(C('ROOT').C('UPLOAD').$head_pic_arr['head_pic'])){
                        if(!stristr($head_pic_arr['head_pic'],'default')){
                            unlink(C('ROOT').C('UPLOAD').$head_pic_arr['head_pic']);
                        }
                    }
                }
                $data['msg'] = '删除成功';
                $data['status'] = 1;
            } else {
                $this->rollback();
                $data['msg'] = '删除失败';
            }
        }else{
            $data['msg'] = '用户信息获取失败';
        }

        return $data;
    }

    //批量冻结或激活用户
    public function freezeUser($f=1){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if($f==1){
            $result=$this->data(array('is_freeze'=>1))->where(array('id'=>array('in',$this->id)))->save();
            if($result!==false){
                $data['msg']='冻结成功';
                $data['status']=1;
                $data['sql']=$this->getLastSql();
            }else{
                $data['msg']='冻结失败';
            }
        }elseif($f==0){
            $result=$this->data(array('is_freeze'=>0))->where(array('id'=>array('in',$this->id)))->save();
            if($result!==false){
                $data['msg']='激活成功';
                $data['status']=1;
            }else{
                $data['msg']='激活失败';
            }
        }


        return $data;
    }

    //批量重置用户密码
    public function resetPasswdUser(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $result=$this->data(array('passwd'=>C('USER_PASSWORD_DEFAULT')))->where(array('id'=>array('in',$this->id)))->save();
        if($result!==false){
            $data['msg']='重置成功';
            $data['status']=1;
        }else{
            $data['msg']='重置失败';
        }

        return $data;
    }

    //验证数据
    public function setValidata($f=''){
        if(empty($this->member_name) && !preg_match("/^[\w]{8,}$/",$this->member_name)){
            return '用户名验证失败';
        }else{
            if($f!='edit'){
                if($this->isExistsMemberName()){
                    return "用户名已存在，请重新输入";
                }
            }else{  //编辑时验证
                if(!$this->isSelfMemberName()){
                    if($this->isExistsMemberName()){
                        return "用户名已存在，请重新输入";
                    }
                }
            }


        }
        if($f!='edit'){
            if(empty($this->passwd) || !preg_match("/^.{6,}$/",$this->passwd)){
                return "登录密码验证失败";
            }else{
                $this->passwd=md5($this->passwd);
            }
        }

        if(empty($this->sex) && !preg_match("/^[0-1]$/",$this->sex)){
            return "性别验证失败";
        }
        if(empty($this->email) && !preg_match("/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/",$this->email)){
            return "email验证失败";
        }
        if(empty($this->tel) && !preg_match("/(1[\d]{10})|(\d{3,4}-\d{7,8})/",$this->tel)){
            return "电话验证失败";
        }
        if(empty($this->address) && !preg_match("/^[\w ]{6,}$/",$this->address)){
            return "地址验证失败";
        }
        if(empty($this->question) && !preg_match("/^[\w ]{6,}$/",$this->question)){
            return "密码问题验证失败";
        }
        if(empty($this->answer) && !preg_match("/^[\w ]{6,}$/",$this->answer)){
            return "密码答案验证失败";
        }
        if(isset($this->head_pic) && !empty($this->head_pic)) {
            $fileStatus=(array)upload_file($this->head_pic,'head_pic');
            if($fileStatus['status']==1){
                $this->head_pic='head_pic/'.$fileStatus['fileName'];
            }else{
                return $fileStatus['msg'];
            }
        }elseif($f!='edit'){    //编辑时验证
            return "用户头像验证失败";
        }
        if($f!='edit'){ //添加时赋初始值
            $this->hitnum=0;
            $this->is_freeze=0;
        }
        $this->last_ip=get_client_ip();
        $this->last_time=date("Y-m-d h:i:s",time());

        return true;
    }

    //创建提交数据数组
    public function create_Data($f=''){
        $arr=array();
        $arr['member_name']=$this->member_name;
        if($f!='edit'){
            $arr['passwd']=$this->passwd;
        }
        $arr['sex']=$this->sex;
        $arr['email']=$this->email;
        $arr['tel']=$this->tel;
        $arr['address']=$this->address;
        $arr['question']=$this->question;
        $arr['answer']=$this->answer;
        if(!empty($this->head_pic)){
            $arr['head_pic']=$this->head_pic;
        }
        if($f!='edit'){
            $arr['hitnum']=$this->hitnum;
            $arr['is_freeze']=$this->is_freeze;
        }
        $arr['last_ip']=$this->last_ip;
        $arr['last_time']=$this->last_time;

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

    //判断编辑用户名是否为自己
    public function isSelfMemberName(){
        $result=$this->where(array('id'=>$this->id,'member_name'=>$this->member_name))->select();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }

    //获取用户ID和用户名
    public function getMember(){
        $data=array();
        $result=$this->field(array('id','member_name'))->select();
        $data['rows']=$result;
        return $data;
    }
}