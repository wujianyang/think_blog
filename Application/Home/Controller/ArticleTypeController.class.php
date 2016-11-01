<?php
namespace Home\Controller;
use Think\Controller;

class ArticleTypeController extends Controller{
    //获取个人文章类型
    public function getPersonArticleType(){
        $data=array();
        $data['status']=0;
        $data['msg']='';
        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $articleType=D('ArticleType');
            $articleType->page=0;
            $articleType->member_id=$member_id;
            $result=$articleType->getArticleTypeByMemberId();
            if($result['status']==1){
                $data['status']=1;
                $data['articleType']=$result['articleType'];
            }else{
                $data['msg']=$result['msg'];
            }
        }else{
            $data['msg']='登录超时';
        }
        $this->ajaxReturn($data);
    }

    //个人添加文章分类
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $articleType=D('ArticleType');
            $articleType->member_id=$member_id;
            $articleType->article_type_name=I('post.article_type')['article_type_name'];
            $result=$articleType->personAdd();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

    //个人删除文章分类
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $articleType=D('ArticleType');
            $articleType->member_id=$member_id;
            $articleType->id=I('post.id');
            $result=$articleType->personDel();
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
            $articleType=D('ArticleType');
            $articleType->member_id=$member_id;
            $articleType->id=I('post.id');
            $result=$articleType->personInfo();
            if($result['status']==1){
                $data['status']=1;
                $data['articleType']=$result['articleType'];
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
            $articleType=D('ArticleType');
            $articleType->member_id=$member_id;
            $articleType->id=I('post.article_type')['id'];
            $articleType->article_type_name=I('post.article_type')['article_type_name'];
            $result=$articleType->personEdit();
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