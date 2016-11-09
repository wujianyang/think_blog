<?php
namespace Home\Model;
use Think\Model;

class CommonModel extends Model{

    /*
     * 上传配置参考
     * array(
           'name'      =>  'img_src',
           'maxSize'   =>  100000,
           'exts'      =>  array('png','jpg','jpeg','gif'),
           'rootPath'  =>  C('ROOT').C('UPLOAD_PATH'),
           'savePath'  =>  'photo_img/',
           'saveName'  =>  'photo_img_'.time(),
           'autoSub'   =>  false   //是否创建子文件夹
       );
     */
    //上传文件代码
    public function upload($config=array()){
        $data=array();
        $data['status']=1;
        $data['msg']='';

        $upload=new \Think\Upload($config);
        $info=$upload->upload();
        if(!$info){ //长传失败
            $data['msg']=$upload->getError();
        }else{  //上传成功
            $data['status']=1;
            $data['upload']=$info;
        }
        return $data;
    }

}