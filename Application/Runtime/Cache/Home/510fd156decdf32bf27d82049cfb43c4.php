<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户注册_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>login.css"/>

    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>home/register.js"></script>

    <style type="text/css">
        .sex{width:300px;margin-bottom: 10px;outline: none;padding: 5px;font-size: 13px;color: #000;border-top: 1px solid #312E3D;border-left: 1px solid #312E3D;border-right: 1px solid #312E3D;border-bottom: 1px solid #56536A;border-radius: 5px;}
    </style>
</head>
<body>
<div id="login">
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
    <h1>Sign Up</h1>
    <form id="add_form" name="add_form" method="post" enctype="multipart/form-data">
        <input type="text" required placeholder="用户名" name="member_name" id="member_name" />
        <select class="sex" name="sex" id="sex">
            <option value="1">男</option>
            <option value="0">女</option>
        </select>
        <input type="password" required placeholder="密码" name="passwd" id="passwd" />
        <input type="password" required placeholder="确认密码" name="passwd2"id="passwd2" />
        <input type="text" required placeholder="邮箱" name="email"id="email" />
        <input type="text" required placeholder="电话" name="tel"id="tel" />
        <input type="text" required placeholder="地址" name="address"id="address" />
        <input type="text" required placeholder="密码问题" name="question"id="question" />
        <input type="text" required placeholder="密码答案" name="answer"id="answer" />
        <label style="width: 100px;">头像：</label>
        <input type="file" required name="head_pic"id="head_pic" style="width:200px;border:none;" />
        <input class="but" type="submit" value="注册" />
    </form>
</div>
</body>
</html>