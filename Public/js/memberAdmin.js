$(document).ready(function(){
    //添加用户
    $('#add').click(function(){
        $('#list_div').hide();
        $('#add_div').show();
    });

    //批量删除用户
    $('#del').click(function(){
        var del=$('.id');
        var arr=new Array();
        for(var i=0;i<del.length;i++){
            if(del[i].checked){
                arr.push(del[i].value);
            }
        }
        if(arr.length==0){
            alert('请选择要删除的数据');
        }else{
            if(confirm('同时删除该用户的相关数据，确定删除？')){

                $.ajax({
                    url:"/think_blog/index.php/Admin/Member/del",
                    type:"post",
                    dataType:"json",
                    data:{id:arr},
                    success:function(data){
                        if(data.status=='1'){
                            alert('删除成功');
                            showList(1,10,'','','eq');
                        }else{
                            alert('删除失败');
                        }
                    },
                    error:function(data){
                        console.log('del>error');
                        console.log(data.responseText);
                        showList(1,10,'','','eq');
                    }
                });
            }
        }
    });
    //批量冻结用户
    $('#freeze').click(function(){
        var fre=$('.id');
        var arr=new Array();
        for(var i=0;i<fre.length;i++){
            if(fre[i].checked){
                arr.push(fre[i].value);
            }
        }
        if(arr.length==0){
            alert('请选择要冻结的用户');
        }else{
            if(confirm('确定冻结？')){

                $.ajax({
                    url:"/think_blog/index.php/Admin/Member/freeze",
                    type:"post",
                    dataType:"json",
                    data:{id:arr,is_f:1},
                    success:function(data){
                        alert(data.msg);
                        if(data.status==1){
                            showList(1,10,'','','eq');
                        }
                    },
                    error:function(data){
                        console.log(data.responseText);
                        alert('请求失败');
                    }
                });
            }
        }
    });

    //批量解除冻结用户
    $('#not_freeze').click(function(){
        var fre=$('.id');
        var arr=new Array();
        for(var i=0;i<fre.length;i++){
            if(fre[i].checked){
                arr.push(fre[i].value);
            }
        }
        if(arr.length==0){
            alert('请选择要激活的用户');
        }else{
            if(confirm('确定激活？')){

                $.ajax({
                    url:"/think_blog/index.php/Admin/Member/freeze",
                    type:"post",
                    dataType:"json",
                    data:{id:arr,is_f:0},
                    success:function(data){
                        alert(data.msg);
                        if(data.status==1){
                            showList(1,10,'','','eq');
                        }
                    },
                    error:function(data){
                        console.log(data.responseText);
                        alert('请求失败');
                    }
                });
            }
        }
    });

    //批量重置用户密码
    $('#resetPasswd').click(function(){
        var rep=radio_cheched();
        if(rep.length==0){
            alert('请选择要重置密码的用户');
        }else{
            if(confirm('确定重置密码？')){
                $.ajax({
                    url:"/think_blog/index.php/Admin/Member/resetPasswd",
                    type:"post",
                    dataType:"json",
                    data:{id:rep},
                    success:function(data){
                        alert(data.msg);
                        if(data.status==1){
                            showList(1,10,'','','eq');
                        }
                        console.log(data);
                    },
                    error:function(data){
                        console.log(data.responseText);
                        alert('请求失败');
                    }
                });
            }
        }
    });

    //添加用户表单验证和提交
    $('#add_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            member_name:{
                required:true,
                minlength:8
            },
            password:{
                required: true,
                minlength: 6
            },
            password2:{
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            email:{
                required: true,
                email:true
            },
            tel:{
                required: true
            },
            address:{
                required: true,
                minlength:6
            },
            question:{
                required: true,
                minlength:6
            },
            answer:{
                required: true,
                minlength:6
            }
        },
        messages:{
            password2:{
                equalTo:"密码不一致"
            }
        },
        submitHandler:function(form){
            $(form).ajaxSubmit({
                url:"/think_blog/index.php/Admin/Member/add",
                type:"post",
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#add_div').hide();
                        $('#add_form')[0].reset();
                    }
                },
                error:function(data){
                    console.log('add>error');
                    console.log(data.responseText);
                }
            });
        }
    });

    //电话号码验证
    jQuery.validator.addMethod("tel", function(value, element, param) {
        var patt=/([\d]{11})|(\d{3,4}-\d{7,8})/;
        return patt.test(value);
    }, $.validator.format("请输入正确的电话"));
    jQuery.validator.addMethod("tel_edit", function(value, element, param) {
        var patt=/([\d]{11})|(\d{3,4}-\d{7,8})/;
        return patt.test(value);
    }, $.validator.format("请输入正确的电话"));

    //编辑用户表单验证和提交
    $('#edit_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            member_name_edit:{
                required:true,
                minlength:8
            },
            email_edit:{
                required: true,
                email:true
            },
            tel_edit:{
                required: true
            },
            address_edit:{
                required: true,
                minlength:6
            },
            question_edit:{
                required: true,
                minlength:6
            },
            answer_edit:{
                required: true,
                minlength:6
            }
        },
        messages:{
            password2:{
                equalTo:"密码不一致"
            }
        },
        submitHandler:function(form){
            $(form).ajaxSubmit({
                url:"/think_blog/index.php/Admin/Member/edit",
                type:"post",
                dataType:"json",
                success:function(data){
                    console.log(data);
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#edit_div').hide();
                        $('#edit_form')[0].reset();
                    }
                },
                error:function(data){
                    console.log('edit>error');
                    console.log(data.responseText);
                }
            });
        }
    });

    //查看用户信息
    $('.info').live('click', function(){

        var id= $(this).attr('value');
        if(/\d/.test(id)){
            $.ajax({
                url:"/think_blog/index.php/Admin/Member/info",
                type:"post",
                data:{"id":id},
                dataType:"json",
                success:function(result){
                    if(result.status==1){
                        var data=result.rows;
                        if(data.length!=0){
                            data=data[0];
                            $('#edit_div').show();
                            $('#list_div').hide();
                             for(var i in data){
                                 if(i=='head_pic'){
                                     $("#"+i+"_edit_img").attr("src",'/think_blog/Upload/'+data[i]);
                                 }
                                 $("#"+i+"_edit").val(data[i]);
                             }
                        }else{
                            alert('没有此用户');
                        }
                    }else if(result.status==0){
                        alert(result.msg);
                    }
                },
                error:function(data){
                    alert('请求失败');
                    console.log(data.responseText);
                    console.log('info>error');
                }
            });
        }else{
            alert('用户参数错误');
        }
    });

});
//列表显示
function showList(page,page_size,keyItem,key,com){
    page=page||1;
    page_size=page_size||10;
    keyItem=keyItem||'id';
    key=key||'';
    com=com||'eq';
    var sHtml_loading='<div class="loading"><img src="/think_blog/public/images/loading.gif" width="100px"  /></div>';
    $('#list_table_tbody').html(sHtml_loading);

    var url={$Think.config.JS};
    console.log(url);
    $.ajax({
        url:"/think_blog/index.php/Admin/Member/index",
        type:"post",
        data:{"page":page,"page_size":page_size,"keyItem":keyItem,"key":key,"com":com},
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var sHtml='';
                var rows=data.rows;
                if(rows.length>0) {
                    //拼接数据列表
                    for (var i = 0; i < rows.length; i++) {
                        sHtml += '<tr class="tr_line">';
                        sHtml += '<td><input type="checkbox" class="id" name="id[]" value="' + rows[i]["id"] + '" /></td>';
                        sHtml += '<td width="50">' + rows[i]["id"] + '</td>';
                        sHtml += '<td width="150"><a class="info" href="javascript:void(0);" value="' + rows[i]["id"] + '">' + rows[i]["member_name"] + '</a></td>';
                        if (rows[i]["sex"] == '1')
                            sHtml += '<td width="50">男</td>';
                        else if (rows[i]["sex"] == '0')
                            sHtml += '<td width="50">女</td>';
                        sHtml += '<td width="150">' + rows[i]["email"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["tel"] + '</td>';
                        sHtml += '<td width="200">' + rows[i]["address"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["question"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["answer"] + '</td>';
                        sHtml += '<td width="50">' + rows[i]["hitnum"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["last_ip"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["last_time"] + '</td>';
                        if (rows[i]["is_freeze"] == '1')
                            sHtml += '<td width="100">已冻结</td>';
                        else
                            sHtml += '<td width="100">已激活</td>';
                        sHtml += '</tr>';
                    }
                    $('#list_table_tbody').html(sHtml);
                    //生成分页条
                    getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                }else{
                    $('#list_table_tbody').html('<tr><td colspan="13" salign="center">没有数据</td></tr>');
                }

            }else{
                $('#list_table_tbody').html('<tr><td colspan="13" salign="center">没有数据</td></tr>');
            }
        },
        error:function(data){
            console.log('showList>error');
            console.log(data.responseText);
        }
    });
}