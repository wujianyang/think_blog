<?php
namespace Home\Controller;
use Home\Model\MemberModel;
use Think\Controller;

class MemberController extends Controller{
    //个人博客主页
    public function index(){
        if(isset($_GET['member_id']) && !empty($_GET['member_id'])){
            //如果member_id存在，则访问指定用户主页
            $this->memberIndex(I('get.member_id'));
        }else{
            //如果member_id不存在，但是某个用户处于登录状态，则访问该用户
            if($this->isLogin()){
                $this->memberIndex(I('session.MEMBER')['id']);
            }else{  //否则跳转到登录页面
                $this->redirect('login');
            }
        }
    }

    public function memberIndex($member_id){
        //获取用户头像
        $member=D('Member');
        $member->id=$member_id;
        //判断用户ID是否存在
        if($member->isExistsMemberId()){
            $member_result=$member->getInfoHeader();
            $this->assign('member',$member_result['member']);
            //获取用户关注信息
            $friends=D('Friends');
            $friends->member_id=$member_id;
            $focus_result=$friends->getFocusCount();
            $fans_result=$friends->getFansCount();
            $this->assign('focus_count',$focus_result['focus_count']);
            $this->assign('fans_count',$fans_result['fans_count']);
            //获取用户文章信息
            $article=D('Article');
            $article->member_id=$member_id;
            $article->pageSize=5;
            $article_result=$article->getArticleByMemberId();
            $this->assign('article',$article_result['article']);
            //获取热门文章排行
            $hotArticle_result=$article->getHotArticle();
            $this->assign('hotArticle',$hotArticle_result['hotArticle']);
            //获取用户文章分类信息
            $article->pageSize=10;
            $articleType_result=$article->getArticleTypeByMemberId();
            $this->assign('articleType',$articleType_result['article_type']);
            //获取用户相册分类信息
            $photo=D('Photo');
            $photo->member_id=$member_id;
            $photo->pageSize=10;
            $photo_result=$photo->getPhotoByMemberId();
            $this->assign('photo',$photo_result['photo']);
            //获取用户留言板信息
            $mess=D('Mess');
            $mess->messed_id=$member_id;
            $mess->pageSize=5;
            $mess_result=$mess->getMessByMemberId();
            $this->assign('mess',$mess_result['mess']);

            //没有数据提示信息
            $this->assign('empty',"<p class='noData'>没有数据</p>");
            $this->display();
        }else{
            //用户ID不存在则提示错误信息并跳转到登录页面
            $this->error('该用户不存在',C('HOST_DIR').'Home/Member/login.'.C('URL_HTML_SUFFIX'),3);
        }

    }

    //访问登录页面
    public function login(){
        if(I('session.MEMBER')!=null){
            $this->redirect('Index');
        }elseif(IS_POST){
            //验证提交参数是否正确
            if(isset($_POST['member_name']) && !empty($_POST['member_name'])){
                $member=D('Member');
                $member->member_name=I('post.member_name');
                $member->passwd=I('post.passwd');
                $member->vCode=I('post.vCode');
                if($member->checkVerify(I('post.vCode'))!==false){  //验证验证码是否正确
                    $isFreeze=$member->isFreeze();
                    if($isFreeze['status']){    //验证是否冻结
                        $result=$member->login();
                        unset($member);
                        if($result['status']==1){   //验证用户名和密码是否匹配
                            session_start();
                            session('MEMBER',$result['member']);
                            if(!empty($_POST['rememberPass'])){
                                setcookie("member_name",I('post.member_name'),time()+3600*24*7);
                                setcookie("passwd",md5(I('post.passwd')),time()+3600*24*7);
                            }
                            $this->redirect('Index');
                        }else{  //用户名和密码验证失败
                            $this->assign('msg',$result['msg']);
                        }
                    }else{
                        $this->assign('msg','账号已冻结');
                    }
                }else{
                    $this->assign('session',I('session.'));
                    $this->assign('msg','验证码错误');
                }
            }else{
                $this->assign('data',array('status'=>0,'msg'=>'请求参数为空'));
            }
        }
        $this->display();
    }

    //退出登录
    public function logout(){
        session_start();
        session('MEMBER',null);
        $this->redirect('Index');
    }

    //获取验证码
    public function getVerify(){
        $member=D('Member');
        $member->getVerify();
        unset($member);
    }

    //访问注册页面
    public function register(){
        if(IS_AJAX){
            if(isset($_POST['member_name']) && !empty($_POST['member_name'])) {
                $member=D('Member');
                $member->member_name=I('post.member_name');
                $member->passwd=I('post.passwd');
                $member->sex=I('post.sex');
                $member->email=I('post.email');
                $member->tel=I('post.tel');
                $member->address=I('post.address');
                $member->question=I('post.question');
                $member->answer=I('post.answer');
                if (isset($_FILES['head_pic']) && !empty($_FILES['head_pic'])) {
                    $member->head_pic = $_FILES['head_pic'];
                }
                $result=$member->register();
                unset($member);
                $this->ajaxReturn($result);
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
            }
        }else{
            $this->display();
        }

    }

    //访问个人中心页面
    public function info(){
        if($this->isLogin()){
            $member=D('Member');
            $member->id=I('session.MEMBER')['id'];
            $result=$member->getInfo();

            unset($member);
            if($result!==false && count($result)>0){
                $this->assign('member',$result);
                $this->display();
            }else{
                $this->redirect('login');
            }
        }

    }

    //修改个人资料
    public function updateInfo(){
        if(isset($_POST['member_name']) && !empty($_POST['member_name'])){
            $member=D('Member');
            $member->id=I('post.id');
            $member->member_name=I('post.member_name');
            $member->sex=I('post.sex');
            $member->email=I('post.email');
            $member->tel=I('post.tel');
            $member->address=I('post.address');
            $member->question=I('post.question');
            $member->answer=I('post.answer');
            if (isset($_FILES['head_pic']) && !empty($_FILES['head_pic'])) {
                $member->head_pic = $_FILES['head_pic'];
            }
            $result=$member->updateInfo();
            unset($member);
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    //修改密码
    public function updatePasswd(){
        if($this->isLogin()){
            if(IS_POST){
                $newPasswd=I('post.passwd');
                $newPasswd2=I('post.passwd2');
                if($newPasswd==$newPasswd2){
                    $member=D('Member');
                    $member->id=I('session.MEMBER')['id'];
                    $member->passwd=I('post.old_passwd');
                    $result=$member->updatePasswd($newPasswd);
                    unset($member);
                    //密码修改成功需重新登录
                    if($result['status']==1){
                        session('MEMBER',null);
                        $this->redirect('login');
                    }
                    $this->assign('msg',$result['msg'].I('post.old_passwd'));
                }else{
                    $this->assign('msg','新密码不一致');
                }
            }
            $this->display();
        }
    }

    //获取用户的密码问题
    public function getQuestion(){
        if(IS_AJAX){
            if(isset($_POST['member_name']) && !empty($_POST['member_name'])){
                $member=D('Member');
                $member->member_name=I('post.member_name');
                $result=$member->getQuestion();
                unset($member);
                $this->ajaxReturn($result);
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
            }
        }
        $this->display();
    }

    //忘记密码修改密码
    public function forgetUpdatePasswd(){
        if(isset($_POST['answer']) && !empty($_POST['answer'])){
            if(I('post.passwd')==I('post.passwd2')){
                $member=D('Member');
                $member->member_name=I('post.member_name');
                $member->question=I('post.question');
                $member->answer=I('post.answer');
                $member->passwd=I('post.passwd');
                $result=$member->forgetUpdatePasswd();
                unset($member);
                $this->ajaxReturn($result);
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'新密码不一致'));
            }
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'请求参数为空'));
        }
    }

    //访问用户好友列表(关注/粉丝页面)
    public function friends(){
        if(isset($_GET['f']) && !empty($_GET['f'])){
            $f=I('get.f');
            if($f=='focus' || $f=='fans'){
                $this->getFriends($f);
            }else{
                $this->error('请求参数错误');
            }
        }else{
            $this->error('请求参数为空');
        }
    }

    //访问好友页面
    public function getFriends($f=''){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        $member=D('Member');
        $member->id=I('get.member_id');
        if($member->isExistsMemberId()){
            if(!IS_AJAX){   //访问页面获取用户信息，ajax分页只更新列表
                $member_result=$member->getInfoHeader();
                if($member_result['status']==1){
                    $this->assign('member',$member_result['member']);
                }else{
                    $this->error($member_result['msg']);
                }
            }
            if(IS_AJAX){
                $member->page=I('post.page');
                $member->pageSize=I('post.page_size');
            }
            //获取关注用户ID数组
            $friends=D('Friends');
            $friends->pageSize=20;
            $friends->fans_id=I('get.member_id');
            $friends->member_id=I('get.member_id');
            $resultFriendsId=$friends->getFriendsId($f);
            //$resultCount=$friends->getFocusCount();

            if($resultFriendsId['status']==1){
                //获取关注用户信息
                $member->pageSize=20;
                $member->id_temp=$member->id;
                if(count($resultFriendsId['friends_id'])>0){
                    $member->id=$resultFriendsId['friends_id'];
                }else{
                    $member->id='';
                }

                $result=$member->getFriends($f);
                //获取关注用户的关注数量
                $resultFocusCount=$member->getFriendsFocusCount();
                //获取关注用户的粉丝数量
                $resultFansCount=$member->getFriendsFansCount();
                if($result['status']==1 && $resultFocusCount['status']==1 && $resultFansCount['status']==1){
                    //组合好友的关注数量和粉丝数量
                    $memberResult=$result['member'];
                    foreach($memberResult as $k => $m){
                        $memberResult[$k]['focus_count']=$resultFocusCount['focus_count'][$k];
                        $memberResult[$k]['fans_count']=$resultFansCount['fans_count'][$k];
                    }
                    //返回列表数据
                    if(!IS_AJAX){   //访问
                        $this->assign('friends',$memberResult);
                        $this->assign('empty',C('NODATA'));
                    }else{  //ajax提交
                        $data['status']=1;
                        $data['friends']=$memberResult;
                    }
                    //返回分页数据
                    if(!IS_AJAX){
                        $this->assign('count',count($memberResult));
                        $this->assign('pageCount',ceil(count($memberResult)/$member->pageSize));
                    }else{
                        $data['count']=count($memberResult);
                        $this->ajaxReturn($data);
                    }
                    $this->display();
                }else{  //请求失败
                    if(!IS_AJAX){
                        $this->error('请求失败');
                    }else{
                        $data['msg']='请求失败';
                        $this->ajaxReturn($data);
                    }
                }

            }else{
                if(!IS_AJAX){
                    $this->error($resultFriendsId['msg']);
                }else{
                    $data['msg']=$resultFriendsId['msg'];
                    $this->ajaxReturn($data);
                }
            }
        }else{
            $this->error('用户不存在');
        }
    }

    //关注好友
    public function focusFriends(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER') != null){
            $friends=D('Friends');
            $friends->member_id=I('post.member_id');
            $friends->fans_id=I('session.MEMBER')['id'];
            $isCencel=I('post.isCencel');
            if($isCencel=='cencel'){  //取消关注好友
                $result=$friends->cencelFocus();
            }else{  //关注好友
                $result=$friends->focus();
            }

            if($result['status']==1){
                $data['status']=1;
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

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

    //访问个人中心
    public function personCenter(){
        if($this->isLogin()){
            $this->display();
        }else{
            $this->redirect('Member/login');
        }
    }

    //访问我的文章
    public function personArticle(){
        $data=array();
        $data['status']=0;
        $data['msg']='';
        if($this->isLogin()){
            $member_id=I('session.MEMBER')['id'];
            $article=D('Article');
            if(IS_AJAX){
                $article->page=I('post.page');
                $article->pageSize=I('post.page_size');
                $article->key=trim(I('post.key'));
                $article->keyItem=I('post.keyItem');
                $article->com=I('post.com');
            }
            $article->member_id=$member_id;
            $result=$article->getArticleByMemberId();
            $count_result=$article->getCountByMemberId();
            if(!IS_AJAX){
                if($result['status']==1){
                    $this->assign('article',$result['article']);
                }else{
                    $this->error($result['msg']);
                }

                if($count_result['status']==1){
                    $this->assign('count',$count_result['count']);
                    $this->assign('pageCount',ceil($count_result['count']/$article->pageSize));
                }else{
                    $this->error($count_result['msg']);
                }
            }else{
                if($result['status']==1){
                    $data['status']=1;
                    $data['article']=$result['article'];
                }else{
                    $data['msg']=$result['msg'];
                    $this->ajaxReturn($data);
                }
                if($count_result['status']==1){
                    $data['status']=1;
                    $data['count']=$count_result['count'];
                }else{
                    $data['msg']=$count_result['msg'];
                    $this->ajaxReturn($data);
                }
                $this->ajaxReturn($data);
            }

            $this->assign('empty','<p class="noData">没有数据</p>');
            $this->display();
        }else{
            if(!IS_AJAX){
                $this->redirect('Member/login');
            }else{
                $data['msg']='登录超时';
                $this->ajaxReturn($data);
            }

        }
    }

    //访问个人文章类型
    public function personArticleType(){
        $data=array();
        $data['status']=0;
        $data['msg']='';
        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $articleType=D('ArticleType');
            $articleType->member_id=$member_id;
            if(IS_AJAX){
                $articleType->page=I('post.page');
                $articleType->pageSize=I('post.page_size');
                $articleType->key=trim(I('post.key'));
                $articleType->keyItem=I('post.keyItem');
                $articleType->com=I('post.com');
            }
            $result=$articleType->getArticleTypeByMemberId();
            $resultCount=$articleType->getArticleTypeCountByMemberId();
            if(!IS_AJAX){
                if($result['status']==1){
                    $this->assign('articleType',$result['articleType']);
                }else{
                    $this->error($result['msg']);
                }
                if($resultCount['status']==1){
                    $this->assign('count',$resultCount['count']);
                    $this->assign('pageCount',ceil($resultCount['count']/$articleType->pageSize));
                }else{
                    $this->error($resultCount['msg']);
                }
                $this->assign('empty','<p class="noData">没有数据</p>');
                $this->display();
            }else{
                if($result['status']==1){
                    $data['status']=1;
                    $data['articleType']=$result['articleType'];
                }else{
                    $data['msg']=$result['msg'];
                    $this->ajaxReturn($data);
                }
                if($resultCount['status']==1){
                    $data['status']=1;
                    $data['count']=$resultCount['count'];
                }else{
                    $data['msg']=$resultCount['msg'];
                    $this->ajaxReturn($data);
                }
                $this->ajaxReturn($data);
            }
        }else{
            if(!IS_AJAX){
                $this->error('Member/login');
            }else{
                $data['msg']='登录超时';
                $this->ajaxReturn($data);
            }
        }
    }

    //访问个人相册
    public function personPhoto(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photo=D('Photo');
            $photo->member_id=$member_id;
            if(IS_AJAX){
                $photo->page=I('post.page');
                $photo->pageSize=I('post.page_size');
                $photo->key=trim(I('post.key'));
                $photo->keyItem=I('post.keyItem');
                $photo->com=I('post.com');
            }
            $result=$photo->getPhotoByMemberId();
            $resultCount=$photo->getCountByMemberId();
            $this->result($result,'photo',$photo->pageSize,$data);
            $this->result($resultCount,'count',$photo->pageSize,$data);
            if(!IS_AJAX){
                $this->assign('empty',C('NODATA'));
                $this->display();
            }else{
                $this->ajaxReturn($data);
            }
        }else{
            if(!IS_AJAX){
                $this->error('Member/login');
            }else{
                $data['msg']='登录超时';
                $this->ajaxReturn($data);
            }
        }
    }

    //访问用户相片
    public function personPhotoImg(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $photoImg=D('PhotoImg');
            if(IS_AJAX){
                $photoImg->page=I('post.page');
                $photoImg->pageSize=I('post.page_size');
                $photoImg->key=trim(I('post.key'));
                $photoImg->keyItem=I('post.keyItem');
                $photoImg->com=I('post.com');
                $photoImg->photo_id=I('post.photo_id');
            }else{
                $photoImg->photo_id=I('get.photo_id');
            }
            $result=$photoImg->getPhotoImg();
            $resultCount=$photoImg->getPhotoImgCount();
            $this->result($result,'photoImg',$photoImg->pageSize,$data);
            $this->result($resultCount,'count',$photoImg->pageSize,$data);
            if(!IS_AJAX){
                $this->assign('empty',C('NODATA'));
                $this->display();
            }else{
                $this->ajaxReturn($data);
            }
        }else{  //未登入跳转到登录页面
            if(!IS_AJAX){
                $this->error('Member/login');
            }else{
                $data['msg']='登录超时';
                $this->ajaxReturn($data);
            }
        }
    }

    //访问个人留言板
    public function personMess(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $mess=D('Mess');
            if(IS_AJAX){
                $mess->page=I('post.page');
                $mess->pageSize=I('post.page_size');
                $mess->key=I('post.key');
                $mess->keyItem=I('post.keyItem');
                $mess->com=I('post.com');
            }
            $mess->messed_id=$member_id;
            $result=$mess->getMessByMemberId();
            $resultCount=$mess->getCount();
            if(!IS_AJAX){
                if($result['status']==1){
                    $this->assign('mess',$result['mess']);
                }else{
                    $this->error($result['msg']);
                }
                if($resultCount['status']==1){
                    $this->assign('count',$resultCount['count']);
                    $this->assign('pageCount',ceil($resultCount['count']/$mess->pageSize));
                }else{
                    $this->error($resultCount['msg']);
                }
                $this->assign('empty','<p class="noData">没有数据</p>');
                $this->display();
            }else{
                if($result['status']==1){
                    $data['status']=1;
                    $data['mess']=$result['mess'];
                }else{
                    $data['msg']=$result['msg'];
                    $this->ajaxReturn($data);
                }
                if($resultCount['status']==1){
                    $data['status']=1;
                    $data['count']=$resultCount['count'];
                }else{
                    $data['msg']=$resultCount['msg'];
                    $this->ajaxReturn($data);
                }
                $this->ajaxReturn($data);
            }
        }else{  //登录超时
            if(!IS_AJAX){
                $this->error('Member/login');
            }else{
                $data['msg']='登录超时';
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