<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>index.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script src="<?php echo (C("REMOTE_IP_URL")); ?>"></script>
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
    <div class="logo_area">
    <div class="logo_img">
        <img src="/think_blog/Public/images/head_pic_default.png" width="100" height="100" />
    </div>
    <div class="logo_text">
        <h1>个人博客系统</h1>
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
                <span>文章排行</span>
            </div>
            <?php if(is_array($article)): $i = 0; $__LIST__ = array_slice($article,0,5,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="article_area">
                    <p class="article_title"><a href="<?php echo U('Article/index',array('article_id'=>$article['article_id']),'html');?>" title="<?php echo ($article["title"]); ?>" target="_blank"><?php echo (substr_mb($article["title"],0,40,'utf-8')); ?></a></p>

                    <p class="article_content"><?php echo (substr_mb($article["content"],0,100,'utf-8')); ?></p>
                    <div class="article_info">
                        <div class="article_author">作者：<a href="<?php echo U('Member/index',array('member_id'=>$article['member_id']));?>"><?php echo ($article["member_name"]); ?></a></div>
                        <div class="article_type">文章类型：<a href="<?php echo U('Article/articleList',array('article_type_id'=>$article['article_type_id']));?>"><?php echo ($article["article_type_name"]); ?></a></div>
                        <div class="article_time">撰写时间：<?php echo ($article["create_time"]); ?></div>
                        <div class="article_hitnum">访问量：<?php echo ($article["hitnum"]); ?></div>
                        <div class="article_comment"><a href="<?php echo U('Article/index#comment',array('article_id'=>$article['article_id']));?>" target="_blank">评论(<?php echo ($article["article_comment_count"]); ?>)</a></div>
                        <div class="clear"></div>
                    </div>
                </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
        </div>
        <div class="right_area">
            <div class="member_div">
                <div class="member_title">
                    <span>用户排行</span>
                </div>
                <div class="member_list">
                    <?php if(is_array($member)): $i = 0; $__LIST__ = array_slice($member,0,30,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$member): $mod = ($i % 2 );++$i;?><div class="member_d"><a href="<?php echo U('Member/index',array('member_id'=>$member['id']));?>" title="<?php echo ($member["member_name"]); ?>">
                            <img src="<?php echo (C("UPLOAD")); echo ($member["head_pic"]); ?>" width="30" height="30" />
                            <?php echo (substr_mb($member["member_name"],0,15,'utf-8')); ?>(<span><?php echo ($member["hitnum"]); ?></span>)
                        </a></div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                    <div class="clear"></div>
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