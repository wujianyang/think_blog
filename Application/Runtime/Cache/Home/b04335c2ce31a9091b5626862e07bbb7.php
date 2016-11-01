<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <style type="text/css">
        .container{width:100%; height:100%; margin-top:2%;}
        .content{background:#ffffff; margin:0 auto; position:relative; width:220px; height:100px; border: 15px solid #ffffff;}
        .content li{position:absolute; top:0; left:0; display:none;}
        .content span{position:absolute; left:47%; top:45%;}
        .content .left,.content .right{position:absolute; top:0; z-index:11;}
        .content .left{left:0; cursor: url(/think_blog/Public/images/cur-left.cur.ico),auto;}
        .content .right{right:0;cursor: url(/think_blog/Public/images/cur-right.cur.ico),auto;}
        .bottom{height:0px; background:#ffffff; margin:0 auto; overflow:hidden; line-height:50px; padding: 0 15px;}


    </style>
    <script src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        $(function (){
            var x=0,width,height,ul=$(".content"),bottom=$(".bottom"),t
            function img_block(){
                bottom.stop();
                ul.stop();
                $(".content li").css("display","none");
                bottom.css({"height":"0px"});
                $("#xz").text(x+1);
                width=parseInt($(".content li:eq("+x+")").css("width"));
                height=parseInt($(".content li:eq("+x+")").css("height"));
                ul.animate({"width":width+"px","height":height+"px"},500,function (){
                    $(".content li:eq("+x+")").css("display","block");
                    bottom.css("width",width+"px");
                    bottom.animate({"height":"50px"});
                    $(".left,.right").css({"width":width/2+"px","height":height+"px"})
                });
            };
            function rights(){
                if(x==$(".content li").length-1){x=0;}
                else{x++};
                img_block();
            };
            $(document).ready(function() {
                $("#imgdata").text($(".content li").length);
                img_block();
                t=setInterval(rights,4000);
            });
            $(".right").click(function (){rights()});
            $(".left").click(function (){
                if(x==0){x=$(".content li").length-1;}
                else{x--};
                img_block();
            });
            $(".right,.right").hover(function (){clearTimeout(t)},function (){t=setInterval(rights,4000)});
        });
    </script>
</head>
<body>
<div class="container">
    <!-- 代码 开始 -->
    <ul class="content">
        <span><img src="/think_blog/Public/images/loading.gif" width="32" height="32" /></span>
        <div class="left"></div>
        <div class="right"></div>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="482px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="723px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="459px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="484px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="540px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="683px" >
        </li>
        <li>
            <img src="/think_blog/Public/images/head_pic_default.png" width="900px" height="540px" >
        </li>


    </ul>
    <div class="bottom">
        共 <span id="imgdata">x</span> 张 / 第 <span id="xz">x</span> 张
    </div>
    <!-- 代码 结束 -->
</div>

</body>
</html>