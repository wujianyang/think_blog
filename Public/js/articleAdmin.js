$(document).ready(function(){
    //添加用户
    $('#add').click(function(){
        getMember();
        var member_id=$('#member_id').val();
        getArticleTypeByMemberId(member_id);
        $('#list_div').hide();
        $('#add_div').show();
    });
    //选择用户改变文章类别
    $('body').on('change','#member_id',function(){
        var member_id=$(this).val();
        getArticleTypeByMemberId(member_id);
    });
    $('body').on('change','#member_id_edit',function(){
        var member_id=$(this).val();
        getArticleTypeByMemberId(member_id,'edit');
    });


    //批量删除用户
    $('#del').click(function(){
        var del=$('.id');
        var arr=radio_cheched();
        if(arr.length==0){
            alert('请选择要删除的数据');
        }else{
            if(confirm('确定删除？')){

                $.ajax({
                    url:"/think_blog/index.php/Admin/Article/del",
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
                        alert('error');
                        showList(1,10,'','','eq');
                    }
                });
            }
        }
    });

    //添加表单验证和提交
    $('#add_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            title:{
                required:true,
                minlength:4
            },
            member_id:{
                required: true,
                minlength: 1
            },
            article_type_id:{
                required: true,
                minlength: 1
            },
            content:{
                required: true,
                minlength: 10
            }
        },
        submitHandler:function(form){
            var content=$('#content').html();   //获取文章内容
            $(form).ajaxSubmit({
                url:"/think_blog/index.php/Admin/Article/add",
                type:"post",
                data:{"article[content]":content},
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#add_div').hide();
                        $('#add_form')[0].reset();  //清空表单
                        $('#content').html(''); //清空文章内容
                    }
                },
                error:function(data){
                    console.log('add>error');
                    console.log(data.responseText);
                }
            });
        }
    });

    //编辑表单验证和提交
    $('#edit_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            title:{
                required:true,
                minlength:4
            },
            member_id:{
                required: true,
                minlength: 1
            },
            article_type_id:{
                required: true,
                minlength: 1
            },
            content:{
                required: true,
                minlength: 10
            }
        },
        submitHandler:function(form){
            var content=$('#content_edit').html();   //获取文章内容
            $(form).ajaxSubmit({
                url:"/think_blog/index.php/Admin/Article/edit",
                type:"post",
                data:{"article[content]":content},
                dataType:"json",
                success:function(data){
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

    //查看信息
    $('body').on('click','.info',function(){
        getMember('edit');
        var id= $(this).attr('value');
        if(/\d/.test(id)){
            $.ajax({
                url:"/think_blog/index.php/Admin/Article/info",
                type:"post",
                data:{"id":id},
                dataType:"json",
                success:function(result){
                    if(result.status==1){
                        var data=result.rows;
                        if(data.length!=0){
                            data=data[0];
                            for(var i in data){
                                getArticleTypeByMemberId(data.member_id,'edit');
                                if(i!='content'){
                                    $("#"+i+"_edit").val(data[i]);
                                }else{
                                    $("#"+i+"_edit").html(data[i]);
                                }

                            }
                            $('#edit_div').show();
                            $('#list_div').hide();
                        }else{
                            alert('没有此用户');
                        }
                    }else if(result.status==0){
                        alert('请求用户信息错误');
                    }
                },
                error:function(data){
                    console.log(data.responseText);
                    alert('请求失败');
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
    var sHtml_loading='<div class="loading"><img src="/think_blog/Public/images/loading.gif" width="100px" /></div>';
    $('#list_table_tbody').html(sHtml_loading);
    $.ajax({
        url:"/think_blog/index.php/Admin/Article/index",
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
                        sHtml += '<td width="200"><a class="info" href="javascript:void(0);" value="' + rows[i]["id"] + '">' + str_sub(rows[i]["title"],32) + '</a></td>';
                        sHtml += '<td width="150">' + rows[i]["member_name"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["article_type_name"] + '</td>';
                        sHtml += '<td width="50">' + rows[i]["hitnum"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["create_time"] + '</td>';
                        sHtml += '</tr>';
                    }
                    $('#list_table_tbody').html(sHtml);
                    //生成分页条
                    getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                }else{
                    $('#list_table_tbody').html('<tr><td colspan="7" salign="center">没有数据</td></tr>');
                }
            }else{
                $('#list_table_tbody').html('<tr><td colspan="7" salign="center">没有数据</td></tr>');
            }
        },
        error:function(data){
            console.log('showList>error');
            console.log(data.responseText);
        }
    });
}