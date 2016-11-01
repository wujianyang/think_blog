<?php
namespace Home\Controller;
use Think\Controller;

class ArticleController extends Controller{
    public function index(){
        if(isset($_GET['article_id']) && !empty($_GET['article_id'])){
            $article=D('Article');
            $article->id=I('get.article_id');
            if($article->isExistsArticleId()){
                //获取文章信息
                $article_result=$article->getArticleByArticleId();
                $this->assign('article',$article_result['article']);
                $pageCount=ceil($article_result['article']['article_comment_count']/10);
                $this->assign('pageCount',$pageCount);
                //获取文章评论列表
                $articleComment=D('ArticleComment');
                $articleComment->article_id=I('get.article_id');
                $articleComment_result=$articleComment->getArticleComment();
                $this->assign('articleComment',$articleComment_result['articleComment']);

                $this->assign('empty','<p class="noData">没有数据</p>');
                $this->display();
            }else{
                $this->error('文章ID不存在');
            }
        }else{  //文章ID为空
            $this->error('文章ID为空');
        }

    }

    public function articleList(){
        if($_GET['article_type_id']){   //点击文章类型，查看文章列表
            $articleType=D('ArticleType');
            $articleType->id=I('get.article_type_id');
            $member_id_result=$articleType->getMemberIdById();
            if($member_id_result['status']==1){
                $member_id=$member_id_result['member_id'];
                $member=D('Member');
                $member->id=$member_id;
                $member_result=$member->getInfoHeader();
                $this->assign('member',$member_result['member']);
            }else{
                $this->error($member_id_result['msg']);
            }
            $article_type_op_result=$articleType->getArticleType_op();
            $this->assign('article_type_op',$article_type_op_result);
            //根据用户名获取文章分类
            $articleType->member_id=$member_id;
            $articleType_result=$articleType->getArticleTypeByMemberId();
            if($articleType_result['status']==1){
                $this->assign('articleType',$articleType_result['articleType']);
            }else{
                $this->error($articleType_result['msg']);
            }
            //根据传递到后台的文章分类获取文章列表
            $article=D('Article');
            $article->pageSize=20;
            $article->article_type_id=I('get.article_type_id');
            $article_result=$article->getArticleByArticleTypeId();
            if($article_result['status']==1){
                $this->assign('article',$article_result['article']);
            }else{
                $this->error($article_result['msg']);
            }
            //获取文章列表分页信息
            $count_result=$article->getCountByArticleId();
            $pageCount=ceil($count_result['count']/$article->pageSize);
            $this->assign('count',$count_result['count']);
            $this->assign('pageCount',$pageCount);

        }elseif($_GET['member_id']){    //查看某用户的文章列表
            $member_id=I('get.member_id');
            $member=D('Member');
            $member->id=$member_id;
            //验证用户ID是否存在
            if($member->isExistsMemberId()){
                $member_result=$member->getInfoHeader();
                $this->assign('member',$member_result['member']);
                //根据用户名获取文章分类
                $articleType=D('ArticleType');
                $articleType->member_id=$member_id;
                $articleType_result=$articleType->getArticleTypeByMemberId();
                if($articleType_result['status']==1){
                    $this->assign('articleType',$articleType_result['articleType']);
                }else{
                    $this->error($articleType_result['msg']);
                }
                $articleType->id=$articleType_result['articleType'][0]['id'];
                $article_type_op_result=$articleType->getArticleType_op();
                $this->assign('article_type_op',$article_type_op_result);
                //根据传递到后台的文章分类获取文章列表
                $article=D('Article');
                $article->pageSize=20;
                $article->article_type_id=$articleType->id;
                $article_result=$article->getArticleByArticleTypeId();
                if($article_result['status']==1){
                    $this->assign('article',$article_result['article']);
                }else{
                    $this->error($article_result['msg']);
                }
                //获取文章列表分页信息
                $count_result=$article->getCountByArticleId();
                $pageCount=ceil($count_result['count']/$article->pageSize);
                $this->assign('count',$count_result['count']);
                $this->assign('pageCount',$pageCount);
            }else{
                $this->error('用户ID错误');
            }
        }else{
            $this->error('请求参数为空');
        }
        $this->assign('empty','<p class="noData">没有数据</p>');
        $this->display();
    }

    public function articleListPage(){
        $data=array();
        $data['status']=0;
        $data['msg']='';
        if(IS_AJAX && $_POST['article_type_id']){
            //根据传递到后台的文章分类获取文章列表
            $article=D('Article');
            $article->article_type_id=I('post.article_type_id');
            $article->page=I('post.page');
            $article->pageSize=I('post.page_size');
            $article_result=$article->getArticleByArticleTypeId();
            if($article_result['status']==1){
                $data['status']=1;
                $data['article']=$article_result['article'];
            }else{
                $data['msg']=$article_result['msg'];
            }
            //获取文章列表分页信息
            $count_result=$article->getCountByArticleId();
            $data['count']=$count_result['count'];
        }else{
            $data['msg']='请求错误';
        }
        $this->ajaxReturn($data);
    }

    public function hotArticleList(){
        if(IS_AJAX && !empty($_POST['member_id'])){
            $data=array();
            $data['status']=0;
            $data['msg']='';

            //通过ajax分页获取列表数据
            $article=D('Article');
            $article->member_id=I('post.member_id');
            $article->page=I('post.page');
            $article->pageSize=I('post.page_size');
            $hotArticle_result=$article->getHotArticle();
            if($hotArticle_result['status']==1){
                $data['status']=1;
                $data['hotArticle']=$hotArticle_result['hotArticle'];
            }else{
                $this->error($hotArticle_result['msg']);
            }
            //获取热门文章排行分页条信息
            $count_result=$article->getHotArticleCount();
            if($count_result['status']==1){
                $data['count']=$count_result['count'];
            }else{
                $this->error($count_result['msg']);
            }
            $this->ajaxReturn($data);
        }elseif(isset($_GET['member_id']) && !empty($_GET['member_id'])){
            $member=D('Member');
            $member->id=I('get.member_id');
            $member_result=$member->getInfoHeader();
            if($member_result['status']==1){
                $this->assign('member',$member_result['member']);
            }else{
                $this->error($member_result['msg']);
            }
            //访问热门文章列表，获取首页列表数据
            $article=D('Article');
            $article->member_id=I('get.member_id');
            $article->pageSize=20;
            $hotArticle_result=$article->getHotArticle();
            if($hotArticle_result['status']==1){
                $this->assign('hotArticle',$hotArticle_result['hotArticle']);
            }else{
                $this->error($hotArticle_result['msg']);
            }
            //获取热门文章排行分页条信息
            $count_result=$article->getHotArticleCount();
            if($count_result['status']==1){
                $count=$count_result['count'];
                $pageCount=ceil($count/$article->pageSize);
                $this->assign('count',$count);
                $this->assign('pageCount',$pageCount);
            }else{
                $this->error($count_result['msg']);
            }
            $this->assign('empty','<p class="noData">没有数据</p>');
            $this->display();
        }else{
            $this->error('请求参数为空');
        }
    }

    //个人添加文章
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            if($_POST['article']!=null){
                $member_id=I('session.MEMBER')['id'];
                $article=D('Article');
                $article->member_id=$member_id;
                $article->title=I('post.article')['title'];
                $article->article_type_id=I('post.article')['article_type_id'];
                $article->content=I('post.article')['content'];
                $result=$article->personAdd();
                if($result['status']==1){
                    $data['status']=1;
                }
                    $data['msg']=$result['msg'];
            }else{
                $data['msg']='提交参数为空';
            }
        }

        $this->ajaxReturn($data);
    }

    //查看个人文章信息
    public function personArticleInfo(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            if($_POST['id']!=null){
                $article=D('Article');
                $article->id=I('post.id');
                $result=$article->getArticleByArticleId();
                if($result['status']==1){
                    $data['status']=1;
                    $data['article']=$result['article'];
                }else{
                    $data['msg']=$result['msg'];
                }
            }else{
                $data['msg']='提交参数为空';
            }
        }

        $this->ajaxReturn($data);
    }
    //用户文章编辑
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            if($_POST['article']!=null){
                $member_id=I('session.MEMBER')['id'];
                $article=D('Article');
                $article->id=I('post.article')['id'];
                $article->member_id=$member_id;
                $article->title=I('post.article')['title'];
                $article->article_type_id=I('post.article')['article_type_id'];
                $article->content=I('post.article')['content'];
                $result=$article->personEdit();
                if($result['status']==1){
                    $data['status']=1;
                }
                $data['msg']=$result['msg'];
            }else{
                $data['msg']='提交参数为空';
            }
        }

        $this->ajaxReturn($data);
    }

    //用户文章删除
    public function personDel(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(IS_AJAX && isset($_POST['id']) && !empty($_POST['id'])){
            $id=I('post.id');
            $article=D('Article');
            $article->id=$id;
            $result=$article->personDel();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='提交参数错误';
        }

        $this->ajaxReturn($data);
    }

}