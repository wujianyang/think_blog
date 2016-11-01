<?php
//字符截取
function substr_mb($str='',$start=0,$len=10,$encoding='utf-8'){
    if(mb_strlen($str,'utf-8') > $len){
        return mb_substr($str,$start,$len,$encoding).'...';
    }else{
        return $str;
    }
}
