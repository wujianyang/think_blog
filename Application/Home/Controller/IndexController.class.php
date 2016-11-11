<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('./index');
    }

    //顶部搜索框搜索
    public function search(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if($_POST['keyItem']=='member'){    //搜索用户
            /*$member=D('Member');
            $member->key='%'.trim(I('post.key')).'%';
            $member->keyItem='member_name';
            $member->com='like';
            $member->pageSize=20;
            if(IS_AJAX){
                $member->page=I('post.page');
                $member->pageSize=I('post.page_size');
            }
            $result=$member->searchFriends(I('session.MEMBER')['id']);
            $resultCount=$member->searchFriendsCount(I('session.MEMBER')['id']);
            if(count($result['friends'])>0){
                $member->id=array_column($result['friends'],'member_id');
            }else{
                $member->id='';
            }
            $resultFocusCount=$member->getFriendsFocusCount();
            $resultFansCount=$member->getFriendsFansCount();
            foreach($result['friends'] as $k=>$res){
                $result['friends'][$k]['focus_count']=$resultFocusCount['focus_count'][$k];
                $result['friends'][$k]['fans_count']=$resultFansCount['fans_count'][$k];
            }
            $this->result($result,'friends',$member->pageSize,$data);
            $this->result($resultCount,'count',$member->pageSize,$data);
            if(!IS_AJAX){
                $this->assign('empty',C('NODATA'));
                $this->display('./Member/friends');
            }else{
                $this->ajaxReturn($data);
            }*/
            $this->searchFriends();
        }elseif($_POST['keyItem']=='article'){  //搜索文章
            $this->searchArticle();
        }else{
            $this->error('参数错误');
        }
    }

    //条件搜索用户列表
    public function searchFriends(){
        $data=array();
        $data['status']=1;
        $data['msg']='';

        $member=D('Member');
        $member->key=trim(I('post.key'));
        $member->keyItem='member_name';
        $member->com='like';
        //初次访问初始化每页20条数据
        $member->pageSize=20;
        if(IS_AJAX){
            $member->page=I('post.page');
            $member->pageSize=I('post.page_size');
        }
        //传递当前登录用户ID是为了判断搜索用户是否已关注
        $result=$member->searchFriends(I('session.MEMBER')['id']);
        if($result['status']==1){
            $resultCount=$member->searchFriendsCount(I('session.MEMBER')['id']);
            //获取查找到的用户ID
            if(count($result['friends'])>0){
                $member->id=array_column($result['friends'],'member_id');
            }else{
                $member->id='';
            }
            //再根据用户ID获取该用户的关注数量 和 粉丝数量
            $resultFocusCount=$member->getFriendsFocusCount();
            $resultFansCount=$member->getFriendsFansCount();
            //最后组合成新的结果集
            foreach($result['friends'] as $k=>$res){
                $result['friends'][$k]['focus_count']=$resultFocusCount['focus_count'][$k];
                $result['friends'][$k]['fans_count']=$resultFansCount['fans_count'][$k];
            }
            $data['rows']=$result['friends'];
            $data['count']=$resultCount['count'];
            $data['pageCount']=ceil($resultCount['count']/$member->pageSize);
        }else{
            $data['msg']=$result['msg'];
        }
        unset($result);
        unset($resultCount);
        unset($resultFocusCount);
        unset($resultFansCount);
        unset($member);
        //根据提交类型返回数据
        if(IS_AJAX){
            $this->ajaxReturn($data);
        }else{
            $this->assign('data',$data);
            $this->assign('empty',C('NODATA'));
            $this->display('Member/friends');
        }
    }

    //条件搜索文章列表
    public function searchArticle(){
        $data=array();
        $data['status']=1;
        $data['msg']='';

        $article=D('Article');
        $article->key=trim(I('post.key'));
        $article->keyItem='title';
        $article->com='like';
        //初次访问初始化每页20条数据
        $article->pageSize=20;
        if(IS_AJAX){
            $article->page=I('post.page');
            $article->pageSize=I('post.page_size');
        }
        $result=$article->getArticleByTitle();
        if($result['status']==1){
            $data['status']=1;
            $data['rows']=$result['rows'];
        }else{
            $data['msg']=$result['msg'];
        }
        $resultCount=$article->getArticleCountByTitle();
        if($resultCount['status']==1){
            $data['status']=1;
            $data['count']=$resultCount['count'];
            $data['pageCount']=ceil($resultCount['count']/$article->pageSize);
        }else{
            $data['msg']=$resultCount['msg'];
        }
        unset($result);
        unset($resultCount);
        unset($article);
        //根据提交类型返回数据
        if(IS_AJAX){
            $this->ajaxReturn($data);
        }else{
            $this->assign('data',$data);
            $this->assign('empty',C('NODATA'));
            $this->display('Article/hotArticleList');
        }
    }
}