<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账号申诉_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>login.css"/>
    <script type="text/javascript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        function getVerify() {
            $('.vImg').attr('src',"<?php echo U('Member/getVerify');?>");
        }
    </script>
</head>
<body>
<div id="login">
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
    <h1>账号申诉</h1>
    <form id="login_form" name="login_form" method="post" action="<?php echo U('Member/complain');?>">
        <input type="hidden" value="" id="pre_url" />
        <input type="text" required="required" placeholder="用户名" name="member_name"></input>
        <textarea required="required" placeholder="申诉内容" name="complain_content" style="height:100px;padding-top:10px;"></textarea>
        <input type="text" required="required" placeholder="验证码" name="vCode" class="vcodeInput"></input>
        <img src="<?php echo U('Member/getVerify');?>" class="vImg" onclick="getVerify()" title="点击更换验证码" />
        <button class="but" type="submit">申诉</button>
        <?php if($msg != ''): ?><div style="color:#f30;text-align:center;"><?php echo ($msg); ?></div><?php endif; ?>
    </form>
</div>
</body>
</html>