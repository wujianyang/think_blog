<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>忘记密码</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (C("CSS")); ?>login.css"/>
    <style type="text/css">
        .question_div{margin-top:10px;display: none;}
    </style>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery-1.8.3.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.validate.min.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>jquery.form.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>messages_zh.js"></script>
    <script language="JavaScript" src="<?php echo (C("JS")); ?>ajax.js"></script>
    <script type="text/javascript">
        $(function(){
            //获取用户密码问题
            $('#getQuestion').click(function(){
                var member_name=$('#member_name').val();
                if(member_name!=''){
                    $.ajax({
                        url:"<?php echo U('getQuestion');?>",
                        type:"post",
                        data:{member_name:member_name},
                        dataType:"json",
                        success:function(data){
                            if(data.status==1){
                                $('#question').html(data.question);
                                $('#getQuestion').val('修改密码');
                                $('#getQuestion').attr('id','updatePasswd');
                                $('.question_div').slideDown('500');
                                $('#member_name').slideUp('50');
                            }else{
                                $('#msg').html(data.msg);
                            }
                        },
                        error:function(data){
                            console.log('getQuestion>error');
                            console.log(data.responseText);
                        }
                    });
                }else{
                    $('#msg').html('请输入用户名');
                }
            });

            //修改密码
            $('body').on('click','#updatePasswd',function(){
                var member_name=$('#member_name').val();
                var question=$('#question').text();
                var answer=$('#answer').val();
                var passwd=$('#passwd').val();
                var passwd2=$('#passwd2').val();
                $.ajax({
                    url:"<?php echo U('forgetUpdatePasswd');?>",
                    type:"post",
                    data:{member_name:member_name,question:question,answer:answer,passwd:passwd,passwd2:passwd2},
                    dataType:"json",
                    success:function(data){
                        if(data.status==1){
                            alert(data.msg);
                            location.href="<?php echo U('login');?>";
                        }else{
                            $('#msg').html(data.msg);
                        }
                    },
                    error:function(data){
                        console.log('updatePasswd>error');
                        console.log(data.responseText);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div id="login">
    <h1>忘记密码</h1>
    <form id="info_form" id="info_form" method="post">
        <input type="text" required="required" placeholder="用户名" name="member_name" id="member_name" />
        <div class="question_div">
            <p><b>密码问题：</b><span id="question"></span></p>
            <input type="text" required="required" placeholder="密码答案" name="answer" id="answer" />
            <input type="password" required="required" placeholder="新的密码" name="passwd" id="passwd" />
            <input type="password" required="required" placeholder="确认密码" name="passwd2" id="passwd2" />
        </div>
        <input class="but" type="button" id="getQuestion" value="获取密码问题" />
        <div style="color:#f30;text-align:center;" id="msg"><?php echo ($msg); ?></div>
    </form>
</div>
</body>
</html>