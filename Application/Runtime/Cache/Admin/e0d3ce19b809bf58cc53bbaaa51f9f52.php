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
                    <option value="notpass+eq">未审核</option>
                    <option value="pass+eq">已审核</option>
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
</div>
</body>
</html>