<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($article["title"]); ?>_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>article.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>home/articleComment.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
            var fontSize=$('.fontBar .hov').attr('rel');
            $('.article_content').addClass('font'+fontSize);
            $('body').on("click",'.fontBar span',function(){
                fontSize=$(this).attr('rel');
                $('.article_content').removeClass('font0').removeClass('font1').removeClass('font2');
                $('.article_content').addClass('font'+fontSize);
                $('.fontBar span').removeClass('hov');
                $(this).addClass('hov');
            });
            $('body').on("click",'#comment',function(){
                var content=UE.getEditor('editor').getContent();
                var article_id=$('#article_id').val();
                $.ajax({
                    url:"<?php echo (C("HOST_DIR")); ?>Home/ArticleComment/comment",
                    type:"post",
                    data:{article_id:article_id,content:content},
                    dataType:"json",
                    success:function(data){
                        alert(data.msg);
                        if(data.status==1){
                            showList(1,10);
                        }
                    },error:function(data){
                        console.log('comment>error');
                        console.log(data.responseText);
                    }
                });
            });
        });
    </script>

</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo U(Index/index);?>">网站首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
            <a href="<?php echo U('Member/register');?>">注册</a>
        <?php else: ?>
            <a href="<?php echo U('Member/index');?>">我的主页</a>
            <a href="<?php echo U('Member/personCenter');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
            <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <form action="<?php echo (C("HOST_DIR")); ?>Home/Index/search" name="search_form" method="post">
        <select name="keyItem" id="keyItem_search">
            <option value="member">用户</option>
            <option value="article">文章</option>
        </select>
        <input type="text" name="key" id="key_search" placeholder="请输入关键字" required />
        <input type="submit" value="搜索" />
        </form>
    </div>
    <div class="clear"></div>
    <input type="hidden" value="<?php echo (C("HOST_DIR")); ?>" id="host_dir" />
    <input type="hidden" value="<?php echo (C("UPLOAD")); ?>" id="upload" />
    <input type="hidden" value="<?php echo (C("UPLOAD_PATH")); ?>" id="upload_path" />
    <input type="hidden" value="<?php echo (C("URL_HTML_SUFFIX")); ?>" id="suffix" />
</div>
<div class="article_div">
    <div class="article_title">
        <h1><?php echo ($article["title"]); ?></h1>
    </div>
    <div class="article_info">
        <label>作者：<a href="<?php echo U('Member/index',array('member_id'=>$article['member_id']),'html');?>"><?php echo ($article["member_name"]); ?></a></label>
        <label>文章类型：<a href="<?php echo U('Article/index');?>"><?php echo ($article["article_type_name"]); ?></a></label>
        <label>撰写时间：<span>2016-09-08 20:48:05</span></label>
        <label class="fontBar">
            字体：<span rel="0">小</span>
            <span class="hov" rel="1">中</span>
            <span rel="2">大</span>
        </label>
    </div>
    <div class="article_content">
        <?php echo ($article["content"]); ?>
    </div>
    <div class="comment_div">
        <div class="comment_title">
            <span name="comment">评论区</span>
        </div>
        <script id="editor" type="text/plain" style="width:960px;height:100px;"></script>
        <input type="button" value="留言" id="comment" />
        <div class="clear"></div>
        <p id="test"></p>
        <div class="comment_list">
            <div class="comment_list_title">
                <span>网友评论</span>
            </div>
            <input type="hidden" id="article_id" value="<?php echo ($article["article_id"]); ?>" />
            <div id="comment_list_div">
            <?php if(is_array($articleComment)): $i = 0; $__LIST__ = array_slice($articleComment,0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$articleComment): $mod = ($i % 2 );++$i;?><div class="comment_d">
                    <p>
                        <img class="comment_member" src="<?php echo (C("UPLOAD")); echo ($articleComment["head_pic"]); ?>" width="25px" height="25px">
                        <span><a href="<?php echo U('Member/index',array('member_id'=>$articleComment['member_id']),'html');?>"><?php echo ($articleComment["member_name"]); ?></a></span><span class="comment_time"><?php echo ($articleComment["comment_time"]); ?></span></p>
                    <p><?php echo ($articleComment["comment_content"]); ?></p>
                </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </div>
        </div>
        <div class="page_div" id="page_div">
            <span class="page"><a href="javascript:void(0);">首页</a></span>
            <span class="page"><a href="javascript:void(0);">上一页</a></span>
            <label id="curpage">1</label> /
            <label id="page_count"><?php echo ($pageCount); ?></label>
            <?php if($pageCount > 1): ?><span class="page hov"><a href="javascript:void(0);" rel="2">下一页</a></span>
                <span class="page hov"><a href="javascript:void(0);" rel="<?php echo ($pageCount); ?>">末页</a></span>
                <?php else: ?>
                <span class="page"><a href="javascript:void(0);">下一页</a></span>
                <span class="page"><a href="javascript:void(0);">末页</a></span><?php endif; ?>

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
            <span>共<?php echo ($article["article_comment_count"]); ?>条评论</span>
        </div>
    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>