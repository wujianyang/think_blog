<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>info.css" />
</head>
<body>
<div class="info_title">
    <span>修改密码</span>
</div>
<form id="info_form" action="<?php echo U('Admin/updatePasswd');?>" name="info_form" method="post">
    <table class="info_table" cellspacing="1" cellpadding="0" style="width: 300px;">
        <tr>
            <th width="100">原始密码：</th>
            <td width="200"><input type="password" name='old_passwd' id="old_passwd" required /></td>
        </tr>
        <tr>
            <th width="100">新的密码：</th>
            <td width="200"><input type="password" name='passwd' id="passwd" required /></td>
        </tr>
        <tr>
            <th width="100">确认密码：</th>
            <td width="200"><input type="password" name='passwd2' id="passwd2" required /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="保存" />&nbsp;
                <input type="reset" value="重置" />
            </td>
            <td></td>
        </tr>
        <tr>
            <td align="center" colspan="3" style="color:#f30;"><?php echo ($msg); ?></td>
        </tr>
    </table>
</form>
</body>
</html>