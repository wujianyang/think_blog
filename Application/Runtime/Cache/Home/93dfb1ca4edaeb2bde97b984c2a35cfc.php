<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php if($data["member"] != null): ?>热门文章排行
            <?php else: ?>
            文章列表<?php endif; ?>
        _<?php echo (C("TITLE")); ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>articleList.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>home/page.js"></script>
    <script type="text/javascript">
        //热门文章列表显示
        function showList(page,page_size,keyItem,key,com){
            page=page||1;
            page_size=page_size||20;

            var host_dir=$('#host_dir').val();
            var page_search=$('#page_search').val();
            var key_search=$('#keys_search').val();
            var keyItem_search=$('#keyItem_search').val();
            var member_id=$('#member_id').val();
            var ajax_data='{';
            ajax_data+='page:"'+page+'",page_size:"'+page_size+'"';
            if(page_search=='search'){
                var type='get';
                var url=host_dir+"Home/Index/search";
                ajax_data+=',key:"'+key_search+'",keyItem:"article"';
            }else{
                var type='post';
                var url=host_dir+"Home/Article/hotArticleList";
                ajax_data+=',member_id:"'+member_id+'"';
            }
            ajax_data+='}';

            var sHtml_loading='<div class="loading"><img src="'+host_dir+'Public/images/loading.gif" width="100px" /></div>';
            $('#article_list_div').html(sHtml_loading);
            $.ajax({
                url:url,
                type:type,
                data:eval('(' + ajax_data + ')'),
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        var sHtml='';
                        var hotArticle=data.rows;
                        if(hotArticle.length>0) {
                            //拼接数据列表
                            for (var i = 0; i < hotArticle.length; i++) {
                                sHtml+='<p>';
                                if(page_search=='search'){
                                    sHtml+='<a href="<?php echo (C("HOST_DIR")); ?>Home/Member/index/member_id/'+hotArticle[i]['member_id']+'.<?php echo (C("URL_HTML_SUFFIX")); ?>">['+hotArticle[i]['member_name']+']</a>';
                                }
                                sHtml+='<a href="<?php echo (C("HOST_DIR")); ?>Home/Article/index/article_id/'+hotArticle[i]['id']+'.<?php echo (C("URL_HTML_SUFFIX")); ?>" title="'+hotArticle[i]['title']+'" target="_target">'+str_sub(hotArticle[i]['title'],60)+'</a>';
                                sHtml+='<span>'+hotArticle[i]['create_time']+'</span>';
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
        <a href="<?php echo U(Index/index);?>">网站首页</a>
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
<input type="hidden" value="<?php echo ($data["member"]["id"]); ?>" id="member_id" />
<div class="hotArticle_div">
    <div class="article_list_title">
        <span>
            <?php if($data["member"] != null): ?><a href="<?php echo U('Member/index',array('member_id'=>$data['member']['id']));?>"><?php echo ($data["member"]["member_name"]); ?></a> >>热门文章排行
            <?php else: ?>
                文章列表
                <input type="hidden" value="search" id="page_search" />
                <input type="hidden" value="<?php echo ($_GET['key']); ?>" id="keys_search" />
                <input type="hidden" value="article" id="keyItem_search" /><?php endif; ?>

        </span>
    </div>
    <div class="article_list_div" id="article_list_div">
        <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,null,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><p>
                <?php if($rows["member_id"] != null): ?><a href="<?php echo U('Member/index',array('member_id'=>$rows['member_id']));?>">[<?php echo ($rows["member_name"]); ?>]</a><?php endif; ?>
                <a href="<?php echo U('Article/index',array('article_id'=>$rows['article_id']));?>" title="<?php echo ($rows["title"]); ?>" target="_blank"><?php echo (substr_mb($rows["title"],0,60,'utf-8')); ?></a>
                <span><?php echo ($rows["create_time"]); ?></span>
            </p>
            <?php if($key%5 == 4): ?><p class="line"></p><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
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
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>