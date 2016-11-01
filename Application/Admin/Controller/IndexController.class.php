<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function Index(){
        $this->display('./index');
    }
}