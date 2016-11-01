<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleTypeController extends Controller{
    public function index(){
        $articleType=A('Common');
        $articleType->index('ArticleType');
    }

    public function add(){
        if(isset($_POST['article_type']) && !empty($_POST['article_type'])){
            $articleType=D('ArticleType');
            $articleType->article_type_name=I('post.article_type')['article_type_name'];
            $articleType->member_id=I('post.article_type')['member_id'];
            $result=$articleType->addData();
            unset($articleType);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function info(){
        $articleType=A('Common');
        $articleType->info('ArticleType');
    }

    public function edit(){
        if(isset($_POST['article_type']) && !empty($_POST['article_type'])){
            $articleType=D('ArticleType');
            $articleType->id=I('post.article_type')['id'];
            $articleType->article_type_name=I('post.article_type')['article_type_name'];
            $articleType->member_id=I('post.article_type')['member_id'];
            $result=$articleType->editData();
            unset($articleType);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function del(){
        $articleType=A('Common');
        $articleType->del('ArticleType');
    }

    public function getArticleType(){
        if(isset($_POST['member_id']) && !empty($_POST['member_id'])){
            $articleType=D('ArticleType');
            $articleType->member_id=I('post.member_id');
            $result=$articleType->getArticleType();
            unset($articleType);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'用户ID为空'));
        }
    }
}