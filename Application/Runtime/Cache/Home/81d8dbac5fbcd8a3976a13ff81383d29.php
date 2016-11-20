<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($member["member_name"]); ?>_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>index.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
            $('body').on("click",'#mess',function(){
                var content=UE.getEditor('editor').getContent();
                var member_id=$('#member_id').val();
                $.ajax({
                    url:"<?php echo (C("HOST_DIR")); ?>Home/Mess/mess",
                    type:"post",
                    data:{member_id:member_id,content:content},
                    dataType:"json",
                    success:function(data){
                        alert(data.msg);
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
<div class="main_area">
    <div class="info_area">
    <div class="info_img">
        <img src="<?php echo (C("UPLOAD")); echo ($member["head_pic"]); ?>" width="100" height="100" />
    </div>
    <input type="hidden" value="<?php echo ($member["id"]); ?>" id="member_id" />
    <div class="person_info">
        <p><?php echo ($member["member_name"]); ?></p>
        <p>
            <a href="<?php echo U('Member/friends',array('member_id'=>$member['id'],'f'=>'focus'));?>">关注 <?php echo ($focus_count); ?></a> |
            <a href="<?php echo U('Member/friends',array('member_id'=>$member['id'],'f'=>'fans'));?>">粉丝 <?php echo ($fans_count); ?></a>
        </p>
        <p><a href="#">访问量 <?php echo ($member["hitnum"]); ?></a></p>
    </div>
    <div class="weather_area">
        <table style="width:300px;height:100px;margin: 0 auto;text-align: center;color:#666;font-family:微软雅黑;font-size:16px;">
            <tr>
                <td colspan="2"><?php echo ($weather["city"]); ?>&nbsp;<?php echo ($weather["dateT"]); ?></td>
            </tr>
            <tr>
                <td>天气：<?php echo ($weather["weather"]); ?></td>
                <td>温度：<?php echo ($weather["temperature"]); ?></td>
            </tr>
            <tr>
                <td>风速：<?php echo ($weather["wind"]); ?></td>
                <td>PM2.5：<?php echo ($weather["pm25"]); ?></td>
            </tr>
        </table>
    </div>
    <div class="clear"></div>
</div>
    <div class="show_area">
        <div class="left_area">
            <div class="left_title">
                <span>文章列表</span>
                <a class="more" href="<?php echo U('Article/articleList',array('member_id'=>$article[0]['member_id']),'html');?>">更多>></a>
            </div>
            <?php if(is_array($article)): $i = 0; $__LIST__ = array_slice($article,0,5,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="article_area">
                    <p class="article_title"><a href="<?php echo U('Article/index',array('article_id'=>$article['article_id']),'html');?>" title="<?php echo ($article["title"]); ?>" target="_blank"><?php echo (substr_mb($article["title"],0,80,'utf-8')); ?></a></p>
                    <p class="article_content"><?php echo (substr_mb($article["content"],0,105,'utf-8')); ?></p>
                    <div class="article_info">
                        <div class="article_author">作者：<a href="<?php echo U('Member/index',array('member_id'=>$article['member_id']));?>"><?php echo ($article["member_name"]); ?></a></div>
                        <div class="article_type">文章类型：<a href="<?php echo U('Article/articleList',array('article_type_id'=>$article['article_type_id']));?>"><?php echo ($article["article_type_name"]); ?></a></div>
                        <div class="article_time">撰写时间：<?php echo ($article["create_time"]); ?></div>
                        <div class="article_hitnum">访问量：<?php echo ($article["hitnum"]); ?></div>
                        <div class="article_comment"><a href="<?php echo U('Article/index#comment',array('article_id'=>$article['article_id']));?>" target="_blank">评论(<?php echo ($article["article_comment_count"]); ?>)</a></div>
                        <div class="clear"></div>
                    </div>
                </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
            <div class="write_mess_div">
                <div class="left_title">
                    <span>留言区</span>
                </div>
                <script id="editor" type="text/plain" style="width:700px;height:100px;"></script>
                <input type="button" value="留言" id="mess" />
            </div>
        </div>
        <div class="right_area">
            <div class="article_hot">
                <div class="article_hot_title">
                    <span>热门文章排行</span>
                    <a class="more" href="<?php echo U('Article/hotArticleList',array('member_id'=>$member['id']));?>">更多>></a>
                </div>
                <div class="article_hot_list">
                    <?php if(is_array($hotArticle)): $i = 0; $__LIST__ = array_slice($hotArticle,0,5,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$hotArticle): $mod = ($i % 2 );++$i;?><p><a href="<?php echo U('Article/index',array('article_id'=>$hotArticle['article_id']));?>" target="_blank" title="<?php echo ($hotArticle["title"]); ?>"><?php echo (substr_mb($hotArticle["title"],0,16,'utf-8')); ?></a><span><?php echo ($hotArticle["hitnum"]); ?></span></p><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                </div>
            </div>
            <div class="article_type_div">
                <div class="article_type_title">
                    <span>文章分类</span>
                    <a class="more" href="<?php echo U('Article/articleList',array('member_id'=>$member['id']));?>">更多>></a>
                </div>
                <div class="article_type_list">
                    <?php if(is_array($articleType)): $i = 0; $__LIST__ = array_slice($articleType,0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$articleType): $mod = ($i % 2 );++$i;?><div class="article_type_d"><a href="<?php echo U('Article/articleList',array('article_type_id'=>$articleType['article_type_id']));?>" title="<?php echo ($articleType["article_type_name"]); ?>"><?php echo ($articleType["article_type_name"]); ?>(<span><?php echo (substr_mb($articleType["article_count"],0,6,'utf-8')); ?></span>)</a></div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="photo_div">
                <div class="photo_title">
                    <span>相册分类</span>
                    <a class="more" href="<?php echo U('Photo/index',array('member_id'=>$member['id']));?>">更多>></a>
                </div>
                <div class="photo_list">
                    <?php if(is_array($photo)): $i = 0; $__LIST__ = array_slice($photo,0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i;?><div class="photo_d"><a href="<?php echo U('Photo/index',array('photo_id'=>$photo['photo_id']));?>" title="<?php echo ($photo["photo_title"]); ?>"><?php echo ($photo["photo_title"]); ?>(<span><?php echo ($photo["photo_count"]); ?></span>)</a></div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="mess_div">
                <div class="mess_title">
                    <span>留言板</span>
                    <a class="more" href="<?php echo U('Mess/index',array('member_id'=>$member['id']));?>">更多>></a>
                </div>
                <div class="mess_list">
                    <?php if(is_array($mess)): $i = 0; $__LIST__ = array_slice($mess,0,10,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$mess): $mod = ($i % 2 );++$i;?><div class="mess_d">
                            <a href="<?php echo U('Member/index',array('member_id'=>$mess['messer_id']));?>"><?php echo ($mess["member_name"]); ?></a>：<?php echo ($mess["content"]); ?>
                        </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>