<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>好友列表</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>friends.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>home/page.js"></script>
    <script src="<?php echo (C("JS")); ?>home/friends.js"></script>
</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo U(Index/index);?>">首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
            <a href="<?php echo U('Member/register');?>">注册</a>
        <?php else: ?>
            <a href="<?php echo U('Member/personCenter');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
            <a href="<?php echo U('Member/index');?>">我的主页</a>
            <a href="<?php echo U('Article');?>">我的文章</a>
            <a href="<?php echo U('Photo');?>">我的相册</a>
            <a href="<?php echo U('Mess');?>">我的留言板</a>
            <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <form action="<?php echo (C("HOST_DIR")); ?>Home/Index/search" name="search_form" method="post">
        <select name="keyItem" id="keyItem_search">
            <option value="member">用户</option>
            <option value="article">文章</option>
        </select>
        <input type="text" name="key" id="key_search" placeholder="请输入关键字" />
        <input type="submit" value="搜索" />
        </form>
    </div>
    <div class="clear"></div>
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
</div>
<input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
<input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
<input type="hidden" value="<?php echo ($_GET['f']); ?>" id="f" />
<input type="hidden" value="<?php echo ($_GET['member_id']); ?>" id="member_id" />
<div class="friends_div">
    <div class="friends_title">
        <?php if($member != null): ?><a href="<?php echo U('Member/index',array('member_id'=>$member['id']));?>"><?php echo ($member["member_name"]); ?></a> >><?php endif; ?>
        <?php if($_GET['f']== focus): ?><span>关注列表</spa n>
            <?php elseif($_GET['f']== fans): ?>
            <span>粉丝列表</span>
            <?php else: ?>
            <span>用户列表</span>
            <input type="hidden" value="search" id="page_search" />
            <input type="hidden" value="<?php echo ($_POST['key']); ?>" id="keys_search" />
            <input type="hidden" value="<?php echo ($_POST['keyItem']); ?>" id="keyItem_search" /><?php endif; ?>
    </div>
    <ul id="list">
        <?php if(is_array($friends)): $i = 0; $__LIST__ = array_slice($friends,0,20,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$friends): $mod = ($i % 2 );++$i;?><li>
                <p>
                    <img src="<?php echo (C("UPLOAD")); echo ($friends["head_pic"]); ?>" width="30" height="30" />
                    <span><a href="<?php echo U('Member/index',array('member_id'=>$friends['member_id']));?>"><?php echo ($friends["member_name"]); ?></a></span>
                </p>
                <p>
                    <?php if($friends["sex"] == 1): ?><label>性别：<span>男</span></label>
                        <?php elseif($friends["sex"] == 0): ?>
                        <label>性别：<span>女</span></label><?php endif; ?>
                    <label>访问量：<span><?php echo ($friends["hitnum"]); ?></span></label>
                </p>
                <p>
                    <span><a href="<?php echo U('Member/friends',array('member_id'=>$friends['member_id'],'f'=>'focus'));?>">关注(<?php echo ($friends["focus_count"]); ?>)</a></span>
                    <span><a href="<?php echo U('Member/friends',array('member_id'=>$friends['member_id'],'f'=>'fans'));?>">粉丝(<?php echo ($friends["fans_count"]); ?>)</a></span>
                </p>
                <?php if($_GET['f']== fans): if($friends["iseach"] == 1): ?><div class="btn cencelFocus" rel="<?php echo ($friends["member_id"]); ?>">取消关注</div>
                        <?php else: ?>
                        <div class="btn focus" rel="<?php echo ($friends["member_id"]); ?>">关注</div><?php endif; ?>
                    <?php elseif($_GET['f']== focus): ?>
                    <div class="btn cencelFocus" rel="<?php echo ($friends["member_id"]); ?>">取消关注</div>
                    <?php else: ?>
                    <?php if($friends["isfocus"] == 1): ?><div class="btn cencelFocus" rel="<?php echo ($friends["member_id"]); ?>">取消关注</div>
                        <?php else: ?>
                        <div class="btn focus" rel="<?php echo ($friends["member_id"]); ?>">关注</div><?php endif; endif; ?>


            </li><?php endforeach; endif; else: echo "$empty" ;endif; ?>
        <div class="clear"></div>
    </ul>
    <?php if($pageCount > 0): ?><div class="page_div" id="page_div">
            <span class="page"><a href="javascript:void(0);">首页</a></span>
            <span class="page"><a href="javascript:void(0);">上一页</a></span>
            <label id="curpage">1</label> /
            <label id="page_count"><?php echo ($pageCount); ?></label>
            <?php if($pageCount == 1): ?><span class="page"><a href="javascript:void(0);">下一页</a></span>
                <span class="page"><a href="javascript:void(0);">末页</a></span>
                <?php else: ?>
                <span class="page hov"><a href="javascript:void(0);" rel="2">下一页</a></span>
                <span class="page hov"><a href="javascript:void(0);" rel="<?php echo ($pageCount); ?>">末页</a></span><?php endif; ?>
                <span>
                    <select id="toPageSize">
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
            <span>共<?php echo ($count); ?>条数据</span>
        </div><?php endif; ?>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>