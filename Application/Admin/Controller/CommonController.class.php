<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    public function index($className='')
    {
        if ($className != '') {
            $data = array();
            $data['status']=0;
            $data['msg']='';

            $modelClass = D($className);
            $modelClass->page = isset($_POST['page']) ? I('post.page') : 1;
            $modelClass->pageSize = isset($_POST['page_size']) ? I('post.page_size') : 10;
            $modelClass->key = isset($_POST['key']) ? trim(I('post.key')) : '';
            $modelClass->keyItem = isset($_POST['keyItem']) ? I('post.keyItem') : 'id';
            $modelClass->com = isset($_POST['com']) ? I('post.com') : 'eq';
            $result = $modelClass->index();
            $this->returnResult($result,$data,'rows');
            $resultCount = $modelClass->getCount();
            $this->returnResult($resultCount,$data,'count');
            $data['pageCount'] = ceil($resultCount['count'] / $modelClass->pageSize);
            unset($modelClass);

            if (IS_AJAX) {
                $this->ajaxReturn($data);
            } else {
                $this->assign('data', $data);
                $this->assign('empty', C('NODATA'));
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

    public function returnResult($arr=array(),&$data=array(),$field='result'){
        if($arr['status']==1){
            $data['status']=1;
            $data['msg']=$arr['msg'];
            $data[$field]=$arr[$field];
        }else{
            $data['msg']=$arr['msg'];
            if(IS_AJAX){
                $this->ajaxReturn($data);
            }
        }
    }
}