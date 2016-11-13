<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>管理后台_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" href="<?php echo (C("CSS")); ?>admin.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script>
        $('.left_menu ul li').click(function(){
            console.log('***');
        });
    </script>
</head>
<body>
<?php
 header("Content-Type: text/html; charset=utf-8"); include_once PATH.'header.html'; ?>

<div class="main_div">
    <div class="left_div">
        <div class="left_menu">
            <ul>
                <p><?php echo ($_SESSION['ADMIN']['admin_name']); ?></p>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Admin/index" target="right" class="sel"><li>管理员管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Member/index" target="right"><li>用户管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Article/index" target="right"><li>文章管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/ArticleType/index" target="right"><li>文章类别管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Photo/index" target="right"><li>相册管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/PhotoImg/index" target="right"><li>相片管理</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Complaint/index" target="right"><li>申诉审核</li></a>
                <a href="<?php echo (C("HOST_DIR")); ?>Admin/Admin/updatePasswd" target="right"><li>修改密码</li></a>
                <a href="<?php echo U('Admin/logout');?>"><li>退出</li></a>
            </ul>
        </div>
    </div>
    <div class="right_div">
        <iframe name="right" class="main_area" src="/think_blog/index.php/admin/Article/index">

        </iframe>
    </div>
    <div class="clear"></div>
</div>
<div class="footer">

</div>
<?php include_once PATH.'footer.html'; ?>
</body>
</html>