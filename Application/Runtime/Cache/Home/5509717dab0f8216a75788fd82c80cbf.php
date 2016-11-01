<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的文章_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <style type="text/css">
        .info_title{border-bottom: solid #999 1px;font-weight: bold;padding:5px 0;}
        .list_table{width:1100px;margin:0 auto;}
        .info_table #title,.info_table #title_edit{width:800px;font-size: 18px;}
    </style>
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script src="<?php echo (C("JS")); ?>home/personArticle.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
            UE.getEditor('editor_edit');
        });
    </script>
</head>
<body>
<div class="info_title">
    <span>我的文章</span>
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
                    <option value="title+like">文章标题</option>
                    <option value="article_type_name+like">文章类型</option>
                </select>
                <input name="key" id="key" value="" placeholder="请输入关键字" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <table class="list_table" id="" cellspacing="1" cellpadding="0">
                <tr>
                    <th><input type="checkbox" name="" id="all_id" /></th>
                    <th width="50">ID</th>
                    <th width="500">文章标题</th>
                    <th width="150">文章类型</th>
                    <th width="100">访问量</th>
                    <th width="150">撰写时间</th>
                    <th width="100">查看评论</th>
                </tr>
                <tbody id="list_table_tbody">
                <?php if(is_array($article)): $i = 0; $__LIST__ = array_slice($article,0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($article["article_id"]); ?>" /></td>
                        <td width="50"><?php echo ($article["article_id"]); ?></td>
                        <td width="200"><a class="info" href="javascript:void(0);" title="<?php echo ($article["title"]); ?>" value="<?php echo ($article["article_id"]); ?>"><?php echo ($article["title"]); ?></a></td>
                        <td width="150"><?php echo ($article["article_type_name"]); ?></td>
                        <td width="50"><?php echo ($article["hitnum"]); ?></td>
                        <td width="150"><?php echo ($article["create_time"]); ?></td>
                        <td width="100"><a href="<?php echo (C("HOST_DIR")); ?>Home/ArticleComment/getArticleComment/article_id/<?php echo ($article["article_id"]); ?>.<?php echo (C("URL_HTML_SUFFIX")); ?>">查看评论</a></td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($pageCount > 0): ?><div class="page_div" id="page_div">
                <span class="page"><a href="javascript:void(0);">首页</a></span>
                <span class="page"><a href="javascript:void(0);">上一页</a></span>
                <label id="curpage">1</label> /
                <label id="page_count"><?php echo ($pageCount); ?></label>
                <?php if($pageCount == 1): ?><span class="page"><a href="javascript:void(0);">下一页</a></span>
                    <span class="page"><a href="javascript:void(0);">末页</a></span>
                    <?php else: ?>
                    <span class="page hov"><a href="javascript:void(0);" rel="2">下一页</a></span>
                    <span class="page hov"><a href="javascript:void(0);" rel="<?php echo ($pageCount); ?>">末页</a></span><?php endif; ?>
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
                <span>共<?php echo ($count); ?>条数据</span>
            </div><?php endif; ?>
    </div>
    <div class="add_div" id="add_div">
        <form id="add_form" name="add_form" method="post" enctype="multipart/form-data">
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="100">文章标题：</th>
                    <td colspan="3" width="750"><input type="text" name='article[title]' id="title" required width="600px" /></td>
                </tr>
                <tr>
                    <th width="100">文章类别：</th>
                    <td colspan="3">
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
            <input type="hidden" name="article[id]" id="article_id_edit" />
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th width="100">文章标题：</th>
                    <td colspan="3" width="750"><input type="text" name='article[title]' id="title_edit" required width="1000px" /></td>
                </tr>
                <tr>
                    <th width="100">文章类别：</th>
                    <td colspan="3">
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