<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleCommentController extends Controller{
    public function index(){
        if (isset($_GET['article_id']) && !empty($_GET['article_id'])) {
            $data = array();
            $status = 0;

            $articleComment = D('ArticleComment');
            $articleComment->article_id = I('get.article_id');
            $articleComment->page = isset($_POST['page']) ? I('post.page') : 1;
            $articleComment->pageSize = isset($_POST['page_size']) ? I('post.page_size') : 10;
            $articleComment->keyItem = isset($_POST['keyItem']) ? I('post.keyItem') : 'id';
            $articleComment->com = isset($_POST['com']) ? I('post.com') : 'eq';
            if ($articleComment->com == 'like') {
                $articleComment->key = isset($_POST['key']) ? '%' . trim(I('post.key')) . '%' : '';
            } else {
                $articleComment->key = isset($_POST['key']) ? I('post.key') : '';
            }
            $result = $articleComment->index();
            $resultCount = $articleComment->getCount();
            $articleInfo = $articleComment->getArticleTitle();
            unset($articleComment);

            if ($result !== false) {
                $data['article_id'] = $articleInfo[0]['id'];
                $data['article_title'] = $articleInfo[0]['title'];
                $data['rows'] = $result;
                $data['count'] = $resultCount[0]['count'];
                $data['pageCount'] = ceil((int)$resultCount[0]['count'] / 10);
                $status = 1;
            } else {
                $data['rows'] = array();
            }
            $data['status'] = $status;
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