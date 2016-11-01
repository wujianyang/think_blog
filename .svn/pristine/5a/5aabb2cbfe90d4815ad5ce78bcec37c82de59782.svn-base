<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>blog</title>
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>admin.css" />
</head>
<body>
<?php
 header("Content-Type: text/html; charset=utf-8"); include_once '../config/config.php'; include_once PATH.'header.html'; ?>
<div class="main_div">
    <div class="left_div">
        <div class="left_menu">
            <ul>
                <li><a href="#" target="right">管理员管理</a></li>
                <li><a href="member/index.php" target="right">用户管理</a></li>
                <li><a href="article/index.php" target="right">文章管理</a></li>
                <li><a href="article_type/index.php" target="right">文章类别管理</a></li>
                <li><a href="photo.php" target="right">相册管理</a></li>
                <li><a href="#" target="right">评论管理</a></li>
                <li><a href="#" target="right">留言管理</a></li>
            </ul>
        </div>
    </div>
    <div class="right_div">
        <iframe name="right" class="main_area" src="/think_blog/index.php/admin/member/index">

        </iframe>
    </div>
    <div class="clear"></div>
</div>
<?php include_once PATH.'footer.html'; ?>
</body>
</html>