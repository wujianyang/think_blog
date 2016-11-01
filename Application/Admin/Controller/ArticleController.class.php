<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends Controller{
    public function index(){
        $article=A('Common');
        $article->index('Article');
    }

    public function add(){
        if(isset($_POST['article']) && !empty($_POST['article'])){
            $article=D('Article');
            $article->title=I('post.article')['title'];
            $article->content=I('post.article')['content'];
            $article->member_id=I('post.article')['member_id'];
            $article->article_type_id=I('post.article')['article_type_id'];
            $result=$article->addData();
            unset($article);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function info(){
        $article=A('Common');
        $article->info('Article');
    }

    public function edit(){
        if(isset($_POST['article']) && !empty($_POST['article'])){
            $article=D('Article');
            $article->id=I('post.article')['id'];
            $article->title=I('post.article')['title'];
            $article->content=I('post.article')['content'];
            $article->member_id=I('post.article')['member_id'];
            $article->article_type_id=I('post.article')['article_type_id'];
            $result=$article->editData();
            $result['sql']=$article->getLastSql();
            unset($article);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    public function del(){
        $article=A('Common');
        $article->del('Article');
    }
}