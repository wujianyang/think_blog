<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文章分类</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>articleType.css" />
</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo U(Index/index);?>">首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
        <a href="<?php echo U('Member/register');?>">注册</a><?php endif; ?>
        <?php if($_SESSION['MEMBER']!= null): ?><a href="<?php echo U('Member/info');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
        <a href="<?php echo U('Member/index');?>">我的主页</a>
        <a href="<?php echo U('Article');?>">我的文章</a>
        <a href="<?php echo U('Photo');?>">我的相册</a>
        <a href="<?php echo U('Mess');?>">我的留言板</a>
        <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <select name="keyItem">
            <option value="member">用户</option>
            <option value="article">文章</option>
        </select>
        <input type="text" name="key" placeholder="请输入关键字" />
        <input type="submit" value="搜索" />
    </div>
    <div class="clear"></div>
</div>
<div class="article_type_div">
    <div class="article_type_title">
        <span>用户名</span>
    </div>
    <div class="article_type_list">
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="article_type_d">
            <a href="#">生活日志(10)</a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>