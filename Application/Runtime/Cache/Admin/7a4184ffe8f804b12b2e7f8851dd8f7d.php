<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>文章管理_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />

    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script src="<?php echo (C("JS")); ?>admin/common.js"></script>
    <script src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script src="<?php echo (C("JS")); ?>admin/articleAdmin.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
        });
    </script>
    <style type="text/css">
        .list_table{width:1100px;margin:0 auto;}
        .info_table{width:1100px;padding:5px;}
        .info_table tr { height: 30px; vertical-align: top;}
        .info_table #title,.info_table #title_edit{width:800px;font-size: 18px;}
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
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="title+like">文章标题</option>
                    <option value="member_name+eq">作者</option>
                    <option value="article_type_name+eq">文章类型</option>
                </select>
                <input name="key" id="key" value="" placeholder="搜索文章标题" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <table class="list_table" id="" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50">ID</th>
                    <th width="500">文章标题</th>
                    <th width="150">作者</th>
                    <th width="150">文章类型</th>
                    <th width="100">访问量</th>
                    <th width="150">撰写时间</th>
                    <th width="100">查看评论</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["id"]); ?></td>
                        <td width="200"><a class="info" href="javascript:void(0);" title="<?php echo ($rows["title"]); ?>" value="<?php echo ($rows["id"]); ?>"><?php echo ($rows["title"]); ?></a></td>
                        <td width="150"><?php echo ($rows["member_name"]); ?></td>
                        <td width="150"><?php echo ($rows["article_type_name"]); ?></td>
                        <td width="50"><?php echo ($rows["hitnum"]); ?></td>
                        <td width="150"><?php echo ($rows["create_time"]); ?></td>
                        <td width="100"><a href="<?php echo (C("HOST_DIR")); ?>Admin/ArticleComment/index?article_id=<?php echo ($rows["id"]); ?>">查看评论</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
                    <th width="50">文章标题：</th>
                    <td colspan="3" width="750"><input type="text" name='article[title]' id="title" required width="600px" /></td>
                </tr>
                <tr>
                    <th>撰写作者：</th>
                    <td>
                        <select name='article[member_id]' id="member_id" required>
                        </select>
                    </td>
                    <th width="100">文章类别：</th>
                    <td>
                        <select name='article[article_type_id]' id="article_type_id" required>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>文章内容：</th>
                    <td colspan="3">
                        <script id="editor" type="text/plain" style="width:800px;height:200px;"></script>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <input type="submit" value="保存" />&nbsp;&nbsp;
                        <input type="reset" value="重置" />&nbsp;&nbsp;
                        <input type="button" value="取消" id="close_div" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="edit_div" class="edit_div">
        <form id="edit_form" name="edit_form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="article[id]" id="id_edit" />
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th>文章标题：</th>
                    <td colspan="3"><input type="text" name='article[title]' id="title_edit" required width="1000px" /></td>
                </tr>
                <tr>
                    <th>撰写作者：</th>
                    <td>
                        <select name='article[member_id]' id="member_id_edit" required>
                        </select>
                    </td>
                    <th width="100">文章类别：</th>
                    <td>
                        <select name='article[article_type_id]' id="article_type_id_edit" required>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>文章内容：</th>
                    <td colspan="3">
                        <section id="editor_edit">
                            <div id='edit_edit' style="margin-top: 30px;">

                            </div>
                        </section>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
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