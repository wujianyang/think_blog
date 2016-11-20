<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文章列表_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>articleList.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>home/page.js"></script>
    <script type="text/javascript">
        //文章列表显示
        function showList(page,page_size,keyItem,key,com){
            page=page||1;
            page_size=page_size||20;
            keyItem=keyItem||'id';
            key=key||'';
            com=com||'eq';
            var article_type_id=$('#article_type_id').val();
            var sHtml_loading='<div class="loading"><img src="<?php echo (C("HOST_DIR")); ?>Public/images/loading.gif" width="100px" /></div>';
            $('#article_list_div').html(sHtml_loading);
            $.ajax({
                url:"<?php echo (C("HOST_DIR")); ?>Home/Article/articleListPage",
                type:"post",
                data:{"page":page,"page_size":page_size,article_type_id:article_type_id},
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        var sHtml='';
                        var article=data.article;
                        if(article.length>0) {
                            //拼接数据列表
                            for (var i = 0; i < article.length; i++) {
                                sHtml+='<p>';
                                sHtml+='<a href="<?php echo (C("HOST_DIR")); ?>Home/Article/index/article_id/'+article[i]['id']+'.<?php echo (C("URL_HTML_SUFFIX")); ?>" title="'+article[i]['title']+'" target="_target">'+str_sub(article[i]['title'],40)+'</a>';
                                sHtml+='<span>'+article[i]['create_time']+'</span>';
                                sHtml+='</p>';
                                if(i%5 == 4){
                                    sHtml+='<p class="line"></p>';
                                }
                            }
                            $('#article_list_div').html(sHtml);
                            //生成分页条
                            getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                        }else{
                            $('#article_list_div').html('<p class="noData">'+data['msg']+'</p>');
                        }
                    }else{
                        $('#article_list_div').html('<p class="noData">'+data['msg']+'</p>');
                    }
                },
                error:function(data){
                    console.log('showList>error');
                    console.log(data.responseText);
                }
            });
        }
    </script>
</head>
<body>
<div class="top">
    <div class="person_top">
        <a href="<?php echo C('HOST_DIR');?>">网站首页</a>
        <?php if($_SESSION['MEMBER']== null): ?><a href="<?php echo U('Member/login');?>">登录</a>
            <a href="<?php echo U('Member/register');?>">注册</a>
        <?php else: ?>
            <a href="<?php echo U('Member/index');?>">我的主页</a>
            <a href="<?php echo U('Member/personCenter');?>"><?php echo ($_SESSION['MEMBER']['member_name']); ?></a>
            <a href="<?php echo U('Member/logout');?>">退出</a><?php endif; ?>
    </div>
    <div class="search_top">
        <form action="<?php echo (C("HOST_DIR")); ?>Home/Index/search" name="search_form" method="get">
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
<input type="hidden" value="<?php echo ($article_type_op["id"]); ?>" id="article_type_id" />
<div class="article">
    <div class="article_type_div">
        <!--用户信息-->
        <?php if($member != null): ?><p>
                <img src="<?php echo (C("UPLOAD")); echo ($member['head_pic']); ?>" width="30px" height="30px" />
                <span><a href="<?php echo U('Member/index',array('member_id'=>$member['id']));?>"><?php echo ($member["member_name"]); ?></a></span>
            </p><?php endif; ?>
        <!--文章分类列表-->
        <ul>
            <?php if(is_array($articleType)): $i = 0; $__LIST__ = array_slice($articleType,0,null,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$articleType): $mod = ($i % 2 );++$i; if($articleType['id'] == $article_type_op['id']): ?><a href="javascript:void(0);"><li class="op"><?php echo ($articleType["article_type_name"]); ?></li></a>
                    <?php else: ?>
                    <a href="<?php echo U('Article/articleList',array('article_type_id'=>$articleType['id']));?>"><li><?php echo ($articleType["article_type_name"]); ?></li></a><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
        </ul>
    </div>
    <div class="article_div">
        <!--当前文章分类-->
        <div class="article_list_title">
            <span><?php echo ($article_type_op["article_type_name"]); ?></span>
        </div>
        <!--文章列表-->
        <div class="article_list_div" id="article_list_div">
            <?php if(is_array($article)): $i = 0; $__LIST__ = array_slice($article,0,null,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><p>
                    <a href="<?php echo U('Article/index',array('article_id'=>$article['id']));?>" title="<?php echo ($article["title"]); ?>" target="_blank"><?php echo (substr_mb($article["title"],0,40)); ?></a>
                    <span><?php echo ($article["create_time"]); ?></span>
                </p>
                <?php if($key%5 == 4): ?><p class="line"></p><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
        </div>
        <!--分页条-->
        <?php if($article != null): ?><div class="page_div" id="page_div">
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
                <span>共<?php echo ($count); ?>条数据</span>
            </div><?php endif; ?>

    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>