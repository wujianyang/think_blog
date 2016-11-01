<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>好友列表</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>friends.css" />
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
<div class="friends_div">
    <div class="friends_title">
        <span>关注列表/粉丝列表</span>
    </div>
    <ul>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <li>
            <p>
                <img src="/think_blog/Public/images/head_pic_default.png" width="30" height="30" />
                <span><a href="#">username</a></span>
            </p>
            <p>
                <label>性别：<span>男</span></label>
                <label>访问量：<span>999</span></label>
            </p>
            <p>
                <span><a href="#">关注(10)</a></span>
                <span><a href="#">粉丝(10)</a></span>
            </p>
        </li>
        <div class="clear"></div>
    </ul>
    <div class="page_div" id="page_div">
        <span class="page"><a href="javascript:void(0);">首页</a></span>
        <span class="page"><a href="javascript:void(0);">上一页</a></span>
        <label id="curpage">1</label> /
        <label id="page_count"><?php echo ($data["pageCount"]); ?></label>
        <span class="page hov"><a href="javascript:void(0);" rel="2">下一页</a></span>
        <span class="page hov"><a href="javascript:void(0);" rel="<?php echo ($data["pageCount"]); ?>">末页</a></span>
                <span>
                    <select id="toPageSize">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">60</option>
                    </select>
                </span>
                <span>
                    <input type="text" id="page_text" class="page_text" />
                    <input type="button" value="跳转" id="toPage" />
                </span>
        <span>共<?php echo ($data["count"]); ?>条评论</span>
    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>