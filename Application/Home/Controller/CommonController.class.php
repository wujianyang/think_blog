<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{

    //用户模块列表
    public function personIndex($className){
        if ($className != '') {
            $data = array();
            $data['status']=0;
            $data['msg']='';

            if($this->isLogin()){
                $modelClass = D($className);
                $modelClass->member_id=I('session.MEMBER')['id'];
                if(IS_AJAX){
                    $modelClass->page=I('post.page');
                    $modelClass->pageSize=I('post.page_size');
                    $modelClass->key=trim(I('post.key'));
                    $modelClass->keyItem=I('post.keyItem');
                    $modelClass->com=I('post.com');
                }
                $result = $modelClass->personIndex();
                $this->returnResult($result,$data,'rows');
                $resultCount = $modelClass->personIndexCount();
                $this->returnResult($resultCount,$data,'count');
                $data['pageCount'] = ceil($resultCount['count'] / $modelClass->pageSize);
                unset($modelClass);

                if (IS_AJAX) {
                    $this->ajaxReturn($data);
                }else{
                    $this->assign('data', $data);
                    $this->assign('empty', C('NODATA'));
                    $this->display();
                }
            }else{
                if(!IS_AJAX){
                    $this->redirect('Member/login');
                }else{
                    $data['msg']='登录超时';
                    $this->ajaxReturn($data);
                }
            }
        }
    }


    //处理返回数据结果
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

    //判断是否登录
    public function isLogin(){
        if(I('session.MEMBER')!=null){
            return true;
        }else{
            $this->redirect('Member/login');
        }
    }
}