<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>articleAdmin_blog</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <link href="<?php echo (C("PLUGINS")); ?>froala_editor/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo (C("PLUGINS")); ?>froala_editor/css/froala_editor.min.css" rel="stylesheet" type="text/css">


    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/libs/jquery-1.11.1.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/froala_editor.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/froala_editor_ie8.min.js"></script>
    <![endif]-->
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/tables.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/char_counter.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/file_upload.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/lists.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/colors.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/font_family.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/font_size.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/block_styles.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/media_manager.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>froala_editor/js/plugins/video.min.js"></script>

    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/articleCommentAdmin.js"></script>
    <script>
        $(function(){

        });
    </script>
    <style type="text/css">
        .list_table{width:1050px;margin:0 auto;}
        .article_title p{font-size: 20px;text-align: center;}
    </style>
</head>
<body>

<div class="main_form">
    <div id="list_div">
        <div class="toolbar">
            <div class="lfloat">
                <input type="button" value="删除" id="del" />
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="member_name+eq">用户ID</option>
                    <option value="member_name+eq">用户名</option>
                </select>
                <input name="key" id="key" value="" placeholder="请输入关键词" />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <input type="hidden" id="article_id" value="<?php echo ($data["article_id"]); ?>" />
            <div class="article_title">
                <p><?php echo ($data["article_title"]); ?></p>
            </div>
            <table class="list_table" id="" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50">ID</th>
                    <th width="100">用户ID</th>
                    <th width="150">用户名</th>
                    <th width="580">评论内容</th>
                    <th width="150">评论时间</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["id"]); ?></td>
                        <td width="100"><?php echo ($rows["member_id"]); ?></td>
                        <td width="150"><?php echo ($rows["member_name"]); ?></td>
                        <td width="580"><?php echo ($rows["comment_content"]); ?></td>
                        <td width="150"><?php echo ($rows["comment_time"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <?php if($data["count"] == 0): ?><div class="error">没有数据</div><?php endif; ?>
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
</div>
</body>
</html>