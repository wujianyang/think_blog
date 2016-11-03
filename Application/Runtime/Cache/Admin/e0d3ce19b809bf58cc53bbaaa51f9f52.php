<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>申诉审核_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/complaintAdmin.js"></script>
    <script type="text/javaScript">

    </script>
    <style type="text/css">
        .list_table{width:1000px;}
        .page_div{display: block;}
    </style>
</head>
<body>
<div class="main_form">
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
    <div id="list_div">
        <div class="toolbar">
            <div class="lfloat">
                <input type="button" value="通过" id="pass" />
                <input type="button" value="忽略" id="ignore" />
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="pass+eq">已审核</option>
                    <option value="notpass+eq">未审核</option>
                    <option value="member_id+eq">用户ID</option>
                    <option value="member_name+like">用户名</option>
                    <option value="admin_id+eq">审核员ID</option>
                    <option value="admin_name+like">审核员</option>
                </select>
                <input name="key" id="key" value="" placeholder="请输入关键字" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <table class="list_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50">ID</th>
                    <th width="150">用户名</th>
                    <th width="350">申诉内容</th>
                    <th width="150">提交时间</th>
                    <th width="150">审核员</th>
                    <th width="150">审核时间</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td><?php echo ($rows["id"]); ?></td>
                        <td><?php echo ($rows["member_name"]); ?></td>
                        <td><?php echo ($rows["complain_content"]); ?></td>
                        <td><?php echo ($rows["complain_time"]); ?></td>
                        <?php if($rows["admin_name"] != null): ?><td><?php echo ($rows["admin_name"]); ?></td>
                            <?php else: ?>
                            <td>未审核</td><?php endif; ?>
                        <?php if($rows["admin_name"] != null): ?><td><?php echo ($rows["pass_time"]); ?></td>
                            <?php else: ?>
                            <td>未审核</td><?php endif; ?>
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
                        <option value="50">60</option>
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
        <form id="add_form" name="add_form" method="post" enctype="multipart/form-data">
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="50">用户名：</th>
                    <td width="300"><input type="text" name='member_name' id="member_name" required /></td>
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
                    <th>性别：</th>
                    <td>
                        <select name='sex'>
                            <option value="1" selected="selected">男</option>
                            <option value="0">女</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th>邮箱：</th>
                    <td><input type="email" name="email" id="email" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>电话：</th>
                    <td><input type="tel" name="tel" id="tel" required pattern="(\d{3,4}-\d{7,8})|(\d{11})" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>地址：</th>
                    <td><input type="text" name="address" id="address" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>密码问题：</th>
                    <td><input type="text" name="question" id="question" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>密码答案：</th>
                    <td><input type="text" name="answer" id="answer" required minlength="10" /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>头像：</th>
                    <td><input type="file" name="head_pic" id="head_pic" /></td>
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