<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    public function index($className='')
    {
        if ($className != '') {
            $data = array();
            $status = 0;

            $modelClass = D($className);
            $modelClass->page = isset($_POST['page']) ? I('post.page') : 1;
            $modelClass->pageSize = isset($_POST['page_size']) ? I('post.page_size') : 10;
            $modelClass->keyItem = isset($_POST['keyItem']) ? I('post.keyItem') : 'id';
            $modelClass->com = isset($_POST['com']) ? I('post.com') : 'eq';
            if ($modelClass->com == 'like') {
                $modelClass->key = isset($_POST['key']) ? '%' . trim(I('post.key')) . '%' : '';
            } else {
                $modelClass->key = isset($_POST['key']) ? trim(I('post.key')) : '';
            }
            $result = $modelClass->index();
            $resultCount = $modelClass->getCount();
            unset($modelClass);

            if ($result !== false) {
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
        }
    }

    public function info($className=''){
        if ($className != '') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $modelClass = D($className);
                $modelClass->id = I('post.id');
                $result = $modelClass->infoData();
                unset($modelClass);
                $this->ajaxReturn($result);
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '请求参数为空'));
            }
        }
    }

    public function del($className=''){
        if ($className != '') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $modelClass = D($className);
                $modelClass->id = I('post.id');
                $result = $modelClass->delData();
                unset($modelClass);
                $this->ajaxReturn($result);
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '请求参数为空'));
            }
        }
    }
}