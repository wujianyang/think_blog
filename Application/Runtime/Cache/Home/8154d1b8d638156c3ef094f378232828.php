<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的资料_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>info.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>home/info.js"></script>
</head>
<body>
<input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
<input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <div class="info_title">
        <span>个人资料</span>
    </div>
    <form id="info_form" name="info_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo ($member["id"]); ?>" />
        <table class="info_table" cellspacing="1" cellpadding="0">
            <tr>
                <th width="150">用户名：</th>
                <td width="200"><input type="text" name='member_name' id="member_name" value="<?php echo ($member["member_name"]); ?>" required /></td>
                <td rowspan="4" width="200"><img src="<?php echo (C("UPLOAD")); echo ($member["head_pic"]); ?>" width="120px" height="120px" id="head_pic_img" /></td>
            </tr>
            <tr>
                <th>性别：</th>
                <td>
                    <select name='sex' id="sex">
                        <?php if($member["sex"] == 1): ?><option value="1" selected="selected">男</option>
                        <option value="0">女</option><?php endif; ?>
                        <?php if($member["sex"] == 0): ?><option value="1">男</option>
                            <option value="0" selected="selected">女</option><?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>邮箱：</th>
                <td><input type="email" name="email" id="email"value="<?php echo ($member["email"]); ?>" required /></td>
            </tr>
            <tr>
                <th>电话：</th>
                <td><input type="tel" name="tel" id="tel"value="<?php echo ($member["tel"]); ?>" required pattern="(\d{3,4}-\d{7,8})|(\d{11})" /></td>
            </tr>
            <tr>
                <th>地址：</th>
                <td><input type="text" name="address" id="address"value="<?php echo ($member["address"]); ?>" required minlength="10" /></td>
                <td></td>
            </tr>
            <tr>
                <th>密码问题：</th>
                <td><input type="text" name="question" id="question"value="<?php echo ($member["question"]); ?>" required minlength="10" /></td>
                <td></td>
            </tr>
            <tr>
                <th>密码答案：</th>
                <td><input type="text" name="answer" id="answer" value="<?php echo ($member["answer"]); ?>" required minlength="10" /></td>
                <td></td>
            </tr>
            <tr>
                <th>访问量：</th>
                <td><?php echo ($member["hitnum"]); ?></td>
                <td></td>
            </tr>
            <tr>
                <th>上次登录IP：</th>
                <td><?php echo ($member["last_ip"]); ?></td>
                <td></td>
            </tr>
            <tr>
                <th>上次登录时间：</th>
                <td><?php echo ($member["last_time"]); ?></td>
                <td></td>
            </tr>
            <tr>
                <th>更换头像：</th>
                <td>
                    <input type="file" name="head_pic" />
                    <input type="hidden" id="head_pic_edit" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="保存" />&nbsp;
                    <input type="reset" value="重置" />
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>