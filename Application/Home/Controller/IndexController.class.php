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
            $member=D('Member');
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
            }
        }elseif($_POST['keyItem']=='article'){  //搜索文章
            $this->searchArticle();
        }else{
            $this->error('参数错误');
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
            unset($result);
            unset($resultCount);
            unset($article);
            $this->ajaxReturn($data);
        }
        $resultCount=$article->getArticleCountByTitle();
        if($resultCount['status']==1){
            $data['status']=1;
            $data['count']=$resultCount['count'];
            $data['pageCount']=ceil($resultCount['count']/$article->pageSize);
        }else{
            $data['msg']=$resultCount['msg'];
            unset($result);
            unset($resultCount);
            unset($article);
            $this->ajaxReturn($data);
        }
        unset($result);
        unset($resultCount);
        unset($article);
        if(IS_AJAX){
            $this->ajaxReturn($data);
        }else{
            $this->assign('data',$data);
            $this->assign('empty',C('NODATA'));
            $this->display('Article/hotArticleList');
        }
    }

    //结果处理
    public function result($result=array(),$name='data',$pageSize=10,&$data){
        if(!IS_AJAX){
            if($result['status']==1){
                $this->assign($name,$result[$name]);
                if($name=='count'){
                    $this->assign('pageCount',ceil($result[$name]/$pageSize));
                }
            }else{
                $this->error($result['msg']);
            }
        }else{
            if($result['status']==1){
                $data['status']=1;
                $data[$name]=$result[$name];
            }else{
                $data['msg']=$result['msg'];
                $this->ajaxReturn($data);
            }
        }
    }
}