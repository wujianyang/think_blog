<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleCommentController extends Controller{
    public function index(){
        if (isset($_GET['article_id']) && !empty($_GET['article_id'])) {
            $data = array();
            $data['status'] = 0;
            $data['msg'] = '';

            $articleComment = D('ArticleComment');
            if(IS_AJAX){
                $articleComment->page=I('post.page');
                $articleComment->pageSize=I('post.page_size');
                $articleComment->key=trim(I('post.key'));
                $articleComment->keyItem=I('post.keyItem');
                $articleComment->com=I('post.com');
            }
            $articleComment->article_id = I('get.article_id');

            $result = $articleComment->index();
            $resultCount = $articleComment->getCount();
            $articleInfo = $articleComment->getArticleTitle();
            unset($articleComment);

            $data['article_id'] = $articleInfo[0]['id'];
            $data['article_title'] = $articleInfo[0]['title'];
            if ($result['status'] == 1) {
                $data['rows'] = $result['rows'];
                $data['count'] = $resultCount['count'];
                $data['pageCount'] = ceil((int)$resultCount['count'] / 10);
                $data['status']=1;
            } else {
                $data['rows'] = array();
            }
            if (IS_AJAX) {
                $this->ajaxReturn($data);
            } else {
                $this->assign('data', $data);
                $this->display();
            }
        }else{
            $this->error();
        }
    }

    public function del(){
        $articleComment=A('Common');
        $articleComment->del('ArticleComment');
    }
}