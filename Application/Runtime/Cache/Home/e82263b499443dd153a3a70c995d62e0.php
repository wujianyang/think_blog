<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的文章评论_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <style type="text/css">
        .list_table{width:1050px;margin:0 auto;}
        .article_title p{font-size: 20px;text-align: center;}
    </style>
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>page.js"></script>
    <script src="<?php echo (C("JS")); ?>home/personComment.js"></script>
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
                <input type="button" value="删除" id="del" />
            </div>
            <div class="rfloat">
                <select id="keyItem">
                    <option value="id+eq">ID</option>
                    <option value="member_id+eq">用户ID</option>
                    <option value="member_name+like">用户名</option>
                </select>
                <input name="key" id="key" value="" placeholder="请输入关键词" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div class="list_table_div mar_t20">
            <input type="hidden" id="article_id" value="<?php echo ($data["article_id"]); ?>" />
            <div class="article_title">
                <p><?php echo ($data["title"]); ?></p>
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
                <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><tr class="tr_line">
                        <td><input type="checkbox" class="id" name="id[]" value="<?php echo ($rows["article_comment_id"]); ?>" /></td>
                        <td width="50"><?php echo ($rows["article_comment_id"]); ?></td>
                        <td width="100"><?php echo ($rows["member_id"]); ?></td>
                        <td width="150"><?php echo ($rows["member_name"]); ?></td>
                        <td width="580"><?php echo ($rows["comment_content"]); ?></td>
                        <td width="150"><?php echo ($rows["comment_time"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>

                </tbody>
            </table>
        </div>
        <?php if($data["pageCount"] > 0): ?><div class="page_div" id="page_div">
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