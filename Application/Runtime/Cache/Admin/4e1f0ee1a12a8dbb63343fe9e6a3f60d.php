<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
</head>
<body>
    <form action="/thinkphp/index.php/admin/user/add" method="post">
        <table>
            <tr>
                <td>用户名：</td>
                <td><input type="text" name="loginName" /></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name="passwd" /></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" name="passwd2" /></td>
            </tr>
            <tr>
                <td>真实名：</td>
                <td><input type="text" name="trueName" /></td>
            </tr>
            <tr>
                <td>密码问题：</td>
                <td><input type="text" name="question" /></td>
            </tr>
            <tr>
                <td>密码答案：</td>
                <td><input type="text" name="answer" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="提交" />&nbsp;&nbsp;
                    <input type="reset" value="重置" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>