<?php
//转义字符转换
function html_decode($arr=array(),$field=''){
    for($i=0;$i<count($arr);$i++){
        $arr[$i][$field]=htmlspecialchars_decode($arr[$i][$field]);
    }
    return $arr;
}