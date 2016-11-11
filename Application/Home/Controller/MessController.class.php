<?php
namespace Home\Controller;
use Think\Controller;

class MessController extends Controller{
    public function index(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(!empty($_GET['member_id']) || !empty($_POST['member_id'])){
            $member=D('Member');
            if(IS_AJAX){
                $member->id=I('post.member_id');
            }else{
                $member->id=I('get.member_id');
            }
            //判断用户ID是否存在
            if($member->isExistsMemberId()){
                //获取用户信息
                $memberResult=$member->getInfoHeader();
                if($memberResult['status']==1){
                    $data['status']=1;
                    $data['member']=$memberResult['member'];
                    //获取用户留言板信息
                    $mess=D('Mess');
                    $mess->messed_id=$member->id;
                    $messResult=$mess->getMessByMemberId();
                    if($messResult['status']==1){
                        $data['status']=1;
                        $data['rows']=$messResult['mess'];
                        //获取留言板列表数量
                        $countCesult=$mess->getMessCount();
                        if($countCesult['status']==1){
                            $data['status']=1;
                            $data['count']=$countCesult['count'];
                            $data['pageCount']=ceil($countCesult['count']/$mess->pageSize);
                        }else{
                            $data['status']=0;
                            $data['msg']=$countCesult['msg'];
                        }
                    }else{
                        $data['status']=0;
                        $data['msg']=$messResult['msg'];
                    }
                }else{
                    $data['status']=0;
                    $data['msg']='用户信息获取失败';
                }
            }else{
                $data['msg']='该用户不存在';
            }
        }else{
            $data['msg']='请求参数为空';
        }
        if(IS_AJAX){
            $this->ajaxReturn($data);
        }else{
            $this->assign('data',$data);
            $this->assign('msg',$data['msg']);
            $this->display();
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