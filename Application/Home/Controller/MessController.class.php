<?php
namespace Home\Controller;
use Think\Controller;

class MessController extends Controller{
    public function index(){
        if(isset($_GET['member_id']) && !empty($_GET['member_id'])){
            $member=D('Member');
            $member->id=I('get.member_id');
            if($member->isExistsMemberId()){
                //获取用户信息
                $member_result=$member->getInfoHeader();
                if($member_result['status']==1){
                    $this->assign('member',$member_result['member']);
                }else{
                    $this->error($member_result['msg']);
                }
                //获取留言板信息
                $mess=D('Mess');
                $mess->messed_id=I('get.member_id');
                $mess_result=$mess->getMessByMemberId();
                if($mess_result['status']==1){
                    $this->assign('mess',$mess_result['mess']);
                }else{
                    $this->error($mess_result['msg']);
                }
                //获取留言板分页信息
                $count_result=$mess->getCount();
                if($count_result['status']==1){
                    $count=$count_result['count'];
                    $pageCount=ceil($count/$mess->pageSize);
                    $this->assign('count',$count);
                    $this->assign('pageCount',$pageCount);
                }else{
                    $this->error($count_result['msg']);
                }
            }else{
                $this->error('该用户不存在');
            }
            $this->assign('empty','<p class="noData">没有数据</p>');
            $this->display();
        }elseif(IS_AJAX && !empty($_POST['member_id'])){
            $data=array();
            $data['status']=0;
            $data['msg']='';

            $mess=D('Mess');
            $mess->messed_id=I('post.member_id');
            $mess->pageSize=I('post.page_size');
            $mess->page=I('post.page');
            $mess_result=$mess->getMessByMemberId();
            if($mess_result['status']==1){
                $data['status']=1;
                $data['mess']=$mess_result['mess'];
            }else{
                $data['msg']=$mess_result['msg'];
            }
            //获取留言板分页信息
            $count_result=$mess->getCount();
            if($count_result['status']==1){
                $data['status']=1;
                $data['count']=$count_result['count'];
            }else{
                $data['msg']=$count_result['msg'];
            }
            $this->ajaxReturn($data);
        }else{
            $this->error('请求参数为空');
        }
    }

    //用户留言
    public function mess(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        //验证用户是否登录
        if(I('session.MEMBER')!=null){
            $member=D('Member');
            $member->id=I('post.member_id');
            if($member->isExistsMemberId()){
                $mess=D('Mess');
                $mess->messer_id=I('session.MEMBER')['id'];
                $mess->messed_id=I('post.member_id');
                $mess->content=I('post.content');
                $result=$mess->mess();
                if($result['status']==1){
                    $data['status']=1;
                    $data['msg']=$result['msg'];
                }else{
                    $data['msg']=$result['msg'];
                }
            }else{
                $data['msg']='用户不存在';
            }

        }else{
            $data['msg']='请先登录再留言';
        }

        $this->ajaxReturn($data);
    }

    //用户删除留言
    public function personDel(){
        $data=array();
        $data['status']=1;
        $data['msg']='';

        //验证用户是否登录
        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $mess=D('Mess');
            $mess->messed_id=$member_id;
            $mess->id=I('post.id');
            $result=$mess->personDel();
            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }

        $this->ajaxReturn($data);
    }
}