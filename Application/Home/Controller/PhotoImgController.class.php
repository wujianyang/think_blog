<?php
namespace Home\Controller;
use Think\Controller;
class PhotoImgController extends Controller{

    //用户添加相片
    public function personAdd(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $photoImg=D('PhotoImg');
            $photoImg->member_id=I('session.MEMBER')['id'];
            $photoImg->photo_id=I('post.photo_id');
            $photoImg->img_title=I('post.photoImg')['img_title'];
            if (isset($_FILES['img_src']) && !empty($_FILES['img_src'])) {
                $photoImg->img_src = $_FILES['img_src'];
            }else{
                $data['msg']='请上传相片';
            }
            $result=$photoImg->personAdd();
            unset($photoImg);
            $data=$result;
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);
    }

    //个人删除相片
    public function personDel(){
        $common=A('Common');
        $common->personDel('PhotoImg');
    }

    //查看详细相片信息
    public function personInfo(){
        $common=A('Common');
        $common->personInfo('PhotoImg');
    }

    //个人编辑相片
    public function personEdit(){
        $data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $photoImg=D('PhotoImg');
            $photoImg->id=I('post.photoImg')['id'];
            $photoImg->img_title=I('post.photoImg')['img_title'];
            if (isset($_FILES['img_src']) && !empty($_FILES['img_src'])) {
                $photoImg->img_src = $_FILES['img_src'];
            }else{
                $data['msg']='请上传相片';
            }
            $result=$photoImg->personEdit();
            unset($photoImg);
            $data=$result;
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);

        /*$data=array();
        $data['status']=0;
        $data['msg']='';

        if(I('session.MEMBER')!=null){
            $member_id=I('session.MEMBER')['id'];
            $photoImg=D('PhotoImg');
            $photoImg->member_id=$member_id;
            $photoImg->id=I('post.photoImg')['id'];
            $photoImg->img_title=I('post.photoImg')['img_title'];
            if($_FILES['img_src']!=null){
                //上传相片文件
                $arr_uploadConfig=array(
                    'name'      =>  'img_src',
                    'maxSize'   =>  100000,
                    'exts'      =>  array('png','jpg','jpeg','gif'),
                    'rootPath'  =>  C('ROOT').C('UPLOAD_PATH'),
                    'savePath'  =>  'photo_img/',
                    'saveName'  =>  'photo_img_'.time(),
                    'autoSub'   =>  false

                );
                $resultUpload=$this->upload($arr_uploadConfig);
                if($resultUpload['status']==1){ //上传成功

                    $photoImg->img_src=$arr_uploadConfig['savePath'].$resultUpload['upload']['img_src']['savename'];
                }
            }

            $result=$photoImg->personEdit();
            if($result['status']==1){
                $data['status']=1;
            }else{  //编辑失败删除已上传相片文件
                unlink($arr_uploadConfig['rootPath'].$arr_uploadConfig['savePath'].$resultUpload['upload']['img_src']['savename']);
            }
            $data['msg']=$result['msg'];
        }else{
            $data['msg']='登录超时';
        }

        $this->ajaxReturn($data);*/
    }

}