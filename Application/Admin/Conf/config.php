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
    'DEFAULT_HEAD_PIC'=>'10000000',
    'USER_PASSWORD_DEFAULT'=>md5('blog123456'),
    'ADMIN_PASSWORD_DEFAULT'=>md5('admin123456'),
    'NODATA'    =>  '<p class="noData">没有数据</p>',
    'TITLE'     =>  '博客系统',

    //路由设置
    'URL_ROUTER_ON'=>true,
    'URL_ROUTE_RULES'=>array(
        //'index'=>'index.html'
    ),

    'SHOW_PAGE_TRACE' =>true,

);