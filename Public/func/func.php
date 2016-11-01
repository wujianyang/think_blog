<?php
//转义字符转换
function html_decode($arr=array(),$field=''){
    for($i=0;$i<count($arr);$i++){
        $arr[$i][$field]=htmlspecialchars_decode($arr[$i][$field]);
    }
    return $arr;
}

function getIPaddress(){
    $IPaddress = '';
    if (isset ( $_SERVER )){
        if (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )){
            $IPaddress = $_SERVER ["HTTP_X_FORWARDED_FOR"];
        }
        else if (isset ( $_SERVER ["HTTP_CLIENT_IP"] )){
            $IPaddress = $_SERVER ["HTTP_CLIENT_IP"];
        }
        else{
            $IPaddress = $_SERVER ["REMOTE_ADDR"];
        }
    }else{
        if (getenv ( "HTTP_X_FORWARDED_FOR" )){
            $IPaddress = getenv ( "HTTP_X_FORWARDED_FOR" );
        }
        else if (getenv ( "HTTP_CLIENT_IP" )){
            $IPaddress = getenv ( "HTTP_CLIENT_IP" );
        }
        else{
            $IPaddress = getenv ( "REMOTE_ADDR" );
        }
    }
    $ips = explode ( ",", $IPaddress );
    return $ips [0];
}

/*function upload_file_edit($file){
    $errMsg='';
    $status=0;
    $filepath=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/blog/images/head_pic/head_pic_default.png';
    if(is_uploaded_file($file['tmp_name'])){
        $ext  =  explode('.', $file['name'])[count(explode('.', $file['name']))-1];

        if($ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='png'){
            $error=$file['error'];
            if($error==0){
                $filepath=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/blog/images/head_pic/head_pic_".time().'.'.$ext;
                $fileSavePath=PATH.'images/head_pic/head_pic_'.time().'.'.$ext;
                move_uploaded_file($file['tmp_name'],$fileSavePath);
                $status=1;
                $errMsg='上传成功';
            }elseif($error==1){
                $errMsg='文件大小超过了10M';
            }elseif($error==2){
                $errMsg='文件大小超过了10M';
            }elseif($error==3){
                $errMsg='文件只有部分被上传';
            }elseif($error==4){
                $errMsg='没有文件被上传';
            }
        }else{
            $errMsg='请上传jpg,jpeg,gif,png等格式的图片';
        }
    }else{
        $status=1;
        $errMsg='默认头像';
    }
    return json_decode('{"status":'.$status.',"msg":"'.$errMsg.'","filePath":"'.$filepath.'","fileSavePath":"'.$fileSavePath.'"}');
}

function upload_head_pic($file){
    $status=0;
    $msg='';
    $filePath=C('IMAGES').'head_pic/head_pic_default.png';
    $fileSavePath=C('ROOT').'Public/images/head_pic/head_pic_default.png';
    if(is_uploaded_file($file['tmp_name'])){
        $ext  =  explode('.', $file['name'])[count(explode('.', $file['name']))-1]; //文件后缀
        if($ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='png'){
            $filePath=C('UPLOAD').'head_pic/head_pic_'.time().'.'.$ext;
            $fileSavePath=C('UPLOAD_PATH').'head_pic/head_pic_'.time().'.'.$ext;
            move_uploaded_file($file['tmp_name'],$fileSavePath);
            $status=1;
            $msg='上传成功';
        }else{
            $msg='请上传jpg,jpeg,gif,png等格式的图片';
        }
    }else{
        $status=1;
        $msg='默认图片';
    }
    return json_decode('{"status":'.$status.',"msg":"'.$msg.'","filePath":"'.$filePath.'","fileSavePath":"'.$fileSavePath.'"}');
}*/

function upload_file($file,$dir){
    $status=0;
    $msg='';
    if($dir!=''){
        $fileDir=C('ROOT').C('UPLOAD').$dir.'/';
        if(is_dir($fileDir)){
            $fileName='default.png';
            if(is_uploaded_file($file['tmp_name'])){
                $ext = explode('.', $file['name'])[count(explode('.', $file['name']))-1]; //文件后缀
                if($ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='png'){
                    $fileName=$dir.'_'.time().'.'.$ext;
                    move_uploaded_file($file['tmp_name'],$fileDir.$fileName);
                    $status=1;
                    $msg='上传成功';
                }else{
                    $msg='请上传jpg,jpeg,gif,png等格式的图片';
                }
            }else{
                $status=1;
                $msg='默认图片';
            }
        }else{
            $msg='目录不存在';
        }
    }else{
        $msg='目录为空';
    }
    return json_decode('{"status":'.$status.',"msg":"'.$msg.'","fileName":"'.$fileName.'"}');
}