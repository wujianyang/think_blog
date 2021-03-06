<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title>我的相片_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>admin.css" />
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>common.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>admin/page.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>home/personPhotoImg.js"></script>
    <script type="text/javaScript">

    </script>
    <style type="text/css">
        .info_table{width:650px;height:150px;}
        .loading{width:550px;}
        .list_table_div{padding-left:15px;width:1110px;}
        .photo_div{width:200px;float: left;margin:5px 0 0 5px;text-align:center;padding:5px;border:solid #ddd 1px;border-radius:5px;cursor: pointer;}
        .photo_div.op,.photo_div:hover{background:#ddd;}
        .photo_div p{line-height:5px;}
        .photo_div a{color:#000;}
        .photo_div a:hover{text-decoration: underline;}
        .all_id{position:absolute;margin:55px 0 0 -5px;border-radius:5px;padding:5px;background:#ddd;text-align:center;font-size:10px;cursor: pointer;z-index: 10;}
        .close{left:510px;}
        .pic_div{width:1000px;margin:0 auto;display: none;}
    </style>
</head>
<body>
<div class="info_title">
    <span>我的相片</span>
    <input type="hidden" value="<?php echo ($_GET['photo_id']); ?>" id="photo_id" />
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
                    <option value="img_title+like">相片标题</option>
                </select>
                <input name="key" id="key" value="" placeholder="搜索文章类别名称" required />
                <input type="button" value="搜索" id="search" />
            </div>
        </div>
        <div id="all_id" class="all_id">
            全</br>选
        </div>
        <div class="list_table_div mar_t20" id="list_table_div">
            <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><div class="photo_div">
                    <input type="hidden"  class="id" name="id[]" value="<?php echo ($rows["id"]); ?>" />
                    <div class="img_div">
                        <img src="<?php echo (C("UPLOAD")); echo ($rows["img_src"]); ?>" width="200" height="150" />
                    </div>
                    <p>ID：<a class="info" href="javascript:void(0);" title="<?php echo ($rows["img_title"]); ?>" value="<?php echo ($rows["id"]); ?>"><?php echo ($rows["id"]); ?> | <?php echo (substr_mb($rows["img_title"],0,8,'utf-8')); ?></a></p>
                </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
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
                    <th>相片名称：</th>
                    <td><input type="text" name='photoImg[img_title]' id="img_title" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <th>选择图片：</th>
                    <td>
                        <input type="file" name="img_src" id="img_src" required />
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
            <input type="hidden" name="photoImg[id]" id="id_edit" />
            <table class="info_table" cellspacing="1" cellpadding="0">
                <tr>
                    <th>相片名称：</th>
                    <td><input type="text" name='photoImg[img_title]' id="img_title_edit" required /></td>
                    <td rowspan="4"><img src="" id="photo_src" width="200" height="200" /></td>
                    <td rowspan="5" width="50"></td>
                </tr>
                <tr>
                    <th>选择图片：</th>
                    <td>
                        <input type="file" name="img_src" id="img_src_edit" />
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
    <div class="pic_div" id="pic_div">
        <img src="" width="1000" />
    </div>
</div>
</body>
</html>