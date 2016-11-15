<?php
namespace Admin\Controller;
use Think\Controller;

class PhotoController extends Controller{
    public function index(){
        $photo=A('Common');
        $photo->index('Photo');
    }

    public function add(){
        if(isset($_POST['photo']) && !empty($_POST['photo'])){
            $photo=D('photo');
            $photo->photo_title=I('post.photo')['photo_title'];
            $photo->member_id=I('post.photo')['member_id'];
            $result=$photo->addData();
            unset($photo);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function info(){
        $photo=A('Common');
        $photo->info('Photo');
    }

    public function edit(){
        if(isset($_POST['photo']) && !empty($_POST['photo'])){
            $photo=D('Photo');
            $photo->id=I('post.photo')['id'];
            $photo->photo_title=I('post.photo')['photo_title'];
            $photo->member_id=I('post.photo')['member_id'];
            $result=$photo->editData();
            unset($photo);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function del(){
        $photo=A('Common');
        $photo->del('Photo');
    }

    public function getPhoto(){
        if(isset($_POST['member_id']) && !empty($_POST['member_id'])){
            $photo=D('Photo');
            $photo->member_id=I('post.member_id');
            $result=$photo->getPhoto();
            unset($photo);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'用户ID为空'));
        }
    }
}