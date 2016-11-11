<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板_<?php echo (C("TITLE")); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>mess.css" />
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo (C("JS")); ?>common.js"></script>
    <script src="<?php echo (C("JS")); ?>home/page.js"></script>
    <script type="text/javascript">
        //留言板列表显示
        function showList(page,page_size,keyItem,key,com){
            page=page||1;
            page_size=page_size||10;
            keyItem=keyItem||'id';
            key=key||'';
            com=com||'eq';
            var member_id=$('#member_id').val();
            var sHtml_loading='<div class="loading"><img src="<?php echo (C("HOST_DIR")); ?>Public/images/loading.gif" width="100px" /></div>';
            $('#mess_list_div').html(sHtml_loading);
            $.ajax({
                url:"<?php echo (C("HOST_DIR")); ?>Home/Mess/index",
                type:"post",
                data:{"page":page,"page_size":page_size,member_id:member_id},
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        var sHtml='';
                        var mess=data.rows;
                        if(mess.length>0) {
                            //拼接数据列表
                            for (var i = 0; i < mess.length; i++) {
                                sHtml+='<div class="mess_list_d">';
                                sHtml+='<p>';
                                sHtml+='<img src="<?php echo (C("UPLOAD")); ?>'+mess[i]['head_pic']+'" width="24px" height="24px" />';
                                sHtml+='<span><a href="<?php echo (C("HOST_DIR")); ?>Home/Member/index/member_id/'+mess[i]['member_id']+'.<?php echo (C("URL_HTML_SUFFIX")); ?>">'+mess[i]['member_name']+'</a></span>';
                                sHtml+='<span class="mess_time">'+mess[i]['mess_time']+'</span>';
                                sHtml+='</p>';
                                sHtml+='<p class="mess_content">'+mess[i]['content']+'</p>';
                                sHtml+='</div>';
                            }
                            $('#mess_list_div').html(sHtml);
                            //生成分页条
                            getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                        }else{
                            $('#mess_list_div').html('<p class="noData">'+data['msg']+'</p>');
                        }
                    }else{
                        $('#mess_list_div').html('<p class="noData">'+data['msg']+'</p>');
                    }
                },
                error:function(data){
                    console.log('showList>error');
                    console.log(data.responseText);
                }
            });
        }
        //分页条(当前页码,页码总数,总记录数,每页条数)
        function getPageBar(cur_page,page_count,total,page_size){
            cur_page=parseInt(cur_page);
            page_count=parseInt(page_count);
            total=parseInt(total);
            page_size=parseInt(page_size);
            var pageStr='';
            if(cur_page>page_count) //页码大于最大页数
                cur_page=page_count;
            if(cur_page<1)  //页码小于1
                cur_page=1;

            if(cur_page==1){    //如果是第一页
                pageStr+='<span class="page"><a href="javascript:void(0);">首页</a></span>';
                pageStr+='<span class="page"><a href="javascript:void(0);">上一页</a></span>';
            }else{
                pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="1">首页</a></span>';
                pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+(cur_page-1)+'">上一页</a></span>';
            }

            pageStr+='<label id="curpage">'+cur_page+'</label> / <label id="page_count">'+page_count+'</label>';

            if(cur_page>=page_count){   //如果是最后一页
                pageStr+='<span class="page"><a href="javascript:void(0);">下一页</a></span>';
                pageStr+='<span class="page"><a href="javascript:void(0);">末页</a></span>';
            }else{
                pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+(cur_page+1)+'">下一页</a></span>';
                pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+page_count+'">末页</a></span>';
            }

            pageStr+='<span><select id="toPageSize">';
            for(var i=1;i<=5;i++){
                if(parseInt(page_size)/10==i){
                    pageStr+='<option value="'+i*10+'" selected="selected">'+i*10+'</option>';
                }else{
                    pageStr+='<option value="'+i*10+'">'+i*10+'</option>';
                }
            }
            pageStr+='</select></span>';
            pageStr+='<span><input type="text" id="page_text" class="page_text" /><input type="button" value="跳转" id="toPage" /></span>';
            pageStr+='<span>共'+total+'条数据</span>';
            $('#page_div').html(pageStr);
            $('#page_div').show();
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
<input type="hidden" value="<?php echo ($data["member"]["id"]); ?>" id="member_id" />
<div class="mess_div">
   <div class="mess_title">
       <span><a href="<?php echo U('Member/index',array('member_id'=>$data['member']['id']));?>"><?php echo ($data['member']["member_name"]); ?></a></span>
       >>
       <span>留言板</span>
   </div>
    <div class="mess_list_div" id="mess_list_div">
        <?php if(is_array($data["rows"])): $i = 0; $__LIST__ = array_slice($data["rows"],0,null,true);if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$rows): $mod = ($i % 2 );++$i;?><div class="mess_list_d">
                <p>
                    <img src="<?php echo (C("UPLOAD")); echo ($rows["head_pic"]); ?>" width="24px" height="24px" />
                    <span><a href="<?php echo U('Member/index',array('member_id'=>$rows['messer_id']));?>"><?php echo ($rows["member_name"]); ?></a></span>
                    <span class="mess_time"><?php echo ($rows["mess_time"]); ?></span>
                </p>
                <p class="mess_content"><?php echo ($rows["content"]); ?></p>
            </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
    </div>
    <!--分页条-->
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
<div class="footer">
    Copyright @ 2016 博客系统 版权所有 闽ICP备00000001号
</div>

</body>
</html>