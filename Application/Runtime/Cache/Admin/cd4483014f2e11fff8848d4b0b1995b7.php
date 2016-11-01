<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>用户管理_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/memberAdmin.js"></script>
    <script type="text/javaScript">

    </script>
    <style type="text/css">
        .page_div{display: block;}
        .toPage
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
                <input type="button" value="添加" id="add" />
                <input type="button" value="删除" id="del" />
                <input type="button" value="冻结" id="freeze" />
                <input type="button" value="激活" id="not_freeze" />
                <input type="button" value="重置密码" id="resetPasswd" />
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="member_name+like">用户名</option>
                    <option value="email+eq">邮箱</option>
                    <option value="tel+eq">电话</option>
                    <option value="address+like">地址</option>
                    <option value="question+like">密码问题</option>
                    <option value="answer+like">密码答案</option>
                    <option value="hitnum+eq">访问量</option>
                    <option value="last_ip+eq">上次登录IP</option>
                    <option value="last_time+like">上次登录时间</option>
                </select>
                <input name="key" id="key" value="" placeholder="搜索用户名" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <table class="list_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50" class="order" rel="id" value="0">ID</th>
                    <th width="151" class="order" rel="member_name" value="0">用户名</th>
                    <th width="50" class="order" rel="sex" value="0">性别</th>
                    <th width="154" class="order" rel="email" value="0">邮箱</th>
                    <th width="152" class="order" rel="tel" value="0">电话</th>
                    <th width="200" class="order" rel="address" value="0">地址</th>
                    <th width="150" class="order" rel="question" value="0">密码问题</th>
                    <th width="150" class="order" rel="answer" value="0">密码答案</th>
                    <th width="50" class="order" rel="hitnum" value="0">访问量</th>
                    <th width="150" class="order" rel="last_ip" value="0">上次登录IP</th>
                    <th width="150" class="order" rel="last_time" value="0">上次登录时间</th>
                    <th width="100" class="order" rel="is_freeze" value="0">是否冻结</th>
                </tr>
                <tbody id="list_table_tbody">
                    <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["id"]); ?></td>
                        <td width="150"><a class="info" href="javascript:void(0);" value="<?php echo ($rows["id"]); ?>"><?php echo ($rows["member_name"]); ?></a></td>
                        <?php if($rows["sex"] == 1): ?><td width="50">男</td>
                            <?php else: ?>
                            <td width="50">女</td><?php endif; ?>
                        <td width="150"><?php echo ($rows["email"]); ?></td>
                        <td width="150"><?php echo ($rows["tel"]); ?></td>
                        <td width="150"><?php echo ($rows["address"]); ?></td>
                        <td width="150"><?php echo ($rows["question"]); ?></td>
                        <td width="150"><?php echo ($rows["answer"]); ?></td>
                        <td width="150"><?php echo ($rows["hitnum"]); ?></td>
                        <td width="150"><?php echo ($rows["last_ip"]); ?></td>
                        <td width="150"><?php echo ($rows["last_time"]); ?></td>
                        <?php if($rows["is_freeze"] == 1): ?><td width="100">已冻结</td>
                            <?php else: ?>
                            <td width="100">已激活</td><?php endif; ?>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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