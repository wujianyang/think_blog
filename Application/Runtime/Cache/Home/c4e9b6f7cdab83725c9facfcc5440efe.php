<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>login.css"/>
    <script type="text/javascript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        function getVerify() {
            $('.vImg').attr('src',"<?php echo U('Member/getVerify');?>");
        }
        $('#pre_url').val(document.referrer);
    </script>
</head>
<body>
<div id="login">
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
    <h1>Login</h1>
    <form id="login_form" name="login_form" method="post" action="<?php echo U('Member/login');?>">
        <input type="hidden" value="" id="pre_url" />
        <input type="text" required="required" placeholder="用户名" name="member_name"></input>
        <input type="password" required="required" placeholder="密码" name="passwd"></input>
        <input type="text" required="required" placeholder="验证码" name="vCode" class="vcodeInput"></input>
        <img src="<?php echo U('Member/getVerify');?>" class="vImg" onclick="getVerify()" title="点击更换验证码" />
        <button class="but" type="submit">登录</button>
        <label><input type="checkbox" name="rememberPass" style="width:15px;height:15px;float:left;" />记住密码</label>
        <?php if($msg != ''): ?><div style="color:#f30;text-align:center;"><?php echo ($msg); ?></div><?php endif; ?>
        <div class="registerAndPasswd">
            <a href="<?php echo U('Member/register');?>">注册</a>
            <a href="<?php echo U('Member/forgetPasswd');?>">忘记密码?</a>
            <a href="<?php echo U('Member/complain');?>">账号被冻结?</a>
        </div>

    </form>
</div>
</body>
</html>