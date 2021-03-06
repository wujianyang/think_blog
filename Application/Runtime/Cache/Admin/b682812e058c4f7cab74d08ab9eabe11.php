<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>管理员管理_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>info.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/admin.js"></script>
    <script type="text/javaScript">

    </script>
    <style type="text/css">
        .page_div{display: block;}
        .list_table{width:600px;margin:0 auto;}
    </style>
</head>
<body>
<div class="info_title">
    <span>管理员管理</span>
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
</div>
<div class="main_form">
    <div id="list_div">
        <div class="toolbar">
            <div class="lfloat">
                <input type="button" value="添加" id="add" />
                <input type="button" value="删除" id="del" />
                <input type="button" value="冻结" id="freeze" />
                <input type="button" value="激活" id="not_freeze" />
                <input type="button" value="重置密码" id="resetPasswd" />
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="admin_name+like">管理员名称</option>
                </select>
                <input name="key" id="key" value="" placeholder="请输入关键字" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <table class="list_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50" class="order" rel="id" value="0">ID</th>
                    <th width="150" class="order" rel="member_name" value="0">管理员名称</th>
                    <th width="150" class="order" rel="last_ip" value="0">上次登录IP</th>
                    <th width="150" class="order" rel="last_time" value="0">上次登录时间</th>
                    <th width="100" class="order" rel="is_freeze" value="0">是否冻结</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["id"]); ?></td>
                        <td width="150"><a class="info" href="javascript:void(0);" value="<?php echo ($rows["id"]); ?>"><?php echo ($rows["admin_name"]); ?></a></td>
                        <td width="150"><?php echo ($rows["last_ip"]); ?></td>
                        <td width="150"><?php echo ($rows["last_time"]); ?></td>
                        <?php if($rows["is_freeze"] == 1): ?><td width="100">已冻结</td>
                            <?php else: ?>
                            <td width="100">已激活</td><?php endif; ?>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                <?php if($data["count"] == 0): ?><div class="error">没有数据</div><?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($data["count"] > 0): ?><div class="page_div" id="page_div">
                <span class="page"><a href="javascript:void(0);">首页</a></span>
                <span class="page"><a href="javascript:void(0);">上一页</a></span>
                <label id="curpage">1</label> /
                <label id="page_count"><?php echo ($data["pageCount"]); ?></label>
                <?php if($data["pageCount"] == 1): ?><span class="page"><a href="javascript:void(0);">下一页</a></span>
                    <span class="page"><a href="javascript:void(0);">末页</a></span>
                    <?php else: ?>
                    <span class="page hov"><a href="javascript:void(0);" rel="2">下一页</a></span>
                    <span class="page hov"><a href="javascript:void(0);" rel="<?php echo ($data["pageCount"]); ?>">末页</a></span><?php endif; ?>
                <span>
                    <select id="toPageSize">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                </span>
                <span>
                    <input type="text" id="page_text" class="page_text" />
                    <input type="button" value="跳转" id="toPage" />
                </span>
                <span>共<?php echo ($data["count"]); ?>条数据</span>
            </div><?php endif; ?>
    </div>
    <div class="add_div" id="add_div">
        <form id="add_form" name="add_form" method="post">
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="50">管理员名称：</th>
                    <td width="300"><input type="text" name='admin_name' id="admin_name" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>登录密码：</th>
                    <td><input type="password" name='passwd' id="password" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>确认密码：</th>
                    <td><input type="password" name='passwd2' id="password2" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="保存" />&nbsp;&nbsp;
                        <input type="reset" value="重置" />&nbsp;&nbsp;
                        <input type="button" value="取消" id="close_div" />
                    </td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>

    <div id="edit_div" class="edit_div">
        <form id="edit_form" name="edit_form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="member[id]" id="id_edit" />
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="50">用户名：</th>
                    <td width="200"><input type="text" name='member[member_name]' id="member_name_edit" required /></td>
                    <td rowspan="4" width="200"><img src="" width="150px" height="150px" id="head_pic_edit_img" /></td>
                </tr>
                <tr>
                    <th>性别：</th>
                    <td>
                        <select name='member[sex]' id="sex_edit">
                            <option value="1" selected="selected">男</option>
                            <option value="0">女</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th>邮箱：</th>
                    <td><input type="email" name="member[email]" id="email_edit" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>电话：</th>
                    <td><input type="tel" name="member[tel]" id="tel_edit" required pattern="(\d{3,4}-\d{7,8})|(\d{11})" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>地址：</th>
                    <td><input type="text" name="member[address]" id="address_edit" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>密码问题：</th>
                    <td><input type="text" name="member[question]" id="question_edit" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>密码答案：</th>
                    <td><input type="text" name="member[answer]" id="answer_edit" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>头像：</th>
                    <td>
                        <input type="file" name="head_pic" />
                        <input type="hidden" id="head_pic_edit" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="保存" />&nbsp;&nbsp;
                        <input type="reset" value="重置" />&nbsp;&nbsp;
                        <input type="button" value="取消" id="close_edit_div" />
                    </td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>

</div>
</body>
</html>