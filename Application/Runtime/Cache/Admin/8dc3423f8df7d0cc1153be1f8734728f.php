<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>文章分类管理_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/articleTypeAdmin.js"></script>
    <script type="text/javaScript">

    </script>
    <style type="text/css">
        .list_table{width:550px;margin:0 auto;}
        .info_table{height:150px;}
    </style>
</head>
<body>
<div class="info_title">
    <span>文章类别管理</span>
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
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="article_type_name+like">文章类别名称</option>
                    <option value="member_id+eq">用户ID</option>
                    <option value="member_name+eq">用户名</option>
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
                    <th width="200">文章类别名称</th>
                    <th width="100">用户ID</th>
                    <th width="200">用户名</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["id"]); ?></td>
                        <td width="200"><a class="info" href="javascript:void(0);" value="<?php echo ($rows["id"]); ?>"><?php echo ($rows["article_type_name"]); ?></a></td>
                        <td width="100"><?php echo ($rows["member_id"]); ?></td>
                        <td width="200"><?php echo ($rows["member_name"]); ?></td>
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
        <form id="add_form" name="add_form" method="post" enctype="multipart/form-data">
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th>文章类别名称：</th>
                    <td><input type="text" name='article_type[article_type_name]' id="article_type_name" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>用户名：</th>
                    <td>
                        <select name='article_type[member_id]' id="member_id" class="selecter" required>
                        </select>
                    </td>
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
            <input type="hidden" name="article_type[id]" id="id_edit" />
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="150px">文章类别名称：</th>
                    <td><input type="text" name='article_type[article_type_name]' id="article_type_name_edit" required /></td>
                </tr>
                <tr>
                    <th>用户名：</th>
                    <td>
                        <select name='article_type[member_id]' id="member_id_edit" class="selecter" required>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="保存" />&nbsp;&nbsp;
                        <input type="reset" value="重置" />&nbsp;&nbsp;
                        <input type="button" value="取消" id="close_edit_div" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
</body>
</html>