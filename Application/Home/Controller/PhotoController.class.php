<?php
namespace Home\Controller;
use Think\Controller;

class PhotoController extends Controller{
    public function index(){
        if(isset($_GET['photo_id']) && !empty($_GET['photo_id'])){
            //访问相册分类
            $photo=D('Photo');
            $photo->id=I('get.photo_id');
            $member_id_result=$photo->getMemberId();
            if($member_id_result['status']==1){
                $member_id=$member_id_result['member_id'];
            }else{
                $this->error($member_id_result['msg']);
            }
            //获取用户信息
            $member=D('Member');
            $member->id=$member_id;
            $member_result=$member->getInfoHeader();
            if($member_result['status']==1){
                $this->assign('member',$member_result['member']);
            }else{
                $this->error($member_result['msg']);
            }
            //获取相册分类列表
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo_result=$photo->getPhotoList();
            if($photo_result['status']==1){
                $this->assign('photo',$photo_result['photo']);
            }else{
                $this->error($photo_result['msg']);
            }
            $photo->id=I('photo_id');
            $photo_result_op=$photo->getPhoto_op();
            $this->assign('photo_op',$photo_result_op['photo_op']);
            //获取相册图片列表
            $photoImg=D('PhotoImg');
            $photoImg->photo_id=I('get.photo_id');
            $photoImg_result=$photoImg->getPhotoImg();
            if($photoImg_result['status']==1){
                $this->assign('photoImg',$photoImg_result['photoImg']);
            }else{
                $this->error($photoImg_result['msg']);
            }
            //获取相册图片记录数
            $count_result=$photoImg->getPhotoImgCount();
            if($count_result['status']==1){
                $this->assign('count',$count_result['count']);
            }else{
                $this->error($count_result['msg']);
            }

        }elseif(isset($_GET['member_id']) && !empty($_GET['member_id'])){
            //访问用户相册
            $member=D('Member');
            $member->id=I('get.member_id');
            if($member->isExistsMemberId()){
                $member_result=$member->getInfoHeader();
                if($member_result['status']==1){
                    $this->assign('member',$member_result['member']);
                }else{
                    $this->error($member_result['msg']);
                }
                //获取相册分类列表
                $photo=D('Photo');
                $photo->member_id=I('get.member_id');
                $photo_result=$photo->getPhotoList();
                if($photo_result['status']==1){
                    $this->assign('photo',$photo_result['photo']);
                }else{
                    $this->error($photo_result['msg']);
                }
                $photo_result_op=$photo_result['photo'][0];
                $this->assign('photo_op',$photo_result_op);
                //获取相册图片列表
                $photoImg=D('PhotoImg');
                $photoImg->photo_id=$photo_result_op['id'];
                $photoImg_result=$photoImg->getPhotoImg();
                if($photoImg_result['status']==1){
                    $this->assign('photoImg',$photoImg_result['photoImg']);
                }else{
                    $this->error($photoImg_result['msg']);
                }
                //获取相册图片记录数
                $count_result=$photoImg->getPhotoImgCount();
                if($count_result['status']==1){
                    $this->assign('count',$count_result['count']);
                }else{
                    $this->error($count_result['msg']);
                }
            }else{
                $this->error('用户ID不存在');
            }
        }else{
            $this->error('请求参数为空');
        }
        $this->assign('empty','<p class="noData">没有数据</p>');
        $this->display();
    }

    //个人添加相册分类
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo->photo_title=I('post.photo')['photo_title'];
            $result=$photo->personAdd();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

    //个人删除相册分类
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo->id=I('post.id');
            $result=$photo->personDel();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

    public function personInfo(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo->id=I('post.id');
            $result=$photo->personInfo();
            if($result['status']==1){
                $data['status']=1;
                $data['photo']=$result['photo'];
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

    //个人编辑文章分类
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo->id=I('post.photo')['id'];
            $photo->photo_title=I('post.photo')['photo_title'];
            $result=$photo->personEdit();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }
}