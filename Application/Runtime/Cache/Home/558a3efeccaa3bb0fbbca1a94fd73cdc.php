<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>相册列表_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>photo.css" />
    <style type="text/css">
        /*图片轮播样式*/
        .container{width:700px; height:100%;margin:10px auto;}
        .content{background:#ffffff; margin:0 auto; position:relative; width:220px; height:100px;}
        .content li{position:absolute; top:0; left:0; display:none;}
        .content li p{text-align: center;}
        .content li img{width:700px;}
        .content span{position:absolute; left:47%; top:45%;display: none;}
        .content .left,.content .right{position:absolute; top:0; z-index:11;}
        .content .left{left:0; cursor: url(<?php echo (C("IMAGES")); ?>cur-left.cur.ico),auto;}
        .content .right{right:0;cursor: url(<?php echo (C("IMAGES")); ?>cur-right.cur.ico),auto;}
        .bottom{text-align:center;height:0px; background:#ffffff; margin:0 auto; overflow:hidden; line-height:50px; padding: 0 15px;}

    </style>
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>imgFocus.js"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo C('HOST_DIR');?>">网站首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
            <a href="<?php echo U('Member/register');?>">注册</a>
        <?php else: ?>
            <a href="<?php echo U('Member/index');?>">我的主页</a>
            <a href="<?php echo U('Member/personCenter');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
            <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <form action="<?php echo (C("HOST_DIR")); ?>Home/Index/search" name="search_form" method="get">
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
<div class="photo">
    <div class="photo_type_div">
        <p>
            <img src="<?php echo (C("UPLOAD")); echo ($member["head_pic"]); ?>" width="30px" height="30px" />
            <span><a href="<?php echo U('Member/index',array('member_id'=>$member['id']));?>"><?php echo ($member["member_name"]); ?></a></span>
        </p>
        <ul>
            <?php if(is_array($photo)): $i = 0; $__LIST__ = array_slice($photo,0,null,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i; if($photo['id'] == $photo_op['id']): ?><a href="javascript:void(0);"><li class="op"><?php echo ($photo["photo_title"]); ?></li></a>
                    <?php else: ?>
                    <a href="<?php echo U('Photo/index',array('photo_id'=>$photo['id']));?>"><li><?php echo ($photo["photo_title"]); ?></li></a><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
        </ul>
    </div>
    <div class="photo_div">
        <div class="photo_list_title">
            <span><?php echo ($photo_op["photo_title"]); ?></span>
        </div>
        <div class="photo_list">
            <?php if($photoImg != null): ?><div class="container">
                    <ul class="content">
                        <div class="left"></div>
                        <div class="right"></div>
                        <?php if(is_array($photoImg)): $i = 0; $__LIST__ = array_slice($photoImg,0,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photoImg): $mod = ($i % 2 );++$i;?><li>
                                <p><?php echo ($photoImg["img_title"]); ?></p>
                                <img src="<?php echo (C("UPLOAD")); echo ($photoImg["img_src"]); ?>" />
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <div class="bottom">
                        第 <span id="xz">1</span> 张 / 共 <span id="imgdata"><?php echo ($count); ?></span> 张
                    </div>
                </div>
                <?php else: ?>
                <?php echo ($empty); endif; ?>
        </div>
    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>