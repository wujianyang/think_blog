<?php
return array(
	//'配置项'=>'配置值'
    //数据库配置
    'URL_MODEL'=>2,
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'think_blog',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口

    //系统配置
    'ROOT'=>$_SERVER['DOCUMENT_ROOT'],
    'HOST'=>$_SERVER['HTTP_HOST'],
    'HOST_DIR'=>'/think_blog/',
    'JS'=>'/think_blog/Public/js/',
    'CSS'=>'/think_blog/Public/css/',
    'IMAGES'=>'/think_blog/Public/images/',
    'PLUGINS'=>'/think_blog/Public/plugins/',
    'FUNC'=>'/think_blog/Public/func/',
    'UPLOAD'=>'/think_blog/Upload/',
    'UPLOAD_PATH'=>'think_blog/Upload/',
    'USER_PASSWORD_DEFAULT'=>md5('blog123456'),
    'HEAD_PIC_DEFAULT'=>'head_pic/head_pic_default.png',
    'NODATA'    =>  '<p class="noData">没有数据</p>',
    'TITLE'     =>  '博客系统',

    'SHOW_PAGE_TRACE' => true,
    'URL_HTML_SUFFIX' => 'html',
    'URL_CASE_INSENSITIVE'=>false,

    //路由配置
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=> array(
        //''  =>  '',
        '/^login$/'  =>   array('Home/Member/login'),
        '/^register/'  =>   array('Home/Member/register'),
        '/^forgetPasswd/'  =>   array('Home/Member/forgetPasswd'),
        '/^member_(\d{1,})/'  =>   array('Home/Member/index?member_id=:1'),
        '/^info\/member_(\d{1,})/'  =>   array('Home/Member/info?member_id=:1'),
        '/^article_(\d{1,})/'  =>  array('Home/Article/index?article_id=:1'),
        '/^hotList\/member_(\d{1,})/'  =>  array('Home/Article/hotArticleList?member_id=:1'),
        '/^list\/(article_type_(\d{1,})|member_(\d{1,}))/'  =>  array('Home/Article/articleList?article_type_id=:2&member_id=:3'),
        '/^photo\/(photo_(\d{1,})|member_(\d{1,}))/'  =>  array('Home/Photo/index?photo_id=:2&member_id=:3'),
        '/^mess\/member_(\d{1,})/'  =>  array('Home/Mess/index?member_id=:1'),
    ),
);