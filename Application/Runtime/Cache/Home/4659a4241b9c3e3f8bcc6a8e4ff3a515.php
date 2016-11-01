<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>admin.css" />
    <style type="text/css">

    </style>
</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo U(Index/index);?>">网站首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
            <a href="<?php echo U('Member/register');?>">注册</a>
        <?php else: ?>
            <a href="<?php echo U('Member/index');?>">我的主页</a>
            <a href="<?php echo U('Member/personCenter');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
            <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <form action="<?php echo (C("HOST_DIR")); ?>Home/Index/search" name="search_form" method="post">
        <select name="keyItem" id="keyItem_search">
            <option value="member">用户</option>
            <option value="article">文章</option>
        </select>
        <input type="text" name="key" id="key_search" placeholder="请输入关键字" required />
        <input type="submit" value="搜索" />
        </form>
    </div>
    <div class="clear"></div>
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
</div>
<div class="main_div">
    <div class="left_div">
        <div class="left_menu">
            <ul>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/info.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>我的资料</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/personArticle.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>我的文章</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/personArticleType.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>我的文章分类</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/personPhoto.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>我的相册</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/personMess.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>我的留言板</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Home/Member/updatePasswd.<?php echo (C("URL_HTML_SUFFIX")); ?>" target="right"><li>修改密码</li></a>
            </ul>
        </div>
    </div>
    <div class="right_div">
        <iframe name="right" class="main_area" src="<?php echo (C("HOST_DIR")); ?>Home/Member/info.<?php echo (C("URL_HTML_SUFFIX")); ?>">

        </iframe>
    </div>
    <div class="clear"></div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>