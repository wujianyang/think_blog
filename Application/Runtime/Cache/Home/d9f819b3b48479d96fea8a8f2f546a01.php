<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>index.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.config.js" charset="utf-8"></script>
    <script src="<?php echo (C("PLUGINS")); ?>ueditor/ueditor.all.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGINS")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
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
<div class="main_area">
    <div class="logo_area">
    <div class="logo_img">
        <img src="/think_blog/Public/images/head_pic_default.png" width="100" height="100" />
    </div>
    <div class="logo_text">
        <h1>个人博客系统</h1>
    </div>
    <div class="weather_area">

    </div>
    <div class="clear"></div>
</div>
    <div class="show_area">
        <div class="left_area">
            <div class="left_title">
                <span>文章列表</span>
                <a class="more" href="#" target="_blank">更多>></a>
            </div>
            <div class="article_area">
                <p class="article_title"><a href="#" target="_blank">做博客必须要学会坚持</a></p>
                <p class="article_content">世界知名的美国学者、《第三次浪潮》作者阿尔文·托夫勒在上个世纪90年代就说过这样的话，他说：“未来的文盲不再是不识字的人，而是没有学会学习的人。”在他一系列具有广泛影响的未来学著作当中，阐述的核心理念就是，面对着以几何级速度不断翻新的信息洪流，一个希望获得成功的人，应该具备的素质不再是他已经掌握了多少知识，而是他是否具有用最短的时间、最高的效率，学习并掌握最新知识的能力。</p>
                <div class="article_info">
                    <div class="article_author">作者：username</div>
                    <div class="article_type">文章类型：生活日志</div>
                    <div class="article_time">撰写时间：2016-09-08 20:48:05</div>
                    <div class="article_comment">评论(100)</div>
                    <div class="article_hitnum">访问量：100</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="article_area">
                <p class="article_title"><a href="#" target="_blank">做博客必须要学会坚持</a></p>
                <p class="article_content">世界知名的美国学者、《第三次浪潮》作者阿尔文·托夫勒在上个世纪90年代就说过这样的话，他说：“未来的文盲不再是不识字的人，而是没有学会学习的人。”在他一系列具有广泛影响的未来学著作当中，阐述的核心理念就是，面对着以几何级速度不断翻新的信息洪流，一个希望获得成功的人，应该具备的素质不再是他已经掌握了多少知识，而是他是否具有用最短的时间、最高的效率，学习并掌握最新知识的能力。</p>
                <div class="article_info">
                    <div class="article_author">作者：username</div>
                    <div class="article_type">文章类型：生活日志</div>
                    <div class="article_time">撰写时间：2016-09-08 20:48:05</div>
                    <div class="article_comment">评论(100)</div>
                    <div class="article_hitnum">访问量：100</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="article_area">
                <p class="article_title"><a href="#" target="_blank">做博客必须要学会坚持</a></p>
                <p class="article_content">世界知名的美国学者、《第三次浪潮》作者阿尔文·托夫勒在上个世纪90年代就说过这样的话，他说：“未来的文盲不再是不识字的人，而是没有学会学习的人。”在他一系列具有广泛影响的未来学著作当中，阐述的核心理念就是，面对着以几何级速度不断翻新的信息洪流，一个希望获得成功的人，应该具备的素质不再是他已经掌握了多少知识，而是他是否具有用最短的时间、最高的效率，学习并掌握最新知识的能力。</p>
                <div class="article_info">
                    <div class="article_author">作者：username</div>
                    <div class="article_type">文章类型：生活日志</div>
                    <div class="article_time">撰写时间：2016-09-08 20:48:05</div>
                    <div class="article_comment">评论(100)</div>
                    <div class="article_hitnum">访问量：100</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="article_area">
                <p class="article_title"><a href="#" target="_blank">做博客必须要学会坚持</a></p>
                <p class="article_content">世界知名的美国学者、《第三次浪潮》作者阿尔文·托夫勒在上个世纪90年代就说过这样的话，他说：“未来的文盲不再是不识字的人，而是没有学会学习的人。”在他一系列具有广泛影响的未来学著作当中，阐述的核心理念就是，面对着以几何级速度不断翻新的信息洪流，一个希望获得成功的人，应该具备的素质不再是他已经掌握了多少知识，而是他是否具有用最短的时间、最高的效率，学习并掌握最新知识的能力。</p>
                <div class="article_info">
                    <div class="article_author">作者：username</div>
                    <div class="article_type">文章类型：生活日志</div>
                    <div class="article_time">撰写时间：2016-09-08 20:48:05</div>
                    <div class="article_comment">评论(100)</div>
                    <div class="article_hitnum">访问量：100</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="article_area">
                <p class="article_title"><a href="#" target="_blank">做博客必须要学会坚持</a></p>
                <p class="article_content">世界知名的美国学者、《第三次浪潮》作者阿尔文·托夫勒在上个世纪90年代就说过这样的话，他说：“未来的文盲不再是不识字的人，而是没有学会学习的人。”在他一系列具有广泛影响的未来学著作当中，阐述的核心理念就是，面对着以几何级速度不断翻新的信息洪流，一个希望获得成功的人，应该具备的素质不再是他已经掌握了多少知识，而是他是否具有用最短的时间、最高的效率，学习并掌握最新知识的能力。</p>
                <div class="article_info">
                    <div class="article_author">作者：username</div>
                    <div class="article_type">文章类型：生活日志</div>
                    <div class="article_time">撰写时间：2016-09-08 20:48:05</div>
                    <div class="article_comment">评论(100)</div>
                    <div class="article_hitnum">访问量：100</div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="right_area">
            <div class="article_hot">
                <div class="article_hot_title">
                    <span>热门文章排行</span>
                    <a class="more" href="#" target="_blank">更多>></a>
                </div>
                <div class="article_hot_list">
                        <p><a href="">做博客必须要学会坚持</a><span>100</span></p>
                        <p><a href="">做博客必须要学会坚持</a><span>100</span></p>
                        <p><a href="">做博客必须要学会坚持</a><span>100</span></p>
                        <p><a href="">做博客必须要学会坚持</a><span>100</span></p>
                        <p><a href="">做博客必须要学会坚持</a><span>100</span></p>
                </div>
            </div>
            <div class="article_type_div">
                <div class="article_type_title">
                    <span>文章分类</span>
                    <a class="more" href="#" target="_blank">更多>></a>
                </div>
                <div class="article_type_list">
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="article_type_d"><a href="#">生活日志(<span>10</span>)</a></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="photo_div">
                <div class="photo_title">
                    <span>相册分类</span>
                    <a class="more" href="#" target="_blank">更多>></a>
                </div>
                <div class="photo_list">
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
                    <div class="photo_d"><a href="#">日常生活(<span>10</span>)</a></div>
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